<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isEmpty;

class Menu_model extends Model
{
    protected $table = 'menu';
    protected $allowedFields = ['id_menu,nama_menu,gambar,deskripsi,id_kategori'];

    public function getMenu($id = false)
    {
        if ($id == false) {
            dd($this->findAll());
            return $this->findAll();
        } else {
            return $this->getWhere(['id_menu' => $id]);
        }
    }

    public function saveMenu($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editMenu($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_menu', $id);
        return $builder->update($data);
    }

    public function hapusMenu($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_menu' => $id]);
    }

    public function ambil_id()
    {
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(id_menu,4) AS idm', False);
        $builder->orderBy('id_menu', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $jumlah = $this->db->query('SELECT RIGHT(id_menu,4) AS idm FROM menu ORDER BY id_menu DESC LIMIT 1');
        $j = $jumlah->getNumRows();
        if (isEmpty($query->getRow())) {
            if ($j == 0) {
                $data = '00000';
                $kode = intval($data) + 1;
            } else {
                $data = $query->getRow();
                $kode = intval($data->idm) + 1;
            }
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "MENU" . $batas;
        return $kodetampil;
    }

    public function getKategoriMenu($idmenu)
    {
        $builder = $this->db->table('kategori')
            ->select('menu.id_menu,kategori.id_kategori,kategori.nama_kategori')
            ->join('menu', 'kategori.id_kategori=menu.id_kategori')
            ->where('menu.id_menu', $idmenu);
        $data = $builder->get()->getRow();
        return $data;
    }

    public function getKategori()
    {
        $builder = $this->db->table('kategori');
        $data = $builder->get()->getResult();
        return $data;
    }

    public function getJumlah()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAllResults();
        return $query;
    }

    public function search($keyword)
    {
        return $this->table('menu')->like('nama_menu', $keyword);
    }
}
