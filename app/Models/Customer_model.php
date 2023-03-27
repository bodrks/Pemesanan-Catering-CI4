<?php

namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

use function PHPUnit\Framework\isEmpty;

class Customer_model extends Model
{
    protected $table = 'customer';

    protected $allowedFields = ['id_customer', 'nama', 'username', 'email', 'password', 'no_telp', 'alamat', 'gambar', 'is_active', 'token', 'activation_time'];

    public function getCustomer($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_customer' => $id]);
        }
    }

    public function saveCustomer($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editCustomer($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_customer', $id);
        return $builder->update($data);
    }

    public function hapusCustomer($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_customer' => $id]);
    }

    public function ambil_id()
    {
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(id_customer,5) AS id_cu', False);
        $builder->orderBy('id_customer', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $jumlah = $this->db->query('SELECT RIGHT(id_customer,5) AS id_cu FROM customer ORDER BY id_customer DESC LIMIT 1');
        $j = $jumlah->getNumRows();
        if (isEmpty($query->getRow())) {
            if ($j == 0) {
                $data = '00000';
                $kode = intval($data) + 1;
            } else {
                $data = $query->getRow();
                $kode = intval($data->id_cu) + 1;
            }
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "CST" . $batas;
        return $kodetampil;
    }

    public function getJumlah()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAllResults();
        return $query;
    }

    public function verifyToken($id)
    {
        $builder = $this->db->table($this->table);
        $builder
            ->select('activation_time, token, is_active')
            ->where('token', $id);
        $result = $builder->get();

        if (count($result->getResultArray()) == 1) {
            return $result->getRow();
        } else {
            return false;
        }
    }

    public function verify_token_reset($token)
    {
        $builder = $this->db->table($this->table)
            ->select('reset_time,token')
            ->where('token', $token);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRow();
        } else {
            return false;
        }
    }

    public function updateStatus($token)
    {
        $builder = $this->db->table($this->table);
        $builder->where('token', $token);
        $builder->update([
            'is_active' => 'activated',
            'activation_time' => date('Y-m-d H:i:s')
        ]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_customer_by_email($email)
    {
        $builder = $this->db->table($this->table)
            ->select('token,nama,id_customer')
            ->where('email', $email);
        $query = $builder->get();

        if (count($query->getResultArray()) == 1) {
            return $query->getRow();
        } else {
            return false;
        }
    }

    public function get_customer_by_token($token)
    {
        $builder = $this->db->table($this->table)
            ->where('token', $token);
        $query = $builder->get()->getRow();
        return $query;
    }
}
