<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
   public function TotalBuku()
   {
    return $this->db->table('buku')->countAll();
   }

   public function TotalUser()
   {
     return $this->db->table('user')->countAll();
   }

   public function TotalAdmin()
   {
     return $this->db->table('admin')->countAll();
   }

   public function TotalPengajuan()
   {
     return $this->db->table('peminjaman')->countAll();
   }
}
