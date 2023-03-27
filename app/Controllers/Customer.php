<?php

namespace App\Controllers;

use App\Models\Customer_model;

class Customer extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customer_model();
        $this->customerModel->asObject();
    }
    public function index()
    {
        $model = new Customer_model;
        $data = [
            'title' => 'Data Customer',
            'getCustomer' => $model->getCustomer(),
            'username' => $this->username
        ];
        return view('master/customer/index', $data);
    }

    public function add()
    {
        $model = new Customer_model;
        $data = [
            'title' => 'Tambah Data Customer',
            'ambil' => $model->ambil_id(),
            'validation' => \Config\Services::validation(),
            'username' => $this->username
        ];
        return view('master/customer/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required[customer.nama]',
                'errors' => ['required' => 'nama customer harus diisi']
            ],
            'username' => [
                'rules' => 'required|is_unique[customer.username]',
                'errors' => [
                    'required' => 'username harus diisi.',
                    'is_unique' => 'username sudah terdaftar.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[customer.email]',
                'errors' => [
                    'required' => 'email harus diisi.',
                    'is_unique' => 'email sudah terdaftar.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|is_unique[customer.no_telp]',
                'errors' => [
                    'required' => 'nomor telepon harus diisi.',
                    'is_unique' => 'nomor telepon sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required[customer.password]',
                'errors' => ['required' => 'password harus diisi.']
            ],
            'alamat' => [
                'rules' => 'required[customer.alamat]',
                'errors' => ['required' => 'alamat harus diisi.']
            ]
        ])) {
            return redirect()->to('/master/customer/add')->withInput();
        }

        //ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        //jika tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.png';
        } else {
            $namaGambar = $fileGambar->getName();
            $fileGambar->move('user_images', $namaGambar);
        }

        $password = $this->request->getPost('password');
        $passwordx = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'id_customer' => $this->request->getPost('id_customer'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'no_telp' => $this->request->getPost('no_telp'),
            'password' => $passwordx,
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar
        );

        $this->customerModel->saveCustomer($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/master/customer');
    }

    public function edit($id)
    {
        $model = new Customer_model;
        $getCustomer = $model->getCustomer($id)->getRow();
        if (isset($getCustomer)) {
            $data = [
                'title' => 'Ubah Data Customer',
                'customer' => $getCustomer,
                'validation' => \Config\Services::validation(),
                'username' => $this->username
            ];
            return view('master/customer/edit', $data);
        } else {
            session()->setFlashdata('gagal', 'customer' . $id . 'tidak ditemukan');
            return redirect()->to('/master/customer');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required[customer.nama]',
                'errors' => [
                    'required' => 'nama harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required[customer.alamat]',
                'errors' => [
                    'required' => 'alamat harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required[customer.email]',
                'errors' => [
                    'required' => 'email harus diisi.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
                    'is_image' => 'Upload File dengan ekstensi JPG/JPEG/PNG.',
                    'mime_in' => 'Upload File dengan ekstensi JPG/JPEG/PNG.'
                ]
            ]
        ])) {
            return redirect()->to('/master/customer/' . $id . '/edit')->withInput();
        }

        $model = new Customer_model;

        $id = $this->request->getPost('id_customer');
        //ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        //jika tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('user_images', $namaGambar);
        }


        $data = array(
            'nama'  => $this->request->getPost('nama'),
            'email'     => $this->request->getPost('email'),
            'no_telp'     => $this->request->getPost('no_telp'),
            'alamat'     => $this->request->getPost('alamat'),
            'gambar'      => $namaGambar
        );
        $model->editCustomer($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/master/customer');
    }

    public function hapus($id)
    {
        $model = new Customer_model;
        $getCustomer = $model->getCustomer($id)->getRow();
        if (isset($getCustomer)) {
            $model->hapusCustomer($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/master/customer');
        } else {
            session()->setFlashdata('gagal', 'customer' . $id . ' tidak ditemukan');
            return redirect()->to('master/customer');
        }
    }

    public function detail($id)
    {
        $model = new Customer_model;
        $getCustomer = $model->getCustomer($id)->getRow();
        $data = [
            'title' => 'Detail Customer',
            'customer' => $getCustomer,
            'username' => $this->username
        ];
        return view('/master/customer/detail', $data);
    }
}
