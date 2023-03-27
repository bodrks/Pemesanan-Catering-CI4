<?php

namespace App\Controllers;

use App\Models\Admin_model;

class Admin extends BaseController
{
    private Admin_model $admin;

    public function __construct()
    {
        $this->admin  = new Admin_model();
        $this->admin->asObject();
    }
    public function index()
    {
        $model = new Admin_model;
        $data = [
            'title' => 'Data Admin',
            'getAdmin' => $model->getAdmin(),
            'username' => $this->username
        ];

        return view('master/admin/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Admin',
            'validation' => \Config\Services::validation(),
            'username' => $this->username
        ];
        return view('master/admin/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha|is_unique[admin.username]',
                'errors' => [
                    'required' => 'username harus diisi.',
                    'is_unique' => 'username sudah terdaftar.',
                    'alpha' => 'inputan hanya dapat karakter alfabet'
                ]
            ],
            'password' => [
                'rules' => 'required[admin.password]',
                'errors' => [
                    'required' => 'password harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[admin.email]',
                'errors' => [
                    'required' => 'email harus diisi.',
                    'is_unique' => 'email sudah terdaftar.'
                ]
            ],
            'nama_admin' => [
                'rules' => 'required|alpha|is_unique[admin.nama_admin]',
                'errors' => [
                    'required' => 'nama harus diisi.',
                    'is_unique' => 'nama sudah terdaftar.',
                    'alpha' => 'inputan hanya dapat alfabet'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|numeric|is_unique[admin.no_telp]',
                'errors' => [
                    'required' => 'nomor telepon harus diisi.',
                    'is_unique' => 'nomor telepon sudah terdaftar.',
                    'numeric' => 'inputan hanya dapat angka'
                ]
            ]
        ])) {
            return redirect()->to('/master/admin/add')->withInput();
        }
        $model = new Admin_model;
        $password = $this->request->getPost('password');
        $passwordx = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $passwordx,
            'email' => $this->request->getPost("email"),
            'nama_admin' => $this->request->getPost('nama_admin'),
            'no_telp' => $this->request->getPost('no_telp')
        ];
        $model->saveAdmin($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/master/admin');
    }

    public function edit($id)
    {
        $model = new Admin_model;
        $getAdmin = $model->getAdmin($id)->getRow();
        if (isset($getAdmin)) {
            $data = [
                'title' => 'Ubah Data Admin',
                'admin' => $getAdmin,
                'validation' => \Config\Services::validation(),
                'username' => $this->username
            ];
            return view('master/admin/edit', $data);
        } else {
            session()->setFlashdata('gagal', 'admin ' . $id . 'tidak ditemukan');
            return redirect()->to('/master/admin');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('username');
        $model = new Admin_model;
        $data = array(
            'nama_admin'  => $this->request->getPost('nama_admin'),
            'email' => $this->request->getPost("email"),
            'no_telp'     => $this->request->getPost('no_telp')
        );
        $model->editAdmin($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/master/admin');
    }
    public function hapus($id)
    {
        $model = new Admin_model;
        $getAdmin = $model->getAdmin($id)->getRow();
        if (isset($getAdmin)) {
            $model->hapusAdmin($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/master/admin');
        } else {
            session()->setFlashdata('gagal', 'admin ' . $id . 'tidak ditemukan');
            return redirect()->to('/master/admin');
        }
    }
}
