<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function LoginUser($email, $password)
    {
        return  $this->db->table('admin')
            ->where([
                'email' => $email,
                'password' => $password,
            ])->get()->getRowArray();
    }

    public function Daftar($data)
    {
        $this->db->table('user')->insert($data);
    }

    public function LoginAnggota($username, $password)
    {
        return  $this->db->table('user')
            ->where([
                'username' => $username,
                'password' => $password,
            ])->get()->getRowArray();
    }
}
