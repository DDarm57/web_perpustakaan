<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\TransaksiModel;
use CodeIgniter\I18n\Time;
use DateTime;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class Admin extends BaseController
{
    protected $bukuModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $transaksiModel;
    protected $db;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->transaksiModel = new TransaksiModel();
        $this->db = \Config\Database::connect();
    }
    public function dashboard()
    {
        $get_siswa = $this->db->table('data_siswa')->countAllResults();
        $get_buku = $this->db->table('data_buku')->countAllResults();

        $data = [
            'tittle' => 'Dashboard',
            'siswa' => $get_siswa,
            'buku' => $get_buku
        ];

        return view('admin/dashboard', $data);
    }

    public function profile()
    {
        $data = [
            'tittle' => 'Profile',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/profile', $data);
    }

    public function save_profile()
    {
        if (!$this->validate([
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama buku harus di isi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username buku harus di isi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password buku harus di isi'
                ]
            ],
            'user_image' => [
                'rules' => 'max_size[user_image,3024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar maksimal 3mb',
                    'is_image' => 'yang anda masukan bukan gambar',
                    'mime_in' => 'yang anda masukan bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('admin/profile'))->withInput();
        }

        $user_image = $this->request->getFile('user_image');

        if ($user_image->getError() == 4) {
            $namaGmbUser = $this->request->getVar('gambar_lama');
        } else {
            $namaGmbUser = $user_image->getRandomName();
            $user_image->move('assets/img/admin', $namaGmbUser);

            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/img/admin/' . $this->request->getVar('gambar_lama'));
            }
        }

        $data = [
            'full_name' => $this->request->getVar('full_name'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'user_image' => $namaGmbUser
        ];

        $builder = $this->db->table('users');
        $builder->where('id', $this->request->getVar('id'))->update($data);

        session()->setFlashdata('pesan_update', 'Profile berhasil di update silahkan login kembali');
        return redirect()->to(site_url('auth/logout'));
    }

    public function data_buku()
    {
        $query = $this->db->table('data_buku');
        $builder = $query->select('*');
        $builder->join('kategori_buku', 'kategori_buku.id_kategori = data_buku.id_kategori');
        $get_data = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Data Buku',
            'buku' => $get_data
        ];

        return view('admin/data_buku', $data);
    }

    public function tambah_buku()
    {
        $builder = $this->db->table('kategori_buku');
        $get_data = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Tambah data buku',
            'kategori' => $get_data,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/tambah_buku', $data);
    }

    public function save_buku()
    {
        if (!$this->validate([
            'kode_buku' => [
                'rules' => 'required|is_unique[data_buku.kode_buku]',
                'errors' => [
                    'required' => 'Kode buku harus di isi',
                    'is_unique' => 'Kode buku sudah terdaftar di database'
                ]
            ],
            'gambar_buku' => [
                'rules' => 'max_size[gambar_buku,3024]|is_image[gambar_buku]|mime_in[gambar_buku,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar maksimal 3mb',
                    'is_image' => 'yang anda masukan bukan gambar',
                    'mime_in' => 'yang anda masukan bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('admin/tambah_buku'))->withInput();
        }
        $gambar_buku = $this->request->getFile('gambar_buku');

        if ($gambar_buku->getError() == 4) {
            $namaGmbBuku = 'default.jpg';
        } else {
            $namaGmbBuku = $gambar_buku->getRandomName();

            $gambar_buku->move('assets/img/buku', $namaGmbBuku);
        }

        $data = [
            'kode_buku' => $this->request->getVar('kode_buku'),
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'isbn' => $this->request->getVar('isbn'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'jumlah' => $this->request->getVar('jumlah'),
            'gambar_buku' => $namaGmbBuku
        ];

        $this->bukuModel->insert($data);

        session()->setFlashdata('pesan_hijau', 'Data buku berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_buku'));
    }

    public function ubah_buku($id_buku)
    {
        $query = $this->bukuModel->where('id_buku', $id_buku)->first();

        // dd($query);

        $get_kategori = $this->db->table('kategori_buku')->get()->getResultArray();

        $data = [
            'tittle' => 'Tambah data buku',
            'buku' => $query,
            'kategori' => $get_kategori,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/ubah_buku', $data);
    }

    public function update_buku($id_buku)
    {
        if (!$this->validate([
            'gambar_buku' => [
                'rules' => 'max_size[gambar_buku,3024]|is_image[gambar_buku]|mime_in[gambar_buku,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar maksimal 3mb',
                    'is_image' => 'yang anda masukan bukan gambar',
                    'mime_in' => 'yang anda masukan bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('admin/ubah_buku/' . $this->request->getVar('id_buku')))->withInput();
        }

        $gambar_buku = $this->request->getFile('gambar_buku');

        if ($gambar_buku->getError() == 4) {
            $namaGmbBuku = $this->request->getVar('gambar_lama');
        } else {
            $namaGmbBuku = $gambar_buku->getRandomName();
            $gambar_buku->move('assets/img/buku', $namaGmbBuku);

            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/img/buku/' . $this->request->getVar('gambar_lama'));
            }
        }

        $data = [
            'kode_buku' => $this->request->getVar('kode_buku'),
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'isbn' => $this->request->getVar('isbn'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'jumlah' => $this->request->getVar('jumlah'),
            'gambar_buku' => $namaGmbBuku
        ];

        $builder = $this->db->table('data_buku')->where('id_buku', $id_buku)->update($data);

        session()->setFlashdata('pesan_hijau', 'Data buku berhasil di ubah');
        return redirect()->to(site_url('admin/data_buku'));
    }

    public function hapus_buku($id_buku)
    {

        $cek_transaksi = $this->db->table('transaksi')->where('buku_id', $id_buku)->get()->getRowArray();

        if ($cek_transaksi) {
            session()->setFlashdata('pesan_merah', 'Data buku gagal di hapus karena ada aktifitas di dalam transaksi');
            return redirect()->to(site_url('admin/data_buku'));
        } else {
            $query = $this->bukuModel->where('id_buku', $id_buku)->first();
            // dd($query['gambar_buku']);

            if ($query['gambar_buku'] != 'default.jpg') {
                unlink('assets/img/buku/' . $query['gambar_buku']);
            }

            $this->bukuModel->where('id_buku', $id_buku)->delete();
            session()->setFlashdata('pesan_hijau', 'Data buku berhasil di hapus');
            return redirect()->to(site_url('admin/data_buku'));
        }
    }

    public function Mdelete_buku()
    {
        $id_buku = $this->request->getVar('id_buku');

        if ($id_buku == null) {
            session()->setFlashdata('pesan_merah', 'Centang data terlebih dahulu');
            return redirect()->to(site_url('admin/data_buku'));
        } else {

            $jml_data = count($id_buku);

            $no_sukses = 0;
            $no_gagal = 0;
            for ($i = 0; $i < $jml_data; $i++) {
                $cek_transaksi = $this->db->table('transaksi')->where('buku_id', $id_buku[$i])->get()->getRowArray();
                if ($cek_transaksi) {
                    $no_gagal++;
                } else {
                    $query = $this->bukuModel->where('id_buku', $id_buku[$i])->first();
                    if ($query['gambar_buku'] != 'default.jpg') {
                        unlink('assets/img/buku/' . $query['gambar_buku']);
                    }
                    $this->bukuModel->delete($id_buku[$i]);
                    $no_sukses++;
                }
            }
            $sukses = $no_sukses;
            $gagal = $no_gagal;
        }
        session()->setFlashdata('pesan_info', 'berhasil di hapus sebanyak ' . $sukses . ' gagal di hapus sebanyak ' . $gagal);
        return redirect()->to(site_url('admin/data_buku'));
    }

    public function kategori_buku()
    {
        $get_data = $this->db->table('kategori_buku')->get()->getResultArray();

        $data = [
            'tittle' => 'Kategori Buku',
            'kategori' => $get_data
        ];

        return view('admin/kategori_buku', $data);
    }

    public function save_kategori()
    {
        $nama_kategori = $this->request->getVar('nama_kategori');

        $cek_data = $this->db->table('kategori_buku')->where('nama_kategori', $nama_kategori)->get()->getRowArray();

        if ($cek_data) {
            session()->setFlashdata('pesan_merah', 'Data kategori sudah ada');
            return redirect()->to(site_url('admin/kategori_buku'));
        } else {
            $builder = $this->db->table('kategori_buku');
            $builder->insert(['nama_kategori' => $nama_kategori]);
            session()->setFlashdata('pesan_hijau', 'Data kategori berhasil di tambahkan');
            return redirect()->to(site_url('admin/kategori_buku'));
        }
    }

    public function update_kategori()
    {
        $id_kategori = $this->request->getVar('id_kategori');
        $nama_kategori = $this->request->getVar('nama_kategori');

        $cek_data = $this->db->table('kategori_buku')->where('nama_kategori', $nama_kategori)->get()->getRowArray();

        if ($cek_data) {
            session()->setFlashdata('pesan_merah', 'Data kategori sudah ada');
            return redirect()->to(site_url('admin/kategori_buku'));
        } else {
            $builder = $this->db->table('kategori_buku');
            $builder->where('id_kategori', $id_kategori)->update(['nama_kategori' => $nama_kategori]);
            session()->setFlashdata('pesan_hijau', 'Data kategori berhasil di update');
            return redirect()->to(site_url('admin/kategori_buku'));
        }
    }

    public function hapus_kategori($id_kategori)
    {
        $get_buku = $this->db->table('data_buku')->where('id_kategori', $id_kategori)->get()->getRowArray();

        if ($get_buku) {
            session()->setFlashdata('pesan_merah', 'Data gagal di hapus karena ada aktifitas di data buku');
            return redirect()->to(site_url('admin/kategori_buku'));
        } else {
            $hapus_data = $this->db->table('kategori_buku')->where('id_kategori', $id_kategori)->delete();
            session()->setFlashdata('pesan_hijau', 'Data kategori berhasil di hapus');
            return redirect()->to(site_url('admin/kategori_buku'));
        }
    }

    //Siswa siswa
    public function data_siswa()
    {
        $query = $this->db->table('data_siswa');
        $builder = $query->select('*');
        $builder->join('data_kelas', 'data_kelas.id_kelas = data_siswa.id_kelas');
        $get_data = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Data Siswa',
            'siswa' => $get_data
        ];

        return view('admin/data_siswa', $data);
    }

    public function tambah_siswa()
    {
        $query = $this->kelasModel->findAll();

        $data = [
            'tittle' => 'Tambah Data Siswa',
            'validation' => \Config\Services::validation(),
            'kelas' => $query
        ];

        return view('admin/tambah_siswa', $data);
    }

    public function save_Siswa()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|is_unique[data_siswa.nis]',
                'errors' => [
                    'required' => 'nis siswa harus di isi',
                    'is_unique' => 'nis siswa sudah terdaftar di database'
                ]
            ],
            'gambar_siswa' => [
                'rules' => 'max_size[gambar_siswa,3024]|is_image[gambar_siswa]|mime_in[gambar_siswa,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar maksimal 3mb',
                    'is_image' => 'yang anda masukan bukan gambar',
                    'mime_in' => 'yang anda masukan bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('admin/tambah_siswa'))->withInput();
        }
        $gambar_siswa = $this->request->getFile('gambar_siswa');

        if ($gambar_siswa->getError() == 4) {
            $namaGmbsiswa = 'default.jpg';
        } else {
            $namaGmbsiswa = $gambar_siswa->getRandomName();

            $gambar_siswa->move('assets/img/siswa', $namaGmbsiswa);
        }
        $data = [
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'jk' => $this->request->getVar('jk'),
            'gambar_siswa' => $namaGmbsiswa
        ];

        $this->siswaModel->insert($data);

        session()->setFlashdata('pesan_hijau', 'Data siswa berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_siswa'));
    }

    public function save_excel()
    {
        if (!$this->validate([
            'file_excel' => [
                'label' => 'Inputan File',
                'rules' => 'ext_in[file_excel,xls,xlsx]',
                'errors' => [
                    'ext_in' => '{field} bukan extensi xls atau xlsx'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan_merah', 'Inputan file bukan extensi xls atau xlsx');
            return redirect()->to(site_url('admin/data_siswa'))->withInput();
        }

        $file_excel = $this->request->getFile('file_excel');
        if ($file_excel == '') {
            session()->setFlashdata('pesan_merah', 'inputan file harus di isi');
            return redirect()->to(site_url('admin/data_siswa'));
        } else {
            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $render->load($file_excel);

            $data_simpan = $spreadsheet->getActiveSheet()->toArray();

            $jml_sukses = 0;
            $jml_erorr = 0;

            foreach ($data_simpan as $x => $row) {
                if ($x == 0) {
                    continue;
                }

                $builder = $this->db->table('data_kelas');
                $builder->where('nama_kelas', $row[3]);
                $cek_kelas = $builder->get()->getRowArray();

                if ($cek_kelas) {
                    $nis = $row[1];
                    $nama_siswa = $row[2];
                    $id_kelas = $cek_kelas['id_kelas'];
                    $alamat = $row[4];
                    $jk = $row[5];
                    $gambar_siswa = 'default.jpg';

                    $data_siswa = [
                        'nis' => $nis,
                        'nama' => $nama_siswa,
                        'id_kelas' => $id_kelas,
                        'alamat' => $alamat,
                        'jk' => $jk,
                        'gambar_siswa' => $gambar_siswa
                    ];
                    $builder = $this->db->table('data_siswa')->insert($data_siswa);
                    $jml_sukses++;
                } else {
                    $jml_erorr++;
                }
            }
        }
        session()->setFlashdata('pesan_hijau', 'data berhasil di import ' . $jml_sukses . ' data gagal di import' . $jml_erorr);
        return redirect()->to(site_url('admin/data_siswa'));
    }

    public function ubah_siswa($id_siswa)
    {
        $query = $this->db->table('data_siswa');
        $builder = $query->select('*');
        $builder->join('data_kelas', 'data_kelas.id_kelas = data_siswa.id_kelas');
        $builder->where('id_siswa', $id_siswa);
        $get_data = $builder->get()->getRowArray();

        $kelas = $this->kelasModel->findAll();

        // dd($get_data);

        $data = [
            'tittle' => 'Ubah Data Siswa',
            'siswa' => $get_data,
            'kelas' => $kelas,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/ubah_siswa', $data);
    }

    public function update_siswa($id_siswa)
    {
        if (!$this->validate([
            'gambar_siswa' => [
                'rules' => 'max_size[gambar_siswa,3024]|is_image[gambar_siswa]|mime_in[gambar_siswa,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar maksimal 3mb',
                    'is_image' => 'yang anda masukan bukan gambar',
                    'mime_in' => 'yang anda masukan bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(site_url('admin/tambah_siswa' . $this->request->getVar('id_siswa')))->withInput();
        }
        $gambar_siswa = $this->request->getFile('gambar_siswa');

        if ($gambar_siswa->getError() == 4) {
            $namaGmbsiswa = $this->request->getVar('gambar_lama');
        } else {
            $namaGmbsiswa = $gambar_siswa->getRandomName();

            $gambar_siswa->move('assets/img/siswa', $namaGmbsiswa);
            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/img/siswa/' . $this->request->getVar('gambar_lama'));
            }
        }
        $data = [
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'jk' => $this->request->getVar('jk'),
            'gambar_siswa' => $namaGmbsiswa
        ];

        $this->siswaModel->update($id_siswa, $data);

        session()->setFlashdata('pesan_hijau', 'Data siswa berhasil di ubah');
        return redirect()->to(site_url('admin/data_siswa'));
    }

    public function hapus_siswa($id_siswa)
    {
        $get = $this->siswaModel->where('id_siswa', $id_siswa)->first();

        if ($get['gambar_siswa'] != 'default.jpg') {
            unlink('assets/img/siswa/' . $get['gambar_siswa']);
        }

        $this->siswaModel->where('id_siswa', $id_siswa)->delete();

        session()->setFlashdata('pesan_hijau', 'Data siswa berhasil di hapus');
        return redirect()->to(site_url('admin/data_siswa'));
    }

    public function Mdelete_siswa()
    {
        $id_siswa = $this->request->getVar('id_siswa');

        if ($id_siswa == null) {
            session()->setFlashdata('pesan_merah', 'Centang terlebih dahulu data');
            return redirect()->to(site_url('admin/data_siswa'));
        } else {
            $jml_data = count($id_siswa);

            // dd($jml_data);

            for ($i = 0; $i < $jml_data; $i++) {
                $get = $this->siswaModel->where('id_siswa', $id_siswa[$i])->first();

                if ($get['gambar_siswa'] != 'default.jpg') {
                    unlink('assets/img/siswa/' . $get['gambar_siswa']);
                }

                $this->siswaModel->delete($id_siswa[$i]);
            }
        }

        session()->setFlashdata('pesan_hijau', 'Data siswa sebanyak ' . $jml_data . ' berhasil di hapus');
        return redirect()->to(site_url('admin/data_siswa'));
    }

    public function data_kelas()
    {
        $query = $this->kelasModel->findAll();

        $data = [
            'tittle' => 'Data Kelas',
            'kelas' => $query
        ];

        return view('admin/data_kelas', $data);
    }

    public function save_kelas()
    {

        $data = [
            'nama_kelas' => $this->request->getVar('nama_kelas')
        ];

        $this->kelasModel->insert($data);

        session()->setFlashdata('pesan_hijau', 'Data kelas berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_kelas'));
    }

    public function ubah_kelas($id_kelas)
    {
        $query = $this->kelasModel->where('id_kelas', $id_kelas)->first();

        $data = [
            'tittle' => 'Ubah data kelas',
            'validation' => \Config\Services::validation(),
            'kelas' => $query
        ];

        return view('admin/data_kelas', $data);
    }

    //Transaksi peminjaman
    public function transaksi()
    {
        $getRand_trans = 'PJM' . (rand(100, 200));

        $get_pinjam = date("Y-m-d");
        // dd($get_pinjam);

        $date = new DateTime(date("Y-m-d"));
        $date->modify('+7 day');
        $get_kembali = $date->format('Y-m-d');
        // dd($get_kembali);

        $get_idSiswa = $this->siswaModel->findAll();
        $get_idBuku = $this->bukuModel->findAll();
        $query = $this->transaksiModel->findAll();

        $data = [
            'tittle' => 'Transaksi Peminjaman Buku',
            'validation' => \Config\Services::validation(),
            'no_trans' => $getRand_trans,
            'siswa' => $get_idSiswa,
            'buku' => $get_idBuku,
            'pinjam' => $get_pinjam,
            'kembali' => $get_kembali,
            'transaksi' => $query
        ];

        return view('admin/transaksi', $data);
    }

    public function pinjam_buku()
    {
        if (!$this->validate([
            'id_siswa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis siswa harus di isi',
                ]
            ],
            'id_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kode buku harus di isi',
                ]
            ],
        ])) {
            return redirect()->to(site_url('admin/transaksi'))->withInput();
        }

        $get_siswa = $this->siswaModel->where('id_siswa', $this->request->getVar('id_siswa'))->first();
        $get_buku = $this->bukuModel->where('id_buku', $this->request->getVar('id_buku'))->first();
        $get_transaksi = $this->transaksiModel->where('siswa_id', $this->request->getVar('id_siswa'))->first();
        // dd($this->request->getVar('id_siswa'));

        if ($get_buku['jumlah'] == 0) {
            session()->setFlashdata('pesan_merah', 'Stok buku kosong atau sedang dipinjam');
            return redirect()->to(site_url('admin/transaksi'));
        }

        if ($get_transaksi != null) {
            if ($get_transaksi['terlambat'] != 0) {
                session()->setFlashdata('pesan_merah', 'Siswa dengan NIS ' . $get_siswa['nis'] . ' sedang meminjam buku dan sedaang terlambat ' . $get_transaksi['terlambat'] . ' hari. silahkan selesaikan dulu pengembalian buku');
                return redirect()->to(site_url('admin/transaksi'));
            } elseif ($get_transaksi['buku_id'] == $this->request->getVar('id_buku')) {
                session()->setFlashdata('pesan_merah', 'Tidak boleh meminjam buku lebih dari 1 dengan judul yang sama');
                return redirect()->to(site_url('admin/transaksi'));
            }
        }

        $builder = $this->db->table('data_buku');
        $builder->where('id_buku', $this->request->getVar('id_buku'));
        $kurangi_buku = $get_buku['jumlah'] - 1;
        $builder->set('jumlah', $kurangi_buku);
        $builder->update();

        $data = [
            'kode_transaksi' => $this->request->getVar('kode_transaksi'),
            'siswa_id' => $this->request->getVar('id_siswa'),
            'nis_siswa' => $get_siswa['nis'],
            'nama_siswa' => $get_siswa['nama'],
            'buku_id' => $this->request->getVar('id_buku'),
            'buku_kode' => $get_buku['kode_buku'],
            'judul_buku' => $get_buku['judul'],
            'tanggal_pinjam' => $this->request->getVar('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),
            'created_at' => Time::now()
        ];

        // dd($data);

        $this->transaksiModel->insert($data);
        session()->setFlashdata('pesan_hijau', 'Transaksi berhasil di lakukan');
        return redirect()->to(site_url('admin/transaksi'));
    }

    public function detail_peminjaman($kode_transaksi)
    {
        $builder = $this->db->table('transaksi');
        $builder->select('*');
        $builder->where('kode_transaksi', $kode_transaksi);
        $builder->join('data_siswa', 'data_siswa.id_siswa = transaksi.siswa_id');
        $builder->join('data_kelas', 'data_kelas.id_kelas = data_siswa.id_kelas');
        $builder->join('data_buku', 'data_buku.id_buku = transaksi.buku_id');
        $builder->join('kategori_buku', 'kategori_buku.id_kategori = data_buku.id_kategori');
        $query = $builder->get()->getRowArray();

        $now = Time::now();

        if ($now > $query['tanggal_kembali']) {
            $terlambat = date_diff(date_create($now), date_create($query['tanggal_kembali']))->format('%d');
            $builder = $this->db->table('transaksi');
            $builder->where('kode_transaksi', $kode_transaksi);
            $builder->set('status', 'terlambat');
            $builder->set('terlambat', $terlambat);
            $builder->update();
        } else {
            $builder = $this->db->table('transaksi');
            $builder->where('kode_transaksi', $kode_transaksi);
            $builder->set('status', 'dipinjam');
            $builder->set('terlambat', '0');
            $builder->update();
        }

        $data = [
            'tittle' => 'Detail Peminjaman',
            'detail' => $query
        ];

        return view('admin/detail_peminjaman', $data);
    }

    public function kembali_buku()
    {
        $data = [
            'r_kodeTr' => $this->request->getVar('r_kodeTr'),
            'r_nis' => $this->request->getVar('r_nis'),
            'r_nama' => $this->request->getVar('r_nama'),
            'r_kodeBuku' => $this->request->getVar('r_kodeBuku'),
            'r_judul' => $this->request->getVar('r_judul'),
            'r_pinjam' => $this->request->getVar('r_pinjam'),
            'r_kembali' => $this->request->getVar('r_kembali'),
            'r_status' => $this->request->getVar('r_status'),
            'r_terlambat' => $this->request->getVar('r_terlambat'),
            'created_at' => Time::now()
        ];

        $builder = $this->db->table('riwayat_peminjaman');
        $builder->insert($data);

        $builder = $this->db->table('data_buku');
        $builder->where('kode_buku', $this->request->getVar('r_kodeBuku'));
        $get_jml = $builder->get()->getRowArray();

        if ($get_jml['jumlah'] == 0) {
            $builder = $this->db->table('data_buku');
            $builder->where('kode_buku', $this->request->getVar('r_kodeBuku'));
            $builder->set('jumlah', $get_jml['jumlah'] + 1);
            $builder->update();
        } else {
            $builder = $this->db->table('data_buku');
            $builder->where('kode_buku', $this->request->getVar('r_kodeBuku'));
            $builder->set('jumlah', $get_jml['jumlah'] + 1);
            $builder->update();
        }

        $builder = $this->db->table('transaksi');
        $builder->where('id_transaksi',  $this->request->getVar('id_transaksi'));
        $builder->delete();

        session()->setFlashdata('pesan_hijau', 'Terimakasih sudah mengembalikan buku');
        return redirect()->to(site_url('admin/riwayat_peminjaman'));
    }

    public function riwayat_peminjaman()
    {
        $builder = $this->db->table('riwayat_peminjaman');
        $query = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Riwayat Peminjan',
            'riwayat' => $query
        ];

        return view('admin/riwayat_peminjaman', $data);
    }
}
