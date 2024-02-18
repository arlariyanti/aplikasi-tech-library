<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUserAnggota extends Model
{
   public function ProfileUserAnggota($id_user)
   {
    return $this->db->table('user')
        // ->join('tbl_kelas','tbl_kelas.id_kelas = tbl_anggota.id_kelas', 'left')
        ->where('id_user', $id_user)
        ->get()->getRowArray();
   }

   public function AllData()
   {
       return $this->db->table('user')
    //    ->join('tbl_kelas','tbl_kelas.id_kelas = tbl_anggota.id_kelas', 'left')
       ->orderBy('id_user', 'DESC')
       ->get()->getResultArray();
   }

   public function EditData($data)
   {
       $this->db->table('user')
       ->where('id_user', $data['id_user'])
       ->update($data);
   }

   public function AddData($data)
   {
       $this->db->table('user')->insert($data);
   }

   public function DetailData($id_user)
   {
       return $this->db->table('user')
    //    ->join('tbl_kelas','tbl_kelas.id_kelas = tbl_anggota.id_kelas', 'left')
       ->where('id_user', $id_user)
       ->get()->getRowArray();
   }

   public function DeleteData($data)
   {
       $this->db->table('user')
       ->where('id_user', $data['id_user'])
       ->delete($data);
   }
}
