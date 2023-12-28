<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Home'
        ];
        return view('home', $data);
    }
}
