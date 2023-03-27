<?php

namespace App\Controllers;

use App\Models\Customer_model;
use App\Models\Menu_model;
use App\Models\Order_model;
use App\Models\Paket_model;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    protected $customerModel;
    protected $menuModel;
    protected $orderModel;
    protected $paketModel;

    public function __construct()
    {
        $this->customerModel = new Customer_model();
        $this->menuModel = new Menu_model();
        $this->orderModel = new Order_model();
        $this->paketModel = new Paket_model();
        helper(['form', 'number']);
    }

    public function index()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-qB7mG7QdRC2Ov60KAe0L9kXm';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (session()->get('nama_paket')) {
            return redirect()->to(base_url() . "/dashboard");
        }
        // $pending = $this->orderModel->get_pending_order(session()->get('id_customer'));
        // dd(count($pending));
        $data = [
            'title' => 'Dashboard - Yeyen Catering',
            'cart' => \Config\Services::cart(),
            'getOrder' => $this->orderModel->getOrder(),
            'name' => session()->get('nama'),
            'id_customer' => session()->get('id_customer'),
            'pesanan' => $this->orderModel->get_order_by_id(session()->get('id_customer')),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer')),
        ];
        return view('dashboard/home', $data);
    }

    public function paket()
    {
        if (session()->get('nama_paket')) {
            return redirect()->to(base_url() . "/dashboard");
        }
        $data = [
            'title' => 'Package - Yeyen Catering',
            'menu' => $this->menuModel->findAll(),
            'paket' => $this->paketModel->findAll(),
            'cart' => \Config\Services::cart(),
            'name' => session()->get('nama'),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer'))
        ];
        return view('dashboard/produk', $data);
    }

    public function detail($id)
    {
        if (session()->get('nama_paket')) {
            return redirect()->to(base_url() . "/dashboard");
        }
        // dd($this->paketModel->getPaket($id));
        $data = [
            'title' => 'Detail Paket - Yeyen Catering',
            'menu' => $this->paketModel->dataMenu($id),
            'paket' => $this->paketModel->getPaket($id)->getRow(),
            'cart' => \Config\Services::cart(),
            'name' => session()->get('nama'),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer')),
            'gambar' => $this->paketModel->get_gambar_by_id_paket($id)
        ];
        return view('dashboard/detailproduk', $data);
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        // $jml = count($response);
        dd($response);
    }

    public function add()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => $this->request->getPost('qty'),
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'options' => array('gambar' => $this->request->getPost('gambar'))
        ));
        session()->setFlashdata('pesan', 'Data ditambahkan ke keranjang');
        return redirect()->to('/package');
    }

    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('/cart');
    }

    public function getCart()
    {
        $data = [
            'title' => 'Keranjang Belanja',
            'cart' => \Config\Services::cart(),
            'name' => session()->get('nama'),
            'validation' => \Config\Services::validation(),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer'))
        ];
        return view('dashboard/cart', $data);
    }

    public function update()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $key => $value) {
            $cart->update(array(
                'rowid'   => $value['rowid'],
                'qty'     => $this->request->getPost('qty' . $i++)
            ));
        }
        session()->setFlashdata('pesan', 'Data diubah');
        return redirect()->to('/cart');
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        session()->setFlashdata('pesan', 'Data dihapus');
        return redirect()->to('/cart');
    }

    public function checkout()
    {
        $cart = \Config\Services::cart();
        if ($cart->contents() == null) {
            session()->setFlashdata('gagal', 'Keranjang masih kosong');
            return redirect()->to('/package');
        } else {
            $data = [
                'title' => 'Checkout',
                'name' => session()->get('nama'),
                'cart' => \Config\Services::cart(),
                'validation' => \Config\Services::validation(),
                'idpsn' => $this->orderModel->ambil_id(),
                'tgl_pemesanan' => Time::now('Asia/Jakarta')->toDateString(),
                'id_customer' => session()->get('id_customer'),
                'pending' => $this->orderModel->get_pending_order(session()->get('id_customer'))
            ];
            return view('dashboard/checkout', $data);
        }
    }

    public function payMidtrans()
    {
        if ($this->request->isAJAX()) {
            $id_pemesanan = $this->request->getPost('id_pemesanan');
            $tgl_pemesanan = $this->request->getPost('tgl_pemesanan');
            $id_customer = $this->request->getPost('id_customer');
            $total = $this->request->getPost('total');
            $namacus = session()->get('nama');
            $notelp = session()->get('no_telp');
            $email = session()->get('email');

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-qB7mG7QdRC2Ov60KAe0L9kXm';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $cart = \Config\Services::cart();
            $items = [];
            foreach ($cart->contents() as $key => $value) {
                array_push($items, array(
                    'id'       => $value['id'],
                    'price'    => $value['price'],
                    'quantity' => $value['qty'],
                    'name'     => $value['name']
                ));
            }

            // Populate customer's info
            $customer_details = array(
                'first_name'       => $namacus,
                'email'            => $email,
                'phone'            => $notelp,
            );

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 10000,
                ),
                'item_details'        => $items,
                'customer_details'    => $customer_details
            );

            $json = array(
                'id_pemesanan' => $id_pemesanan,
                'tgl_pemesanan' => $tgl_pemesanan,
                'id_customer' => $id_customer,
                'total' => $total,
                'snapToken' => \Midtrans\Snap::getSnapToken($params)
            );
        } else {
            $json = [
                'error' => 'Maaf item belum ada'
            ];
        }
        echo json_encode($json);
    }

    public function finishMidtrans()
    {
        if ($this->request->isAJAX()) {
            $id_pemesanan = $this->request->getPost('id_pemesanan');
            $tgl_pemesanan = $this->request->getPost('tgl_pemesanan');
            $id_customer = $this->request->getPost('id_customer');
            $total = $this->request->getPost('total');
            $tgl_digunakan = $this->request->getPost('tgl_digunakan');
            $alamat = $this->request->getPost('alamat');
            $keterangan = $this->request->getPost('keterangan');
            $order_id = $this->request->getPost('order_id');
            $payment_type = $this->request->getPost('payment_type');
            $transaction_status = $this->request->getPost('transaction_status');
            $transaction_time = $this->request->getPost('transaction_time');
            $bank = $this->request->getPost('bank');
            $va_number = $this->request->getPost('va_number');

            $data = array(
                'id_pemesanan' => $id_pemesanan,
                'tgl_pemesanan' => $tgl_pemesanan,
                'id_customer' => $id_customer,
                'total' => $total,
                'tgl_digunakan' => $tgl_digunakan,
                'alamat' => $alamat,
                'keterangan' => $keterangan,
                'order_id' => $order_id,
                'payment_type' => $payment_type,
                'payment_method' => 'Midtrans',
                'transaction_status' => $transaction_status,
                'transaction_time' => $transaction_time,
                'bank' => $bank,
                'va_number' => $va_number,
            );

            $this->orderModel->saveOrder($data);
            $cart = \Config\Services::cart();
            $params = [];
            foreach ($cart->contents() as $key => $value) {
                array_push($params, array(
                    'id_pemesanan' => $id_pemesanan,
                    'id_paket' => $value['id'],
                    'qty' => $value['qty'],
                    'sub_total' => $value['subtotal']
                ));
            }
            $this->orderModel->tambah_detailpemesanan($params);
            $cart->destroy();
            $json = [
                'sukses' => 'transaksi berhasil'
            ];
            echo json_encode($json);
        };
    }
}
