<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    public function AddData($data)
   {
       $this->db->table('peminjaman')->insert($data);
   }

   public function PengajuanBuku($id_user)
   {
    return $this->db->table('peminjaman')
    ->join('buku','buku.id_buku = peminjaman.id_buku', 'left')
    ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
    ->where('id_user', $id_user)
    ->where('status_peminjaman', 'Diajukan')
    ->get()->getResultArray();
   }

   public function PengajuanBukuDiterima($id_user)
   {
    return $this->db->table('peminjaman')
    ->join('buku','buku.id_buku = peminjaman.id_buku', 'left')
    ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
    ->where('id_user', $id_user)
    ->where('status_peminjaman', 'Diterima')
    ->get()->getResultArray();
   }

   public function PengajuanBukuDitolak($id_user)
   {
    return $this->db->table('peminjaman')
    ->join('buku','buku.id_buku = peminjaman.id_buku', 'left')
    ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
    ->where('id_user', $id_user)
    ->where('status_peminjaman', 'Ditolak')
    ->get()->getResultArray();
   }

   public function DeleteData($data)
   {
       $this->db->table('peminjaman')
       ->where('id_peminjaman', $data['id_peminjaman'])
       ->delete($data);
   }

   //====================================bagian admin======================================

   public function PengajuanMasuk()
   {
    return $this->db->table('peminjaman')
    ->join('user','user.id_user = peminjaman.id_user', 'left')
    ->where('status_peminjaman', 'Diajukan')
    ->selectCount('peminjaman.id_user')
    ->select('user.id_user,user.username')
    ->groupBy('peminjaman.id_user')
    ->get()->getResultArray();
   }
   public function EditData($data)
   {
       $this->db->table('peminjaman')
       ->where('id_peminjaman', $data['id_peminjaman'])
       ->update($data);
   }

   public function PengajuanDiterima()
   {
    return $this->db->table('peminjaman')
    ->join('user','user.id_user = peminjaman.id_user', 'left')
    // ->join('tbl_kelas','tbl_kelas.id_kelas = user.id_kelas', 'left')
    ->where('status_peminjaman', 'Diterima')
    ->selectCount('peminjaman.id_user')
    ->select('user.id_user,user.username')
    ->groupBy('peminjaman.id_user')
    ->get()->getResultArray();
   }

   public function PengajuanDitolak()
   {
    return $this->db->table('peminjaman')
    ->join('user','user.id_user = peminjaman.id_user', 'left')
    // ->join('tbl_kelas','tbl_kelas.id_kelas = user.id_kelas', 'left')
    ->where('status_peminjaman', 'Ditolak')
    ->selectCount('peminjaman.id_user')
    ->select('user.id_user,user.username')
    ->groupBy('peminjaman.id_user')
    ->get()->getResultArray();
   }
}
