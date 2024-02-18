<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelUserAdmin;

class useradmin extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUserAdmin = new ModelUserAdmin;
    }

    public function index()
    {
        $data = [
            'judul' => 'User',
            'page' => 'user/v_index',
            'useradmin' => $this->ModelUserAdmin->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function AddData()
    {
        $data = [
            'judul' => 'Tambah Data User',
            'page' => 'user/v_adddata',
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
            'nama_admin' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|is_unique[admin.email]',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                        'is_unique' => '{field} Sudah Digunakan, Cari E-mail Lain !',
                    ]
                    ],   
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'no_hp' => [
                            'label' => 'No Handphone',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'level' => [
                                'label' => 'Level',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'foto' => [
                                    'label' => 'Foto User',
                                    'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg,image/ico]',
                                    'errors' => [
                                        'uploaded' =>'{field} Wajib Diisi !',
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,GIF,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'nama_admin' => $this->request->getPost('nama_admin'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $this->request->getPost('level'),
                'foto' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $foto->move('foto', $nama_file);
            $this->ModelUserAdmin->AddData($data);
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('useradmin'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('useradmin/AddData'))->withInput('validation',\Config\Services::validation());
        }
    }

    public function EditData($id_admin)
    {
        $data = [
            'judul' => 'Edit Data User',
            'page' => 'user/v_editdata',
            'useradmin' => $this->ModelUserAdmin->DetailData($id_admin),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_admin)
    {
        if ($this->validate([
            'nama_admin' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' =>'{field} Wajib Diisi !',
                ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                    ]
                    ],   
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'no_hp' => [
                            'label' => 'No Handphone',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'level' => [
                                'label' => 'Level',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                'foto' => [
                                    'label' => 'Foto User',
                                    'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg,image/ico]',
                                    'errors' => [
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,GIF,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');

            if ($foto->getError()== 4) {
                //jika tidak ganti foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_admin' => $id_admin,
                    'nama_admin' => $this->request->getPost('nama_admin'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $this->ModelUserAdmin->EditData($data);

            } else {
                //hapus foto lama
                $user = $this->ModelUserAdmin->DetailData($id_admin);
                if ($user['foto'] <> '') {   
                    unlink('foto/' .$user['foto']);  
                }
                //jika ganti gambar
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_admin' => $id_admin,
                    'nama_admin' => $this->request->getPost('nama_admin'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                    'foto' => $nama_file,
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $foto->move('foto', $nama_file);
                $this->ModelUserAdmin->EditData($data);
            }

            session()->setFlashdata('pesan','Data Berhasil Di Update');
            return redirect()->to(base_url('useradmin'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('useradmin/EditData/'. $id_admin));
        }

    }

    public function DeleteData($id_admin)
    {
         //hapus foto lama
         $useradmin = $this->ModelUserAdmin->DetailData($id_admin);
         if ($useradmin['foto'] <> '' or $useradmin['foto'] <> null) {     
         }
        $data = ['id_admin'=> $id_admin];
         $this->ModelUserAdmin->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
         return redirect()->to(base_url('useradmin'));
    }
}
