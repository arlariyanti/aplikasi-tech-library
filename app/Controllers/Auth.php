<?php

namespace App\Controllers;

use App\Models\ModelAuth;


class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelAuth = new ModelAuth();
    }
    public function index()
    {
        $data = [
            'judul' => 'Login User',
            'page'  => 'v_login'
        ];
        return view('v_template_login', $data);
    }
  public function LoginUser()
  {
    $data = [
        'judul' => 'Login User',
        'page'  => 'v_login_user'
    ];
    return view('v_template_login', $data);
  }

  public function CekLoginUser()
  {
    if ($this->validate([
      'email'=> [
        'label'=> 'E-Mail',
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => '{field} Masih Kosong !',
          'valid_email' => '{field} Harus Format E-Mail !', 
        ]
        ],
        'password'=> [
          'label'=> 'Password',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Masih Kosong !',
  
           ]
          ]
    ])) {
      //jika entry valid
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cek_login = $this->ModelAuth->LoginUser($email, $password);
        if ($cek_login) {
          //jika login berhasil
            session()->set('id_admin', $cek_login['id_admin']);
            session()->set('nama_admin', $cek_login['nama_admin']);
            session()->set('email', $cek_login['email']);
            session()->set('level', $cek_login['level']);
            return redirect()->to(base_url('Admin'));
        } else {
          //jika gagal login karna password atau email salah
          session()->setFlashdata('pesan','E-Mail Atau Password Salah !');
          return redirect()->to(base_url('Auth/LoginUser'));
        }
    } else {
      //jika entry tidak valid
      session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
      return redirect()->to(base_url('Auth/LoginUser'));
    }
  }

  public function LoginAnggota()
  {
    $data = [
        'judul' => 'Login Anggota',
        'page'  => 'v_login_anggota'
    ];
    return view('v_template_login', $data);
  }

  public function LogOut()
  {
    session()->remove('id_admin');
    session()->remove('nama_admin');
    session()->remove('email');
    session()->remove('level');
    session()->setFlashdata('pesan','Logout Suksess !');
    return redirect()->to(base_url('Auth/LoginUser'));
  }

  public function LogOutAnggota()
  {
    session()->remove('id_user');
    session()->remove('nama');
    session()->remove('level');
    session()->setFlashdata('pesan','Logout Suksess !');
    return redirect()->to(base_url('Auth/LoginAnggota'));
  }

  public function Register()
  {
    $data = [
      'judul' => 'Daftar Anggota',
      'page'  => 'v_daftar_anggota',
  ];
  return view('v_template_login', $data);
  }

  public function Daftar()
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
                'ulangi_password'=> [
                  'label'=> 'Ulangi Password',
                  'rules' => 'required|matches[password]',
                  'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'matches' => '{field} Tidak Sama Dengan Password Sebelumnya !',
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
                         
    ])) { 

      //jika lolos validasi
      $data = [
        'username'=>$this->request->getPost('username'),
        'password'=>$this->request->getPost('password'),
        'email'=>$this->request->getPost('email'),
        'alamat'=>$this->request->getPost('alamat'),
        'nomer_telpon'=>$this->request->getPost('nomer_telpon'),
        'verifikasi'=>'0',
        
      ];
      $this->ModelAuth->Daftar($data);
      session()->setFlashdata('pesan','Pendaftran Berhasil ! Silahkan Login !');
      return redirect()->to(base_url('Auth/Register'));

    } else {
       //jika tidak lolos validasi
       session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
       return redirect()->to(base_url('Auth/Register'))->withInput('validation',\Config\Services::validation());
    } 
  }

  public function CekLoginAnggota()
  {
    if ($this->validate([
      'username'=> [
        'label'=> 'username',
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
          ]
    ])) {
      //jika entry valid
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $cek_login = $this->ModelAuth->LoginAnggota($username, $password);
        if ($cek_login) {
          //jika login berhasil
            session()->set('id_user', $cek_login['id_user']);
            session()->set('username', $cek_login['username']);
            session()->set('level', 'useranggota');
            return redirect()->to(base_url('DashboardAnggota'));
        } else {
          //jika gagal login karna password atau email salah
          session()->setFlashdata('pesan','Username Atau Password Salah !');
          return redirect()->to(base_url('Auth/LoginAnggota'));
        }
    } else {
      //jika entry tidak valid
      session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
      return redirect()->to(base_url('Auth/LoginAnggota'));
    }
  }
}
