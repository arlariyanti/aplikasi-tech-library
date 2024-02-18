<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelUserAnggota;

class DashboardAnggota extends BaseController
{

    public function __construct()
    {
      $this->db = \Config\Database::connect();
        helper('form');
        $this->ModelUserAnggota = new ModelUserAnggota;
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Profile Anggota',
            'page' => 'v_dashboard_anggota',
            'useranggota' => $this->ModelUserAnggota->ProfileAnggota($id_user),
        ];
        return view('v_template_anggota', $data);
    }

    public function EditProfile()
    {
        $id_user = session()->get('id_user');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Edit Profile Anggota',
            'page' => 'v_edit_profile_anggota',
            'useranggota' => $this->ModelUserAnggota->ProfileAnggota($id_user),
            'id_user' => 'id_user'
        ];
        return view('v_template_anggota', $data); 
    }

    public function UpdateProfile($id_user)
    {
        if ($this->validate([
                'username'=> [
                  'label'=> 'Username',
                  'rules' => 'required',
                  'errors' => [
                    'required' => '{field} Masih Kosong !',
                   ]
                  ],
                    'password'=> [
                      'label'=> 'Password',
                      'rules' => 'required',
                      'errors' => [
                        'required' => '{field} Masih Kosong !',
                       ]
                      ],
                      'email'=> [
                        'label'=> 'Email',
                        'rules' => 'required',
                        'errors' => [
                          'required' => '{field} Masih Kosong !',
                         ]
                        ],
                      'alamat'=> [
                        'label'=> 'Alamat',
                        'rules' => 'required',
                        'errors' => [
                          'required' => '{field} Masih Kosong !',
                         ]
                        ],
                        'nomer_telpon'=> [
                          'label'=> 'No Telepon',
                          'rules' => 'required',
                          'errors' => [
                            'required' => '{field} Masih Kosong !',
                           ]
                          ],
                        'foto' => [
                            'label' => 'Foto User',
                            'rules' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]',
                            'errors' => [
                                'max_size' => '{field} Max 1024kb !',
                                'mime_in' => 'Format {field} Harus JPG Atau JPEG !'
                            ]
                            ],
                               
          ])) { 
      
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            if ($foto ->getError() == 4) {
                //jika tidak ganti gambar/foto
                $data = [
                    'id_user'=> $id_user,
                    'username'=>$this->request->getPost('username'),
                    'password'=>$this->request->getPost('password'),
                    'email'=>$this->request->getPost('email'),
                    'alamat'=>$this->request->getPost('alamat'),
                    'nomer_telpon'=>$this->request->getPost('nomer_telpon'),
                    'verifikasi'=>'1',
                    
                  ];
                  $this->ModelUserAnggota->EditData($data);
            } else {
                //hapus foto lama
                $useranggota = $this->ModelUserAnggota->DetailData($id_user);
                if ($useranggota['foto'] <> '' or $useranggota['foto'] <> null) {     
                }
                //jika foto diganti
                $nama_file = $foto->getRandomName();
                $data = [
                  'id_user'=> $id_user,
                  'username'=>$this->request->getPost('username'),
                  'password'=>$this->request->getPost('password'),
                  'email'=>$this->request->getPost('email'),
                  'alamat'=>$this->request->getPost('alamat'),
                  'nomer_telpon'=>$this->request->getPost('nomer_telpon'),
                  'verifikasi'=>'1',
                  'foto' => $nama_file,
                  
                ];
                $foto->move('foto', $nama_file);
                $this->ModelUserAnggota->EditData($data);
            }
            session()->setFlashdata('pesan','Data Anggota Berhasil DiUpdate!');
            return redirect()->to(base_url('DashboardAnggota/EditProfile'));
      
          } else {
             //jika tidak lolos validasi
             session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
             return redirect()->to(base_url('DashboardAnggota/EditProfile/'));
          } 
    }
}
