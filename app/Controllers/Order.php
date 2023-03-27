<?php

namespace App\Controllers;

use App\Models\Customer_model;
use App\Models\Order_model;
use App\Models\Paket_model;
use CodeIgniter\I18n\Time;
use stdClass;

class Order extends BaseController
{
    public function __construct()
    {
        $this->orderModel = new Order_model();
        $this->paketModel = new Paket_model();
        $this->customerModel = new Customer_model();
        $this->orderModel->asObject();
        helper('form');
        helper('number');
    }

    public function index()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-qB7mG7QdRC2Ov60KAe0L9kXm';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $model = new Order_model;
        $pesanan = $model->get_midtrans_order();
        // dd($pesanan);
        if ($pesanan > 0) {
            foreach ($pesanan as $key => $value) {
                $idpesanan = $value['id_pemesanan'];
                $status = \Midtrans\Transaction::status($value['order_id']);
                // dd($idpesanan);
                $data = ['transaction_status' => $status->transaction_status];
                $model->editOrder($data, $idpesanan);
            }
        }

        $data = [
            'title' => 'Data Order',
            'getOrder' => $model->get_desc_order(),
            'ambil_id' => $model->ambil_id(),
            'username' => $this->username
        ];

        return view('master/order/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Pesanan',
            'paket' => $this->paketModel->getPaket(),
            'cart' => \Config\Services::cart(),
            'username' => $this->username
        ];

        return view('master/order/create', $data);
    }

    public function tambahCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id' => $this->request->getPost('id'),
            'qty' => 50,
            'price' => $this->request->getPost('price'),
            'name' => $this->request->getPost('name'),
            'options' => array('gambar' => $this->request->getPost('gambar'))
        ));
        return redirect()->to('/master/order/add');
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        // $jml = count($response);
        dd($response);
    }

    public function updateCart()
    {
        $cart = \Config\Services::cart();
        $qty = $this->request->getPost('qty');
        if (intval($qty) < 50) {
            session()->setFlashdata('gagal', 'pemesanan minimal 50 pack');
            return redirect()->to('/master/order/add');
        } else {
            $data = array(
                'rowid' => $this->request->getPost('rowid'),
                'qty' => $this->request->getPost('qty')
            );
            $cart->update($data);
        }
        return redirect()->to('/master/order/add');
    }

    public function deleteCart($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        session()->setFlashdata('pesan', 'Data dihapus');
        return redirect()->to('/master/order/add');
    }

    public function clearCart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('/master/order/add');
    }

    public function checkout()
    {
        $cart = \Config\Services::cart();
        $qty = $this->request->getPost('qty');
        if ($cart->totalItems() == null) {
            session()->setFlashdata('gagal', 'Keranjang masih kosong');
            return redirect()->to('/master/order/add');
        } else {
            // dd($qty);
            // if (intval($qty) < 50) {
            //     session()->setFlashdata('gagal', 'pemesanan minimal 50 pack');
            //     return redirect()->to('/master/order/add');
            // } else {
            $data = [
                'title' => 'Checkout',
                'cart' => \Config\Services::cart(),
                'ambil' => $this->orderModel->ambil_id(),
                'validation' => \Config\Services::validation(),
                'tgl' => Time::now()->toDateString(),
                'customer' => $this->customerModel->getCustomer(),
                'username' => $this->username
            ];
            return view('master/order/checkout', $data);
            // }
        }
    }

    public function save()
    {
        if (!$this->validate([
            'tgl_digunakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan tanggal acara anda',
                ]
            ],
            'nuansa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nuansa harus diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ]
            ],

        ])) {
            return redirect()->to('/master/order/checkout')->withInput();
        }
        $idpemesanan = $this->orderModel->ambil_id();
        $data = [
            'id_pemesanan' => $idpemesanan,
            'tgl_pemesanan' => $this->request->getPost('tgl_pemesanan'),
            'id_customer' => $this->request->getPost('id_customer'),
            'tgl_digunakan' => $this->request->getPost('tgl_digunakan'),
            'keterangan' => $this->request->getPost('nuansa'),
            'alamat' => $this->request->getPost('alamat'),
            'total' => $this->request->getPost('totalcart'),
            'payment_method' => 'Cash',
            'transaction_status' => 'pending',
            'bukti_bayar_cash' => 'default.png'
        ];
        $this->orderModel->saveOrder($data);
        $cart = \Config\Services::cart();
        $params = [];
        foreach ($cart->contents() as $key => $value) {
            array_push($params, array(
                'id_pemesanan' => $idpemesanan,
                'id_paket' => $value['id'],
                'qty' => $value['qty'],
                'sub_total' => $value['subtotal']
            ));
        }
        $this->orderModel->tambah_detailpemesanan($params);
        $cart->destroy();
        session()->setFlashdata('pesan', 'Transaksi berhasil');
        return redirect()->to('/master/order/struk/' . $idpemesanan . '/');
    }

    public function struk($id)
    {
        // dd($this->barangmasuk->struk($id));
        $data = [
            'title' => 'invoice',
            'pesanan' => $this->orderModel->struk($id),
            'detail' => $this->orderModel->pemesananDetail($id),
            'username' => $this->username
        ];
        return view('master/order/struk', $data);
    }

    public function editStatus($id)
    {
        $model = new Order_model;
        $getOrder = $model->getOrder($id)->getRow();
        $data = [
            'title' => 'Ubah Status Bayar',
            'order' => $getOrder,
            'validation' => \Config\Services::validation(),
            'customer' => $this->orderModel->customer_cash($id),
            'username' => $this->username
        ];
        return view('master/order/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tgl_digunakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan tanggal acara anda',
                ]
            ]
        ])) {
            return redirect()->to('/master/order/editstatus/' . $id)->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');

        // $namaGambar = '';
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $gambar = $this->orderModel->getOrder($id)->getRow()->bukti_bayar_cash;
            if (file_exists(base_url() . '/images/' . $gambar)) {
                if ($gambar != 'default.png') {
                    unlink('images/' . $gambar);
                }
            }
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('images', $namaGambar);
        }

        $data = array(
            'transaction_status'     => $this->request->getPost('transaction_status'),
            'tgl_digunakan'     => $this->request->getPost('tgl_digunakan'),
            'bukti_bayar_cash' => $namaGambar
        );
        $this->orderModel->editOrder($data, $id);
        session()->setFlashdata('pesan', 'Rincian berhasil diubah');
        return redirect()->to('/master/order');
    }

    public function detailPemesanan($id)
    {
        $data = [
            'title' => 'Detail Pemesanan',
            'pesanan' => $this->orderModel->struk($id),
            'detail' => $this->orderModel->pemesananDetail($id),
            'username' => $this->username
        ];
        return view('master/order/detail', $data);
    }
}
