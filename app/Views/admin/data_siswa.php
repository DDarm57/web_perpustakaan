<?= $this->extend('layout/template'); ?>

<?= $this->section('page-content'); ?>

<?php if (session()->getFlashdata('pesan_hijau')) : ?>
    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
        <strong>Berhasil!!</strong> <?= session()->getFlashdata('pesan_hijau'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan_merah')) : ?>
    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
        <strong>Gagal!!</strong> <?= session()->getFlashdata('pesan_merah'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


<!-- DataTales Example -->
<div class="d-flex justify-content-start mb-2">
    <a href="<?= site_url('admin/tambah_siswa'); ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data</span>
    </a>
    <div class="px-2">
        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Import Data Siswa</span>
        </a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/Mdelete_siswa'); ?>" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="" id="centangSemuaSiswa"></th>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>JK</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($siswa as $b) : ?>
                            <tr>
                                <th><input type="checkbox" name="id_siswa[]" class="centangIdsiswa" value="<?= $b['id_siswa']; ?>"></th>
                                <td><?= $n++; ?></td>
                                <td><?= $b['nis']; ?></td>
                                <td><?= $b['nama']; ?></td>
                                <td><?= $b['nama_kelas']; ?></td>
                                <td><?= ($b['alamat'] == null ? '<p class="text-danger">kosong</p>' : $b['alamat']); ?></td>
                                <td><?= $b['jk']; ?></td>
                                <td><img src="/assets/img/siswa/<?= $b['gambar_siswa']; ?>" alt="" style="width: 100px;"></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= site_url('admin/ubah_siswa'); ?>/<?= $b['id_siswa']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="<?= site_url('admin/hapus_siswa'); ?>/<?= $b['id_siswa']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data')" class="btn btn-danger">Hapus Semua</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= site_url('admin/save_excel'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Contoh Import Data Yang Benar</h5>
                    <img src="/assets/contoh import.png" alt="" style="width: 100%;">
                    <div class="form-group">
                        <label for="">Input File Excel</label>
                        <input type="file" name="file_excel" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>