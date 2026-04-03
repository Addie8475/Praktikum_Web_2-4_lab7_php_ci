<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    public function login()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Baca file users.js
                $filePath = FCPATH . 'js/users.js';
                if (!file_exists($filePath)) {
                    $session = session();
                    $session->setFlashdata('flash_msg', 'File data user tidak ditemukan');
                    return redirect()->to('/login');
                }
                
                $fileContent = file_get_contents($filePath);
                preg_match('/const users = (\[.*\]);/s', $fileContent, $matches);
                $users = json_decode($matches[1] ?? '[]', true);
                
                // Cari user berdasarkan email
                $user = null;
                foreach ($users as $u) {
                    if ($u['email'] === $this->request->getVar('email')) {
                        $user = $u;
                        break;
                    }
                }
                
                if ($user) {
                    if (password_verify($this->request->getVar('password'), $user['password'])) {
                        $session = session();
                        $session->set([
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'email' => $user['email'],
                            'isLoggedIn' => true,
                        ]);
                        return redirect()->to('/user/artikel');
                    } else {
                        $session = session();
                        $session->setFlashdata('flash_msg', 'Password salah');
                        return redirect()->to('/login');
                    }
                } else {
                    $session = session();
                    $session->setFlashdata('flash_msg', 'Email salah');
                    return redirect()->to('/login');
                }
            }
        }

        return view('user/login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function guest()
    {
        $session = session();
        $session->set([
            'id' => 0,
            'username' => 'Guest',
            'email' => 'guest@guest.local',
            'role' => 'guest',
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/user/artikel')->with('flash_msg', 'Login sebagai tamu berhasil.');
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'required|matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $data['username'] = $this->request->getVar('username');
                $data['email'] = $this->request->getVar('email');
            } else {
                // Baca file users.js
                $filePath = FCPATH . 'js/users.js';
                $fileContent = file_get_contents($filePath);
                
                // Parse JSON dari file (ambil bagian array)
                preg_match('/const users = (\[.*\]);/s', $fileContent, $matches);
                $users = json_decode($matches[1] ?? '[]', true);
                
                // Cek apakah email sudah ada
                $emailExists = false;
                $usernameExists = false;
                foreach ($users as $user) {
                    if ($user['email'] === $this->request->getVar('email')) {
                        $emailExists = true;
                    }
                    if ($user['username'] === $this->request->getVar('username')) {
                        $usernameExists = true;
                    }
                }
                
                if ($emailExists) {
                    $data['validation'] = $this->validator;
                    $data['validation']->setError('email', 'Email sudah terdaftar');
                    $data['username'] = $this->request->getVar('username');
                    $data['email'] = $this->request->getVar('email');
                    return view('user/register', $data);
                }
                
                if ($usernameExists) {
                    $data['validation'] = $this->validator;
                    $data['validation']->setError('username', 'Username sudah terdaftar');
                    $data['username'] = $this->request->getVar('username');
                    $data['email'] = $this->request->getVar('email');
                    return view('user/register', $data);
                }
                
                // Tambah user baru
                $newUser = [
                    'id' => count($users) + 1,
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
                $users[] = $newUser;
                
                // Tulis kembali ke file
                $newContent = 'const users = ' . json_encode($users, JSON_PRETTY_PRINT) . ';';
                $newContent .= "\n\n// Fungsi untuk mendapatkan user berdasarkan email (untuk client-side jika diperlukan)\nfunction getUserByEmail(email) {\n    return users.find(user => user.email === email);\n}\n\n// Fungsi untuk mengecek login (untuk client-side jika diperlukan)\nfunction checkLogin(email, password) {\n    const user = getUserByEmail(email);\n    if (user && user.password === password) { // Note: ini plain text, sebenarnya harus verify hash\n        return user;\n    }\n    return null;\n}";
                
                if (file_put_contents($filePath, $newContent)) {
                    // Set session langsung
                    $session = session();
                    $session->set([
                        'id' => $newUser['id'],
                        'username' => $newUser['username'],
                        'email' => $newUser['email'],
                        'isLoggedIn' => true,
                    ]);
                    
                    return redirect()->to('/user/artikel')->with('flash_msg', 'Pendaftaran berhasil! Selamat datang.');
                } else {
                    $data['validation'] = $this->validator;
                    $data['validation']->setError('register', 'Gagal menyimpan data. Silakan coba lagi.');
                    $data['username'] = $this->request->getVar('username');
                    $data['email'] = $this->request->getVar('email');
                    return view('user/register', $data);
                }
            }
        }

        return view('user/register', $data);
    }
}