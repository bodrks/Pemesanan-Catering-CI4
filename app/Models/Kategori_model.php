<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isEmpty;

class Kategori_model extends Model
{
    protected $table = 'kategori';

    protected $allowedFields = ['id_kategori', 'nama_kategori'];

    public function getKategori($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kategori' => $id]);
        }
    }

    public function saveKategori($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editKategori($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_kategori', $id);
        return $builder->update($data);
    }

    public function hapusKategori($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_kategori' => $id]);
    }

    public function ambil_id()
    {
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(id_kategori,2) AS idk', False);
        $builder->orderBy('id_kategori', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $jumlah = $this->db->query('SELECT RIGHT(id_kategori,2) AS idk FROM Kategori ORDER BY id_kategori DESC LIMIT 1');
        $j = $jumlah->getNumRows();
        if (isEmpty($query->getRow())) {
            if ($j == 0) {
                $data = '00000';
                $kode = intval($data) + 1;
            } else {
                $data = $query->getRow();
                $kode = intval($data->idk) + 1;
            }
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "KTG" . $batas;
        return $kodetampil;
    }
}
