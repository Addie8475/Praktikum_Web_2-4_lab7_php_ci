<?php 
 
namespace App\Cells; 
 
use App\Models\ArtikelModel; 
 
class ArtikelTerkini extends \CodeIgniter\View\Cells\Cell 
{ 
    public function render(): string 
    { 
        try {
            $model = new ArtikelModel(); 
            $artikel = $model->where('status', 'active')->limit(5)->findAll(); 
        } catch (\Exception $e) {
            $artikel = [];
        }
         
        return view('components/artikel_terkini', ['artikel' => $artikel]); 
    } 
}