<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUserAdmin extends Model
{
    public function AllData()
    {
        return $this->db->table('admin')
        ->orderBy('id_admin', 'DESC')
        ->get()->getResultArray();
    }

    public function DetailData($id_admin)
    {
        return $this->db->table('admin')
        ->where('id_admin', $id_admin)
        ->get()
        ->getRowArray();
    }

    public function AddData($data)
    {
        $this->db->table('admin')->insert($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('admin')
        ->where('id_admin', $data['id_admin'])
        ->delete($data);
    }

    public function EditData($data)
    {
        $this->db->table('admin')
        ->where('id_admin', $data['id_admin'])
        ->update($data);
    }
    
}
