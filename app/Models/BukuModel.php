<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'data_buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = ['kode_buku', 'judul', 'pengarang', 'penerbit', 'isbn', 'id_kategori', 'tahun_terbit', 'rak_buku', 'jumlah', 'gambar_buku'];

    protected $useTimestamps = true;
}
