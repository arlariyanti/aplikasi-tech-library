<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelKategori;

class Kategori extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->ModelKategori = new ModelKategori;
    }

    public function index()
    {
        $data = [
            'judul' => 'Kategori',
            'page' => 'v_kategori',
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function Add()
    {
        $data = ['kategori'=>$this->request->getPost('kategori')];
        $this->ModelKategori->Add($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Kategori'));
    }

    public function EditData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'kategori'=>$this->request->getPost('kategori')
        ];
        $this->ModelKategori->EditData($data);
        session()->setFlashdata('pesan','Data Berhasil Di Update!');
        return redirect()->to(base_url('Kategori'));
    }

    public function DeleteData($id_kategori)
    {
        $data = ['id_kategori'=> $id_kategori];
        $this->ModelKategori->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
        return redirect()->to(base_url('Kategori'));
    }

}
