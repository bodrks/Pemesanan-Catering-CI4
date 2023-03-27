<?php

namespace App\Controllers;

use App\Models\Menu_model;
use App\Models\Paket_model;
use CodeIgniter\I18n\Time;

class Paket extends BaseController
{
    protected $menuModel;
    protected $paketModel;

    public function __construct()
    {
        $this->paketModel = new Paket_model();
        $this->menuModel = new Menu_model();
        helper(['form', 'number']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Paket',
            'getPaket' => $this->paketModel->getPaket(),
            'ambil' => $this->paketModel->ambil_id(),
            'username' => $this->username
        ];

        return view('master/paket/index', $data);
    }

    public function get_menu()
    {
        $kategori = $this->request->getPost('id_kategori');
        $data = $this->paketModel->menuKategori($kategori);
        echo json_encode($data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Paket',
            'ambil' => $this->paketModel->ambil_id(),
            'validation' => \Config\Services::validation(),
            'menu' => $this->paketModel->ambilMenu(),
            'username' => $this->username
        ];
        return view('master/paket/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_paket' => [
                'rules' => 'required|is_unique[paket.nama_paket]',
                'errors' => [
                    'required' => 'nama paket harus diisi.',
                    'is_unique' => 'nama paket sudah terdaftar'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required[paket.deskripsi]',
                'errors' => [
                    'required' => 'deskripsi harus diisi.',
                    'is_unique' => 'deskripsi sudah terdaftar.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh melebihi 2 MB',
                    'is_image' => 'File yang anda upload bukan berupa gambar.',
                    'mime_in' => 'File yang anda upload bukan berupa gambar.'
                ]
            ],
            'harga' => [
                'rules' => 'required[paket.harga]',
                'errors' => [
                    'required' => 'harga harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to('/master/paket/add')->withInput();
        }

        if ($this->request->getPost('id_menu') == null) {
            session()->setFlashdata('gagal', 'Anda belum mengisi menu yang terdapat pada paket ini.');
            return redirect()->to('/master/paket/add')->withInput();
        }

        // //ambil gambar
        $fileGambar = $this->request->getFile('gambar.0');
        // dd($fileGambar);
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.png';
        } else {
            //generate nama gambar random
            $namaGambar = $fileGambar->getName();
        }


        $data = array(
            'id_paket' => $this->request->getPost('id_paket'),
            'nama_paket' => $this->request->getPost('nama_paket'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $namaGambar
        );
        $this->paketModel->savePaket($data);
        $detail = $this->request->getPost('id_menu');
        $params = [];
        foreach ($detail as $key => $menu) {
            array_push(
                $params,
                array(
                    'id_paket' => $this->request->getPost('id_paket'),
                    'id_menu' => $menu
                )
            );
        }
        $this->paketModel->tambah_detailpaket($params);

        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['gambar'] as $key => $img) {
                // if ($img->isValid()) {
                    $newName = $img->getName();
                    $data = [
                        'id_paket' => $this->request->getPost('id_paket'),
                        'gambar_paket' => $newName,
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
                    $this->paketModel->insert_gambar($data);
                    $img->move('images', $newName);
                    $image = \Config\Services::image();
                    $image->withFile('images/' . $newName)
                        ->fit('650', '500', 'center')
                        ->save('images/' . $newName);
                }
            }
        }
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/master/paket');
    }

    public function tambahDetail()
    {
        $id_paket = $this->request->getPost('id_paket');
        $menu[] = $this->request->getPost('menu');
        $jmlitem = $this->request->getPost('jmlitem');
        $itm = (int)$jmlitem;
        for ($i = 0; $i < $itm; $i++) {
            $data = [
                'id_menu' => $menu[$i][0],
                'id_paket' => $id_paket
            ];
            $this->paketModel->tambah_detailpaket($data);
        }
        echo json_encode("");
    }

    public function edit($id)
    {
        $getPaket = $this->paketModel->getPaket($id)->getRow();
        $getMenu = $this->paketModel->dataMenu($id);
        if (isset($getPaket)) {
            $data = [
                'title' => 'Ubah Data Paket',
                'paket' => $getPaket,
                'menu' => $getMenu,
                'datamenu' => $this->paketModel->ambilMenu(),
                'validation' => \Config\Services::validation(),
                'username' => $this->username
            ];
            return view('master/paket/edit', $data);
        } else {
            session()->setFlashdata('gagal', 'Paket ' . $id . ' tidak ditemukan');
            return redirect()->to('/master/paket');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_paket' => [
                'rules' => 'required[paket.nama_paket]',
                'errors' => [
                    'required' => 'nama paket harus diisi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required[paket.deskripsi]',
                'errors' => [
                    'required' => 'deskripsi harus diisi.'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh melebihi 2 MB',
                    'is_image' => 'File yang anda upload bukan berupa gambar.',
                    'mime_in' => 'File yang anda upload bukan berupa gambar.'
                ]
            ]
        ])) {
            return redirect()->to('/master/paket/' . $id . '/edit')->withInput();
        }

