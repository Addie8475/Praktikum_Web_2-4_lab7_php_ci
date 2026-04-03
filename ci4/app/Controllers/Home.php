<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'   => 'Halaman Utama',
            'content' => 'Selamat datang di aplikasi CI4 dengan layout dan cell yang terhubung.',
        ];

        return view('home', $data);
    }
}
