<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isEmpty;

class Paket_model extends Model
{
    protected $table = 'paket';

    public function getPaket($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_paket' => $id]);
        }
    }

    public function savePaket($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function tambah_detailpaket($params)
    {
        return $this->db->table('detail_paket')->insertBatch($params);
    }

    public function insert_gambar($params)
    {
        return $this->db->table('gambar_paket')->insert($params);
    }

    public function editPaket($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_paket', $id);
        return $builder->update($data);
    }

    public function hapusDetail($id)
    {
        $builder = $this->db->table('detail_paket');
        return $builder->delete(['id_paket' => $id]);
    }
    public function hapusPaket($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_paket' => $id]);
    }

    public function ambil_id()
    {
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(id_paket,2) AS idp', False);
        $builder->orderBy('id_paket', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $jumlah = $this->db->query('SELECT RIGHT(id_paket,2) AS idp FROM paket ORDER BY id_paket DESC LIMIT 1');
        $j = $jumlah->getNumRows();
        if (isEmpty($query->getRow())) {
            if ($j == 0) {
                $data = '000';
                $kode = intval($data) + 1;
            } else {
                $data = $query->getRow();
                $kode = intval($data->idp) + 1;
            }
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "PAKET" . $batas;
        return $kodetampil;
    }

    public function ambilMenu()
    {
        $builder = $this->db->table('menu')
            ->select('menu.id_kategori,menu.id_menu,menu.nama_menu')
            ->join('kategori', 'kategori.id_kategori=menu.id_kategori')
            ->orderBy('kategori.id_kategori', 'ASC')
            ->get()->getResult();
        return $builder;
    }

    public function dataMenu($id)
    {
        $builder = $this->db->table('menu')
            ->select('menu.id_menu,menu.nama_menu,menu.gambar,detail_paket.id_paket')
            ->join('detail_paket', 'detail_paket.id_menu=menu.id_menu')
            ->where('detail_paket.id_paket', $id)
            ->get()->getResult();
        return $builder;
    }

    public function getKategori()
    {
        $builder = $this->db->table('kategori')
            ->select('*');
        $data = $builder->get()->getResult();
        return $data;
    }

    public function menuKategori($idkategori)
    {
        $builder = $this->db->table('menu');
        $builder->select('id_kategori,nama_menu,id_menu');
        $builder->where('id_kategori', $idkategori);
        $builder->orderBy('nama_menu', 'ASC');
        $data = $builder->get()->getResult();
        // dd($data);
        // die;
        return $data;
    }

    public function getJumlah()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAllResults();
        return $query;
    }

    public function get_paket_by_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->join('detail_pemesanan', 'detail_pemesanan.id_paket=paket.id_paket')
            ->where('detail_pemesanan.id_pemesanan', $id);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function get_gambar_by_id_paket($id)
    {
        $builder = $this->db->table('gambar_paket g')
            ->select('g.id_paket,g.gambar_paket')
            ->join('paket p', 'p.id_paket=g.id_paket')
            ->where('g.id_paket', $id)
            ->orderBy('updated_at', 'ASC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function delete_gambar_by_id($id)
    {
        $builder = $this->db->table('gambar_paket');
        return $builder->delete(['id_paket' => $id]);
    }
}
