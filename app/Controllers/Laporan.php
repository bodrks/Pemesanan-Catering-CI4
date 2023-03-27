<?php

namespace App\Controllers;

use App\Models\Order_model;

class Laporan extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order_model();
        $this->orderModel->asObject();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Pemesanan',
            'username' => $this->username,
            'validation' => \Config\Services::validation(),
            'pesanan' => $this->orderModel->laporan_seluruh(),
            'semua' => 'Laporan Keseluruhan'
        ];
        return view('master/laporan/index', $data);
    }

    public function submit()
    {
        if (!$this->validate([
            'tgl1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal tidak boleh kosong',
                ]
            ],
            'tgl2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->to('master/laporan')->withInput();
        }

        $tgl1 = $this->request->getPost('tgl1');
        $tgl2 = $this->request->getPost('tgl2');

        $data = $this->orderModel->laporan_by_tanggal($tgl1, $tgl2);
        if ($data) {
            $result = [
                'title' => 'Laporan Pemesanan',
                'username' => $this->username,
                'validation' => \Config\Services::validation(),
                'pesanan' => $data,
                'semua' => 'Laporan dari tanggal ' . date('d F Y', strtotime($tgl1)) . ' sampai ' . date('d F Y', strtotime($tgl2))
            ];
        } else {
            $result = [
                'title' => 'Laporan Keseluruhan',
                'username' => $this->username,
                'validation' => \Config\Services::validation(),
                'pesanan' => $data,
                'semua' => 'Laporan Keseluruhan'
            ];
        }
        return view('master/laporan/index', $result);
    }
}
