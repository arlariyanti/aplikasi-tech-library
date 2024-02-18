<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuku extends Model
{
    public function AllData()
    {
        return $this->db->table('buku')
        ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
        ->orderBy('id_buku', 'DESC')
        ->get()->getResultArray();
    }

    public function DetailData($id_buku)
    {
        return $this->db->table('buku')
        ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
        ->where('id_buku', $id_buku)
        ->get()->getRowArray();
    }

    public function AddData($data)
    {
        $this->db->table('buku')->insert($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('buku')
        ->where('id_buku', $data['id_buku'])
        ->delete($data);
    }

    public function EditData($data)
    {
        $this->db->table('buku')
        ->where('id_buku', $data['judul'])
        ->update($data);
    }

    public function Buku()
    {
        return $this->db->table('buku')
        ->join('kategori','kategori.id_kategori = buku.id_kategori', 'left')
        ->orderBy('id_buku', 'DESC')
        ->limit(12)
        ->get()->getResultArray();
    }
}
