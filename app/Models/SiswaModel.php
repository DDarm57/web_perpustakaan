<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'data_siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = ['nis', 'nama', 'id_kelas', 'alamat', 'jk', 'gambar_siswa'];

    protected $useTimestamps = true;
}
