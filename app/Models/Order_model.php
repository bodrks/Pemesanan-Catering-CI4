<?php

namespace App\Models;

use CodeIgniter\Model;
use function PHPUnit\Framework\isEmpty;

class Order_model extends Model
{
    protected $table = 'pemesanan';

    public function getOrder($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_pemesanan' => $id]);
        }
    }

    public function get_desc_order()
    {
        $builder = $this->db->table($this->table)
            ->join('customer', 'customer.id_customer=pemesanan.id_customer')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function saveOrder($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editOrder($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_pemesanan', $id);
        return $builder->update($data);
    }

    public function hapusOrder($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pemesanan' => $id]);
    }

    public function ambil_id()
    {
        $hari = date('d');
        $bulan = date('m');
        $tahun = date('y');
        $now = date('Y-m-d');
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(id_pemesanan,2) AS ido', False);
        $builder->where('tgl_pemesanan', $now);
        $builder->orderBy('id_pemesanan', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        $jumlah = $this->db->query('SELECT RIGHT(id_pemesanan,2) AS ido FROM pemesanan WHERE tgl_pemesanan=' . "'$now'" . ' ORDER BY id_pemesanan DESC LIMIT 1');
        $j = $jumlah->getNumRows();
        if (isEmpty($query->getRow())) {
            if ($j == 0) {
                $data = '00';
                $kode = intval($data) + 1;
            } else {
                $data = $query->getRow();
                $kode = intval($data->ido) + 1;
            }
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "2OR6D" . $hari . $bulan . $tahun . $batas;
        return $kodetampil;
    }

    public function getJumlah()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAllResults();
        return $query;
    }

    public function get_midtrans_order()
    {
        $builder = $this->db->table($this->table)
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function tambah_detailpemesanan($params)
    {
        return $this->db->table('detail_pemesanan')->insertBatch($params);
    }

    public function getOrderCst($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'pending')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get();
        return $query;
    }

    public function succes_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'settlement')
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function expire_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'expire')
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function pending_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'pending')
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function cancel_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'cancel')
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getdetailOrder($id)
    {
        $builder = $this->db->table('detail_pemesanan')
            ->select('*')
            ->join('paket', 'paket.id_paket=detail_pemesanan.id_paket')
            ->where('id_pemesanan', $id);
        $query = $builder->get()->getResult();
        // dd($query);
        return $query;
    }

    public function get_order_by_id($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_pemesanan', $id);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function get_order_by_order_id($id)
    {
        $builder = $this->db->table($this->table)
            ->select('order_id')
            ->where('id_pemesanan', $id);
        $query = $builder->get()->getRow();
        return $query;
    }

    public function get_pending_order($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('id_customer', $id)
            ->where('transaction_status', 'pending')
            ->where('payment_method', 'Midtrans')
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function get_all_order_by_id_customer($id)
    {
        $array = ['id_customer' => $id, 'payment_method' => 'Midtrans'];
        $builder = $this->db->table($this->table)
            ->where($array)
            ->orderBy('tgl_pemesanan', 'DESC');
        $query = $builder->get();
        return $query;
    }

    public function get_invoice($id)
    {
        $builder = $this->db->table('pemesanan p')
            ->select('p.id_pemesanan,p.id_customer,p.tgl_pemesanan,p.tgl_digunakan,p.alamat,p.bank,p.transaction_status,p.total,
            p.keterangan,d.id_paket,d.sub_total,d.qty,pkt.nama_paket,pkt.harga,c.nama,c.email,c.username')
            ->join('detail_pemesanan d', 'd.id_pemesanan=p.id_pemesanan')
            ->join('customer c', 'c.id_customer=p.id_customer')
            ->join('paket pkt', 'pkt.id_paket=d.id_paket')
            ->where('p.id_pemesanan', $id);
        $query = $builder->get()->getResult();
        return $query;
    }

    public function struk($id)
    {
        $builder = $this->db->table($this->table)
            ->select('pemesanan.*,customer.id_customer,customer.nama')
            ->join('customer', 'pemesanan.id_customer=customer.id_customer')
            ->where('pemesanan.id_pemesanan', $id);
        $query = $builder->get()->getRow();
        // dd($query);
        return $query;
    }

    public function pemesananDetail($id)
    {
        $builder = $this->db->table('detail_pemesanan')
            ->join('paket', 'detail_pemesanan.id_paket=paket.id_paket')
            ->where('detail_pemesanan.id_pemesanan', $id);
        return $builder->get()->getResult();
    }

    public function customer_cash($id)
    {
        $builder = $this->db->table($this->table)
            ->join('customer', 'customer.id_customer=pemesanan.id_customer')
            ->where('pemesanan.id_pemesanan', $id);

        return $builder->get()->getRow();
    }

    public function laporan_by_tanggal($tgl1 = false, $tgl2 = false)
    {
        $builder = $this->db->table('pemesanan p')
            ->select('p.*,c.id_customer,c.nama,')
            ->join('customer c', 'c.id_customer=p.id_customer')
            ->where('p.tgl_pemesanan BETWEEN' . "'$tgl1'" . 'AND'  . "'$tgl2'");
        return $builder->get()->getResult();
    }

    public function laporan_seluruh()
    {
        $builder = $this->db->table('pemesanan p')
            ->select('p.*,c.id_customer,c.nama,')
            ->join('customer c', 'c.id_customer=p.id_customer')
            ->orderBy('tgl_pemesanan', 'DESC');
        return $builder->get()->getResult();
    }
}
