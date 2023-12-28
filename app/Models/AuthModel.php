<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    public function getLogin($username, $password)
    {
        return $this->db->table('users')->where([
            'username' => $username,
            'password' => $password
        ])->get()->getRowArray();
    }
}
