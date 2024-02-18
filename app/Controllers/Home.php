<?php

namespace App\Controllers;


use App\Models\ModelBuku;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
       
        $this->ModelBuku = new ModelBuku();
    }

    public function index()
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'buku' => $this->ModelBuku->Buku(),
        ];
        return view('v_template', $data);
    }

    // public function Sejarah()
    // {
    //     $data = [
    //         'judul' => 'Sejarah',
    //         'page' => 'v_sejarah',
    //         // 'profile' => $this->ModelPengaturan->DetailWeb(),
    //     ];
    //     return view('v_template', $data);
    // }

    // public function VisiMisi()
    // {
    //     $data = [
    //         'judul' => 'Visi & Misi',
    //         'page' => 'v_visi_misi',
    //         // 'profile' => $this->ModelPengaturan->DetailWeb(),
    //     ];
    //     return view('v_template', $data);
    // }

    public function GalleryBuku()
    {
        $data = [
            'judul' => 'Gallery Buku',
            'page' => 'v_gallery_buku',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template', $data);
    }
}
