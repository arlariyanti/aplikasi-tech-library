<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ModelBuku;
use App\Models\ModelKategori;

class Buku extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelBuku = new ModelBuku;
        $this->ModelKategori = new ModelKategori;
    }

    public function index()
    {
        $data = [
            'judul' => 'Buku',
            'page' => 'buku/v_index',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function AddData()
    {
        $data = [
            'judul' => 'Add Buku',
            'page' => 'buku/v_adddata',
            'kategori' => $this->ModelKategori->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required|is_unique[buku.id_kategori]',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                        'is_unique' => '{field} Sudah Sudah Ada !',
                    ]
                    ],   
                    'judul' => [
                        'label' => 'Judul Buku',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'penulis' => [
                            'label' => 'Penulis',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'penerbit' => [
                                'label' => 'Penerbit',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                        'tahun_terbit' => [
                                            'label' => 'Tahun Terbit',
                                            'rules' => 'required',
                                            'errors' => [
                                                'required' =>'{field} Wajib Diisi !',
                                            ]
                                            ],
                                            'deskripsi' => [
                                                'label' => 'Deskripsi',
                                                'rules' => 'required',
                                                'errors' => [
                                                    'required' =>'{field} Wajib Diisi !',
                                                ]
                                                ],              
                                'cover' => [
                                    'label' => 'Cover Buku',
                                    'rules' => 'uploaded[cover]|max_size[cover,1024]|mime_in[cover,image/png,image/jpg,image/jpeg]',
                                    'errors' => [
                                        'uploaded' =>'{field} Wajib Diisi !',
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $cover = $this->request->getFile('cover');
            $nama_file = $cover->getRandomName();
            $data = [
                'id_kategori' => $this->request->getPost('id_kategori'),
                'judul' => $this->request->getPost('judul'),
                'penulis' => $this->request->getPost('penulis'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'cover' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $cover->move('cover', $nama_file);
            $this->ModelBuku->AddData($data);
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/AddData'))->withInput('validation',\Config\Services::validation());
        }
    }

    public function EditData($id_buku)
    {
        $data = [
            'judul' => 'Edit Buku',
            'page' => 'buku/v_editdata',
            'kategori' => $this->ModelKategori->AllData(),
            'buku' => $this->ModelBuku->DetailData($id_buku),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_buku)
    {
        if ($this->validate([
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Wajib Diisi !',
                    ]
                    ],   
                    'judul' => [
                        'label' => 'Judul Buku',
                        'rules' => 'required',
                        'errors' => [
                            'required' =>'{field} Wajib Diisi !',
                        ]
                        ],
                        'penulis' => [
                            'label' => 'Penulis',
                            'rules' => 'required',
                            'errors' => [
                                'required' =>'{field} Wajib Diisi !',
                            ]
                            ],
                            'penerbit' => [
                                'label' => 'Penerbit',
                                'rules' => 'required',
                                'errors' => [
                                    'required' =>'{field} Wajib Diisi !',
                                ]
                                ],
                                        'tahun_terbit' => [
                                            'label' => 'Tahun Terbit',
                                            'rules' => 'required',
                                            'errors' => [
                                                'required' =>'{field} Wajib Diisi !',
                                            ]
                                            ],
                                                    'deskripsi' => [
                                                        'label' => 'Deskripsi',
                                                        'rules' => 'required',
                                                        'errors' => [
                                                            'required' =>'{field} Wajib Diisi !',
                                                        ]
                                                        ],
                                'cover' => [
                                    'label' => 'Cover Buku',
                                    'rules' => 'max_size[cover,1024]|mime_in[cover,image/png,image/jpg,image/jpeg]',
                                    'errors' => [
                                        'max_size' => '{field} Max 1024kb !',
                                        'mime_in' => 'Format {field} Harus JPG,PNG,JPEG !'
                                    ]
                                    ],

        ])) {
            //jika lolos validasi
            $cover = $this->request->getFile('cover');
            if ($cover->getError()== 4) {
                //tanpa update cover
                $data = [
                'id_kategori' => $this->request->getPost('id_kategori'),
                'judul' => $this->request->getPost('judul'),
                'penulis' => $this->request->getPost('penulis'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                ];
                $this->ModelBuku->EditData($data);
            } else {
                //hapus cover lama
                $buku = $this->ModelBuku->DetailData($id_buku);
                if ($buku['cover'] <> '') {   
                    unlink('cover/' .$buku['cover']);  
                }
               //jika ganti cover 
               $nama_file = $cover->getRandomName();
               $data = [
                'id_kategori' => $this->request->getPost('id_kategori'),
                'judul' => $this->request->getPost('judul'),
                'penulis' => $this->request->getPost('penulis'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                   'cover' => $nama_file,
               ];
               //memindahkan/upload file foto ke dalam folder foto
               $cover->move('cover', $nama_file);
               $this->ModelBuku->EditData($data);
            }
            session()->setFlashdata('pesan','Data Berhasil Simpan');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/EditData/'.$id_buku))->withInput('validation',\Config\Services::validation());
        }
    }

    public function DeleteData($id_buku)
    {
         //hapus foto lama
         $buku = $this->ModelBuku->DetailData($id_buku);
         if ($buku['cover'] <> '' or $buku['cover'] <> null) {     
         }
        $data = ['id_buku'=> $id_buku];
         $this->ModelBuku->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus');
         return redirect()->to(base_url('Buku'));
    }

}
