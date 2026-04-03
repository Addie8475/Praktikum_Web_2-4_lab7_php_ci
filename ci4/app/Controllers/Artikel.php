<?php
namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/user/login')->with('flash_msg', 'Silakan login terlebih dahulu');
        }

        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();

        return view('index', compact('artikel', 'title'));
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];

        return view('Artikel/detail', compact('artikel', 'title'));
    }
    public function admin_index()  
    { 
        $title = 'Daftar Artikel'; 
        $model = new ArtikelModel(); 
        $artikel = $model->findAll(); 
        return view('admin_index', compact('artikel', 'title')); 
    }

    public function admin_home()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/user/login')->with('flash_msg', 'Silakan login terlebih dahulu');
        }

        // Optional: cek role admin jika ada penampung role di session
        if (session()->get('role') && session()->get('role') !== 'admin') {
            return redirect()->to('/user/artikel')->with('flash_msg', 'Hak akses admin dibatasi.');
        }

        $title = 'Admin Dashboard';
        $model = new ArtikelModel();
        $totalArtikel = $model->countAllResults();

        return view('admin_home', compact('title', 'totalArtikel'));
    }

    public function add()  
    { 
        // validasi data. 
        $validation =  \Config\Services::validation(); 
        $validation->setRules(['judul' => 'required']); 
        $isDataValid = $validation->withRequest($this->request)->run(); 
        
        if ($isDataValid) 
        { 
            $artikel = new ArtikelModel(); 
            $artikel->insert([ 
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'), 
            'slug' => url_title($this->request->getPost('judul')), 
        ]); 
        return redirect('admin/artikel'); 
    } 
    $title = "Tambah Artikel"; 
    return view('add', compact('title'));
    }
    public function edit($id)  
    { 
        $artikel = new ArtikelModel(); 
 
        // validasi data. 
        $validation =  \Config\Services::validation(); 
        $validation->setRules(['judul' => 'required']); 
        $isDataValid = $validation->withRequest($this->request)->run(); 
 
        if ($isDataValid) 
        { 
            $artikel->update($id, [ 
                'judul' => $this->request->getPost('judul'), 
                'isi' => $this->request->getPost('isi'), 
            ]); 
            return redirect('admin/artikel'); 
        } 
 
        // ambil data lama 
        $data = $artikel->where('id', $id)->first(); 
        $title = "Edit Artikel"; 
        return view('edit', compact('title', 'data')); 
    }
    public function delete($id)  
    { 
        $artikel = new ArtikelModel(); 
        $artikel->delete($id); 
        return redirect('admin/artikel'); 
    } 
}