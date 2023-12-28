<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['kode_transaksi', 'siswa_id', 'nis_siswa', 'nama_siswa', 'buku_id', 'buku_kode', 'judul_buku', 'tanggal_pinjam', 'tanggal_kembali'];

    protected $useTimestamps = false;
}
