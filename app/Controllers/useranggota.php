<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelUserAnggota;

class useranggota extends BaseController
{

    public function __construct()
    {
      $this->db = \Config\Database::connect();
        helper('form');
        $this->ModelUserAnggota = new ModelUserAnggota;
    }

    public function index()
    {
        $data = [
            'judul' => 'Anggota',
            'page' => 'anggota/v_index',
            'useranggota' => $this->ModelUserAnggota->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function Verifikasi($id_user)
    {
        $data = [
            'id_user' => $id_user,
            'verifikasi'=>'1',
        ];
        $this->ModelUserAnggota->EditData($data);
        session()->setFlashdata('pesan','Anggota Berhasil Di Verifikasi!');
        return redirect()->to(base_url('useranggota'));
    }

    public function AddData()
    {
        $data = [
            'judul' => 'Tambah Data User',
            'page' => 'anggota/v_adddata',
            
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
              'username'=> [
                'label'=> 'Username',
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                  'required' => '{field} Masih Kosong !',
                  'is_unique' => '{field} Sudah Terdaftar !',
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
                            'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]',
                            'errors' => [
                                'uploaded' =>'{field} Wajib Diisi !',
                                'max_size' => '{field} Max 1024kb !',
                                'mime_in' => 'Format {field} Harus JPG Atau JPEG !'
                            ]
                            ],
                               
          ])) { 
      
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
              'username'=>$this->request->getPost('username'),
              'password'=>$this->request->getPost('password'),
              'email'=>$this->request->getPost('jenis_kelamin'),
              'alamat'=>$this->request->getPost('alamat'),
              'nomer_telpon'=>$this->request->getPost('password'),
              'verifikasi'=>'1',
              'foto' => $nama_file,
              
            ];
            $foto->move('foto', $nama_file);
            $this->ModelUserAnggota->AddData($data);
            session()->setFlashdata('pesan','Data Anggota Berhasil Disimpan!');
            return redirect()->to(base_url('useranggota/AddData'));
      
          } else {
             //jika tidak lolos validasi
             session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
             return redirect()->to(base_url('useranggota/AddData'))->withInput('validation',\Config\Services::validation());
          } 
    }

    public function EditData($id_user)
    {
        $data = [
            'judul' => 'Edit Data Anggota',
            'page' => 'anggota/v_editdata',
            'useranggota' => $this->ModelUserAnggota->DetailData($id_user),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_user)
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
            return redirect()->to(base_url('useranggota'));
      
          } else {
             //jika tidak lolos validasi
             session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
             return redirect()->to(base_url('useranggota/EditData/'. $id_user));
          } 
    }

    public function DeleteData($id_user)    {
         //hapus foto lama
                $useranggota = $this->ModelUserAnggota->DetailData($id_user);
                if ($useranggota['foto'] <> '' or $useranggota['foto'] <> null) {     
                }
        $data = ['id_user'=> $id_user];
        $this->ModelUserAnggota->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
        return redirect()->to(base_url('useranggota'));
    }

}
