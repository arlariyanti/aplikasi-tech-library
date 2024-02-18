<?php

namespace App\Controllers;

use App\Models\ModelAdmin;
use App\Models\ModelPeminjaman;

class Admin extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAdmin= new ModelAdmin;
        $this->ModelPeminjaman= new ModelPeminjaman;
    }

    public function index()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Dashboard',
            'page' => 'v_dashboard_admin',
            'totaluseranggota' => $this->ModelAdmin->totalUser(),
            'totalbuku' => $this->ModelAdmin->totalBuku(),
            'totaluseradmin' => $this->ModelAdmin->totalAdmin(),
            'totalpengajuan' => $this->ModelAdmin->totalPengajuan(),
        ];
        return view('v_template_admin', $data);
    }

    public function PengajuanMasuk()
    {
        $data = [
            'judul' => 'Pengajuan Masuk',
            'page' => 'peminjaman/v_pengajuan_masuk',
            'pengajuanmasuk' => $this->ModelPeminjaman->PengajuanMasuk(),
        ];
        return view('v_template_admin', $data);
    }

    public function TolakBuku($id_peminjaman)
    {
        $data = [
            'id_peminjaman' => $id_peminjaman,
            'status_pinjam'=>'Ditolak',
            'ket'=>$this->request->getPost('ket'),
        ];
        $this->ModelPeminjaman->EditData($data);
        session()->setFlashdata('ditolak','Buku Berhasil Ditolak!');
        return redirect()->to(base_url('Admin/PengajuanMasuk'));
    }

    public function TerimaBuku($id_peminjaman)
    {
        $data = [
            'id_peminjaman' => $id_peminjaman,
            'status_pinjam'=>'Diterima',
        ];
        $this->ModelPeminjaman->EditData($data);
        session()->setFlashdata('diterima','Pengajuan Peminjaman Buku Diterima');
        return redirect()->to(base_url('Admin/PengajuanMasuk'));
    }

    public function PengajuanDiterima()
    {
        $data = [
            'judul' => 'Pengajuan Diterima',
            'page' => 'peminjaman/v_pengajuan_diterima',
            'pengajuanditerima' => $this->ModelPeminjaman->PengajuanDiterima(),
        ];
        return view('v_template_admin', $data);
    }

    public function PengajuanDitolak()
    {
        $data = [
            'judul' => 'Pengajuan Ditolak',
            'page' => 'peminjaman/v_pengajuan_ditolak',
            'pengajuanditolak' => $this->ModelPeminjaman->PengajuanDitolak(),
        ];
        return view('v_template_admin', $data);
    }
}
