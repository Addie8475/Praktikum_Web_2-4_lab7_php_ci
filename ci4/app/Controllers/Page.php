<?php
namespace App\Controllers;

class Page extends BaseController
{
    protected function renderPage(string $title, string $text)
    {
        return view('page/template', [
            'title'   => $title,
            'content' => $text,
        ]);
    }

    public function about()
    {
        return $this->renderPage('About', 'Ini halaman About. Di sini kamu bisa menampilkan informasi tentang situs.');
    }

    public function contact()
    {
        return $this->renderPage('Contact', 'Ini halaman Contact. Bisa diisi dengan alamat, telepon, atau form kontak.');
    }

    public function faqs()
    {
        return $this->renderPage('FAQ', 'Ini halaman FAQ. Cantumkan pertanyaan umum di sini.');
    }

    public function artikel()
    {
        return $this->renderPage('Artikel', 'Ini halaman Artikel. Menampilkan daftar artikel atau ringkasan.');
    }
}

use App\Models\UserModel; 
 
class User extends BaseController 
{ 
    public function index()  
    { 
        $title = 'Daftar User'; 
        $model = new UserModel(); 
        $users = $model->findAll(); 
        return view('user/index', compact('users', 'title')); 
    } 
 
    public function login() 
    { 
        helper(['form']); 
        $email = $this->request->getPost('email'); 
        $password = $this->request->getPost('password'); 
        if (!$email) 
        { 
            return view('user/login'); 
        } 
 
        $session = session(); 
        $model = new UserModel(); 
        $login = $model->where('useremail', $email)->first(); 
        if ($login) 
        { 
            $pass = $login['userpassword']; 
            if (password_verify($password, $pass)) 
            { 
                $login_data = [ 
                    'user_id' => $login['id'], 
                    'user_name' => $login['username'], 
                    'user_email' => $login['useremail'], 
                    'logged_in' => TRUE, 
                ]; 
                $session->set($login_data); 
                return redirect('admin/artikel'); 
            } 
            else  
            { 
                $session->setFlashdata("flash_msg", "Password salah."); 
                return redirect()->to('/user/login'); 
            } 
        } 
        else 
        { 
            $session->setFlashdata("flash_msg", "email tidak terdaftar."); 
            return redirect()->to('/user/login'); 
        } 
    } 
} 