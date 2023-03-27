<?php

namespace App\Controllers;

use App\Models\Customer_model;
use App\Models\Order_model;
use App\Models\Paket_model;

class Profil extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customer_model();
        $this->orderModel = new Order_model();
        $this->paketModel = new Paket_model();
        helper(['form', 'number']);
    }

    public function index()
    {
        $id = session()->get('id_customer');
        $data = [
            'title' => 'Profil - Yeyen Catering',
            'username' => $this->username,
            'customer' => $this->customerModel->getCustomer($id)->getResult(),
            'cart' => \Config\Services::cart(),
            'pending' => $this->orderModel->get_pending_order($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('profil/index', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh melebihi 2 MB',
                    'is_image' => 'Upload File dengan ekstensi JPG/JPEG/PNG',
                    'mime_in' => 'Upload File dengan ekstensi JPG/JPEG/PNG.'
                ]
            ]
        ])) {
            return redirect()->to('/profil')->withInput();
        }
        $id = $this->request->getPost('id_customer');

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('user_images', $namaGambar);
        }

        $data = array(
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar
        );
        $this->customerModel->editCustomer($data, $id);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/profil');
    }

    public function ubahPass()
    {
        $id = session()->get('id_customer');
        // dd($this->customerModel->where('id_customer',$id)->first());
        $data = [
            'title' => 'Profil - Yeyen Catering',
            'username' => $this->username,
            'customer' => $this->customerModel->getCustomer($id)->getResult(),
            'cart' => \Config\Services::cart(),
            'pending' => $this->orderModel->get_pending_order($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('profil/ubahPassword', $data);
    }

    public function resetPassword($id)
    {
        $id = session()->get('id_customer');
        $old_password = $this->request->getPost('old_password');

        if (!$this->validate([
            'new_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi.',
                ]
            ],
            'conf_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'password harus diisi.',
                    'matches' => 'password tidak sesuai.'
                ]
            ],
        ])) {
            if ($old_password == '') {
                session()->setFlashdata('gagal', 'Password lama tidak boleh kosong');
            }
            return redirect()->to(previous_url())->withInput();
        }

        $data = $this->customerModel->where('id_customer', $id)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($old_password, $pass);
            if ($verify_pass) {
                $new_password = password_hash($this->request->getPost('conf_password'), PASSWORD_DEFAULT);
                $data = array(
                    'password' => $new_password
                );
                $this->customerModel->editCustomer($data, $id);
                session()->setFlashdata('pesan', 'Password berhasil diubah');
                return redirect()->to(previous_url());
            } else {
                session()->setFlashdata('gagal', 'Password lama salah');
                return redirect()->to(previous_url())->withInput();
            }
        } else {
            session()->setFlashdata('gagal', 'Kami tidak dapat memproses permintaan anda.');
            return redirect()->to(previous_url());
        }
    }

    public function allPurchase()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-qB7mG7QdRC2Ov60KAe0L9kXm';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $id = session()->get('id_customer');
        $pesanan = $this->orderModel->get_all_order_by_id_customer($id)->getResult();
        // dd($pesanan);
        if ($pesanan > 0) {
            foreach ($pesanan as $key => $value) {
                $idpesanan = $value->id_pemesanan;
                $status = \Midtrans\Transaction::status($value->order_id);
                // dd($idpesanan);
                $data = ['transaction_status' => $status->transaction_status];
                $this->orderModel->editOrder($data, $idpesanan);
            }
        }
        $data = [
            'title' => 'Pesanan Saya - Yeyen Catering',
            'username' => $this->username,
            'name' => session()->get('nama'),
            'cart' => \Config\Services::cart(),
            'pesanan_semua' => $this->orderModel->get_all_order_by_id_customer($id)->getResult(),
            'pesanan_pending' => $this->orderModel->pending_order($id),
            'pesanan_sukses' => $this->orderModel->succes_order($id),
            'pesanan_expired' => $this->orderModel->expire_order($id),
            'pesanan_batal' => $this->orderModel->cancel_order($id),
            'pending' => $this->orderModel->get_pending_order($id),
            'kosong' => 'Anda belum melakukan pemesanan.'
        ];
        // dd($this->orderModel->pending_order($id));
        return view('profil/purchase', $data);
    }

    public function detailPesanan($id)
    {
        $data = [
            'title' => 'Detail Pesanan - Yeyen Catering',
            'pesanan' => $this->orderModel->getdetailOrder($id),
            'username' => $this->username,
            'name' => session()->get('nama'),
            'cart' => \Config\Services::cart(),
            'index' => $this->orderModel->get_order_by_id($id),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer'))
        ];
        return view('profil/purchase_detail', $data);
    }

    public function cancelOrder($id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-qB7mG7QdRC2Ov60KAe0L9kXm';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $cancel = \Midtrans\Transaction::cancel($id);
        return redirect()->to(previous_url());
    }

    public function invoice($id)
    {
        // dd($this->barangmasuk->struk($id));
        $data = [
            'title' => 'Invoice',
            'pesanan' => $this->orderModel->struk($id),
            'detail' => $this->orderModel->pemesananDetail($id),
            'username' => $this->username,
            'name' => session()->get('nama'),
            'pending' => $this->orderModel->get_pending_order(session()->get('id_customer')),
            'cart' => \Config\Services::cart(),
        ];
        return view('profil/invoice', $data);
    }
}
