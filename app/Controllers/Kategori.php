<?php

namespace App\Controllers;

use App\Models\Kategori_model;

class Kategori extends BaseController
{
    private Kategori_model $kategori;

    public function __construct()
    {
        $this->kategori = new Kategori_model();
        $this->kategori->asObject();
    }
    public function index()
    {
        $model = new Kategori_model;
        $data = [
            'title' => 'Data Kategori',
            'getKategori' => $model->getKategori(),
        ];
        return view('master/kategori/index', $data);
    }

    public function add()
    {
        $model = new Kategori_model;
        $data = [
            'title' => 'Tambah Data Kategori',
            'ambil' => $model->ambil_id(),
            'validation' => \Config\Services::validation()
        ];
        return view('master/kategori/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'required' => 'nama kategori harus diisi.',
                    'is_unique' => 'nama kategori sudah terdaftar.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/master/kategori/add')->withInput()->with('validation', $validation);
        }
        $model = new Kategori_model;
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];
        $model->saveKategori($data);
        echo '<script>
                alert("Data berhasil ditambahkan.");
                window.location="' . base_url('master/kategori') . '"
            </script>';
    }

    public function edit($id)
    {
        $model = new Kategori_model;
        $getKategori = $model->getKategori($id)->getRow();
        if (isset($getKategori)) {
            $data = [
                'title' => 'Ubah Data Kategori',
                'kategori' => $getKategori,
                'validation' => \Config\Services::validation()
            ];
            return view('master/kategori/edit', $data);
        } else {
            echo '<script>
            alert("id_kategori ' . $id . ' Tidak ditemukan");
            window.location="' . base_url('master/kategori') . '"
        </script>';
        }
    }

    public function update()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'required' => 'nama kategori harus diisi.',
                    'is_unique' => 'nama kategori sudah terdaftar.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/master/kategori/update')->withInput()->with('validation', $validation);
        }
        $model = new Kategori_model;
        $id = $this->request->getPost('id_kategori');
        $data = array(
            'nama_kategori'  => $this->request->getPost('nama_kategori'),
        );
        $model->editKategori($data, $id);
        echo '<script>
                alert("Update Berhasil.");
                window.location="' . base_url('master/kategori') . '"
            </script>';
    }
    public function hapus($id)
    {
        $model = new Kategori_model;
        $getKategori = $model->getKategori($id)->getRow();
        if (isset($getKategori)) {
            $model->hapusKategori($id);
            echo '<script>
                    alert("Data terhapus.");
                    window.location="' . base_url('master/kategori') . '"
                </script>';
        } else {
            echo '<script>
                    alert("Gagal Menghapus !, id_kategori ' . $id . ' Tidak ditemukan");
                    window.location="' . base_url('master/kategori') . '"
                </script>';
        }
    }
}
