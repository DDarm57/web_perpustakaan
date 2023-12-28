<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $authModel;
    protected $db;
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->db = \Config\Database::connect();
    }
    public function login()
    {
        if (session()->get('log') == true) {
            return redirect()->to(site_url('/'));
        }

        $data = [
            'tittle' => 'LOGIN | PERPUS SMPN 3 OMBEN',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function cek_login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus di isi!!!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus di isi!!!'
                ]
            ]
        ])) {
            return redirect()->to(site_url('auth/login'))->withInput();
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $cek = $this->authModel->getLogin($username, $password);

        if ($cek) {
            session()->set('log', true);
            session()->set('id', $cek['id']);
            session()->set('username', $cek['username']);
            session()->set('password', $cek['password']);
            session()->set('full_name', $cek['full_name']);
            session()->set('user_image', $cek['user_image']);

            session()->setFlashdata('pesan_hijau', 'Berhasil login');
            return redirect()->to(site_url('/'));
        } else {
            session()->setFlashdata('pesan_merah', 'Password atau username salah');
            return redirect()->to(site_url('auth/login'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('id');
        session()->remove('username');
        session()->remove('password');
        session()->remove('full_name');
        session()->remove('full_image');

        if (session()->getFlashdata('pesan_update')) {
            session()->setFlashdata('pesan_hijau', 'Profile berhasil di update silahkan login kembali');
        } else {
            session()->setFlashdata('pesan_hijau', 'Logout Berhasil');
        }
        return redirect()->to(site_url('auth/login'));
    }
}
