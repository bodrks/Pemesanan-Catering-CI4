<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model
{
    protected $table = 'admin';

    protected $allowedFields = ['username', 'password', 'nama_admin', 'no_telp'];

    public function getAdmin($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['username' => $id]);
        }
    }

    public function saveAdmin($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editAdmin($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('username', $id);
        return $builder->update($data);
    }

    public function hapusAdmin($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['username' => $id]);
    }

    public function getJumlah()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAllResults();
        return $query;
    }
}