        if ($this->request->getPost('id_menu') == null) {
            session()->setFlashdata('gagal', 'Menu tidak boleh kosong.');
            return redirect()->to('/master/paket/' . $id . '/edit')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar.0');
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $namaGambar = $fileGambar->getName();
            $gambar_paket = $this->paketModel->get_gambar_by_id_paket($id);
            if ($gambar_paket != null) {
                foreach ($gambar_paket as $key => $value) {
                    unlink('images/' . $value->gambar_paket);
                }
                $this->paketModel->delete_gambar_by_id($id);
            }
        }

        $data = array(
            'nama_paket'  => $this->request->getPost('nama_paket'),
            'gambar'     => $this->request->getPost('harga'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar'     => $namaGambar
        );
        $this->paketModel->editPaket($data, $id);

        $detail = $this->request->getPost('id_menu');
        $params = [];
        foreach ($detail as $key) {
            array_push(
                $params,
                array(
                    'id_paket' => $id,
                    'id_menu' => $key
                )
            );
            $this->paketModel->hapusDetail($id);
            $this->paketModel->tambah_detailpaket($params, $id);
        }

        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['gambar'] as $key => $img) {
                if ($img->isValid()) {
                    $newName = $img->getName();
                    $data = [
                        'id_paket' => $this->request->getPost('id_paket'),
                        'gambar_paket' => $newName,
                        'updated_at' => date('Y-m-d h:i:s')
                    ];
                    $this->paketModel->insert_gambar($data);
                    $img->move('images', $newName);
                    $image = \Config\Services::image();
                    $image->withFile('images/' . $newName)
                        ->fit('650', '500', 'center')
                        ->save('images/' . $newName);
                }
            }
        }
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/master/paket');
    }
    public function hapus($id)
    {
        $getPaket = $this->paketModel->getPaket($id)->getRow();
        // dd($getPaket->gambar);   
        if ($getPaket->gambar != 'default.png') {
            $gambar_paket = $this->paketModel->get_gambar_by_id_paket($id);
            if ($gambar_paket != null) {
                foreach ($gambar_paket as $key => $value) {
                    unlink('images/' . $value->gambar_paket);
                }
            }
        }
        if (isset($getPaket)) {
            $this->paketModel->hapusPaket($id);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/master/paket');
        } else {
            session()->setFlashdata('gagal', 'Paket ' . $id . ' tidak ditemukan');
        }
    }

    public function detail($id)
    {
        $getPaket = $this->paketModel->getPaket($id)->getRow();
        $getMenu = $this->paketModel->dataMenu($id);
        $data = [
            'title' => 'Detail Paket',
            'paket' => $getPaket,
            'menu' => $getMenu,
            'username' => $this->username,
            'gambar' => $this->paketModel->get_gambar_by_id_paket($id)
        ];
        $gambar = $this->paketModel->get_gambar_by_id_paket($id);
        // dd($gambar[0]->gambar_paket);
        return view('/master/paket/detail', $data);
    }
}
