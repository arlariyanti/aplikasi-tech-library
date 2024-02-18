<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUserAnggota;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;
use CodeIgniter\I18n\Time;

class Peminjaman extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUserAnggota = new ModelUserAnggota;
        $this->ModelBuku = new ModelBuku;
        $this->ModelPeminjaman = new ModelPeminjaman;
    }

    public function index()
    {
        
    }

    public function Pengajuan()
    {
        $id_user = session()->get('id_user');
        $data = [

            'judul' => 'Pengajuan Peminjaman Buku',
            'page' => 'peminjaman/v_pengajuan',
            'anggota' => $this->ModelUserAnggota->ProfileAnggota($id_user),
            'buku' => $this->ModelBuku->AllData(),
            'pengajuanbuku' => $this->ModelPeminjaman->PengajuanBuku($id_user),
        ];
        return view('v_template_anggota', $data);
    }

    public function AddPengajuan()
    {
        if ($this->validate([
            'id_buku' => [
                'label' => 'Judul Buku',
                'rules' =>'required',
                'errors' => [
                    'required' =>'{field} Wajib Dipilih !',
                ]
                ],   
        ])) {
            //mencari tanggal harus kembali 
            // $time = Time::parse($this->request->getPost('tanggal_peminjaman'));
            // $thn_pjm = $time->getYear();
            // $bln_pjm = $time->getMonth();
            // $tgl_pjm = $time ->getDay();
            // $lama_pinjam = $this->request->getPost('lama_pinjam');
            // $tgl_harus_kembali = date("Y-m-d",mktime(0,0,0,$bln_pjm,$tgl_pjm + $lama_pinjam,$thn_pjm));

            
            $data = [
                // 'tgl_pengajuan' => date('Y-m-d'),
                'id_user' => session()->get('id_user'),
                'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
                'id_buku' =>$this->request->getPost('id_buku'),
                // 'qty'=> '1',
                // 'lama_pinjam' => $this->request->getPost('lama_pinjam'),
                // 'tgl_harus_kembali' => $tgl_harus_kembali,
                'status_peminjaman' => 'Diajukan',
            ];
            $this->ModelPeminjaman->AddData($data);
            session()->setFlashdata('pesan','Buku Berhasil Diajukan!');
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
       
       
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Peminjaman/Pengajuan'));
        }
        
    }

    public function DeleteData($id_peminjaman)
    {
        $data = ['id_peminjaman'=> $id_peminjaman];
        $this->ModelPeminjaman->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
        return redirect()->to(base_url('Peminjaman/Pengajuan'));
    }

    public function PengajuanDiterima()
    {
        $id_user = session()->get('id_user');
        $data = [

            'judul' => 'Pengajuan Peminjaman Buku Diterima',
            'page' => 'peminjaman/v_diterima',
            'anggota' => $this->ModelUserAnggota->ProfileAnggota($id_user),
            'buku' => $this->ModelBuku->AllData(),
            'pengajuanditerima' => $this->ModelPeminjaman->PengajuanBukuDiterima($id_user),
        ];
        return view('v_template_anggota', $data);
    }

    public function PengajuanDitolak()
    {
        $id_user = session()->get('id_user');
        $data = [

            'judul' => 'Pengajuan Peminjaman Buku Ditolak',
            'page' => 'peminjaman/v_ditolak',
            'anggota' => $this->ModelUserAnggota->ProfileAnggota($id_user),
            'buku' => $this->ModelBuku->AllData(),
            'pengajuanditolak' => $this->ModelPeminjaman->PengajuanBukuDitolak($id_user),
        ];
        return view('v_template_anggota', $data);
    }
}
