<?php

namespace App\Controllers;

use App\Models\Menu_model;

class Menu extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new Menu_model();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_menu') ? $this->request->getVar('page_menu') : 1;
        // dd($currentPage);
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $menu = $this->menuModel->search($keyword);
        } else {
            $menu = $this->menuModel;
        }

        $data = [
            'title' => 'Data Menu',
            'getMenu' => $menu->paginate(5, 'menu'),
            'pager' => $this->menuModel->pager,
            'ambil' => $this->menuModel->ambil_id(),
            'username' => $this->username,
            'currentPage' => $currentPage
        ];

        return view('master/menu/index', $data);
    }

    public function add()
    {
        $model = new Menu_model;
        $data = [
            'title' => 'Tambah Data Menu',
            'ambil' => $model->ambil_id(),
            'validation' => \Config\Services::validation(),
            'getKategori' => $model->getKategori(),
            'username' => $this->username
        ];

        return view('master/menu/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_menu' => [
                'rules' => 'required|is_unique[menu.nama_menu]',
                'errors' => [
                    'required' => 'nama menu harus diisi.',
                    'is_unique' => 'nama menu sudah terdaftar.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required[menu.deskripsi]',
                'errors' => [
                    'required' => 'deskripsi harus diisi.',
                    'is_unique' => 'deskripsi sudah terdaftar.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh melebihi 2 MB',
                    'is_image' => 'Upload File dengan ekstensi JPG/JPEG/PNG',
                    'mime_in' => 'Upload File dengan ekstensi JPG/JPEG/PNG.'
                ]
            ],
            'id_kategori' => [
                'rules' => 'required[menu.id_kategori]',
                'errors' => [
                    'required' => 'kategori harus diisi.',
                ]
            ]
        ])) {
            return redirect()->to('/master/menu/add')->withInput();
        }

        //ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        //jika tidak ada gambar yang diupload
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.png';
        } else {
            //generate nama gambar random
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('images', $namaGambar);
            $image = \Config\Services::image();
            $image->withFile('images/' . $namaGambar)
                ->fit('750', '500', 'center')
                ->save('images/' . $namaGambar);
        }

        $model = new Menu_model;
        $data = array(
            'id_menu' => $this->request->getPost('id_menu'),
            'nama_menu' => $this->request->getPost('nama_menu'),
            'gambar' => $namaGambar,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'id_kategori' => $this->request->getPost('id_kategori')
        );
        $model->saveMenu($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/master/menu');
    }

    public function edit($id)
    {
        $model = new Menu_model;
        $getMenu = $model->getMenu($id)->getRow();
        if (isset($getMenu)) {
            $data = [
                'title' => 'Ubah Data Menu',
                'menu' => $getMenu,
                'validation' => \Config\Services::validation(),
                'kategori' => $model->getKategori(),
                'selectkat' => $model->getKategoriMenu($id),
                'username' => $this->username
            ];
            return view('master/menu/edit', $data);
        } else {
            session()->set_flashdata('gagal', 'data tidak ditemukan');
            return redirect()->to('/master/menu');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_menu' => [
                'rules' => 'required[menu.nama_menu]',
                'errors' => [
                    'required' => 'nama menu harus diisi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required[menu.deskripsi]',
                'errors' => [
                    'required' => 'deskripsi harus diisi.'
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
            return redirect()->to('/master/menu/' . $id . '/edit')->withInput();
        }

        $id = $this->request->getPost('id_menu');
        $fileGambar = $this->request->getFile('gambar');

        // $namaGambar = '';
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $gambar = $this->menuModel->getMenu($id)->getRow()->gambar;
            if (file_exists(base_url() . '/images/' . $gambar)) {
                if ($gambar != 'default.png') {
                    unlink('images/' . $gambar);
                }
            }
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('images', $namaGambar);
            $image = \Config\Services::image();
            $image->withFile('images/' . $namaGambar)
                ->fit('750', '500', 'center')
                ->save('images/' . $namaGambar);
        }
        $model = new Menu_model;
        $data = array(
            'nama_menu'  => $this->request->getPost('nama_menu'),
            'gambar'     => $namaGambar,
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'id_kategori' => $this->request->getPost('id_kategori')
        );
        $model->editMenu($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/master/menu');
    }
    public function hapus($id)
    {
        $model = new Menu_model;
        $getMenu = $model->getMenu($id)->getRow();

        if ($getMenu->gambar != 'default.png') {
            unlink('images/' . $getMenu->gambar);
        }
        if (isset($getMenu)) {
            $model->hapusMenu($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');

            return redirect()->to('/master/menu');
        } else {
            $this->session->set_flashdata('gagal', 'menu ' . $id . 'tidak ditemukan');
            return redirect()->to('/master/menu');
        }
    }

    public function detail($id)
    {
        $model = new Menu_model;
        $getMenu = $model->getMenu($id)->getRow();
        $data = [
            'title' => 'Detail Menu',
            'menu' => $getMenu,
            'kategori' => $model->getKategoriMenu($id),
            'username' => $this->username,
        ];
        return view('/master/menu/detail', $data);
    }
}
