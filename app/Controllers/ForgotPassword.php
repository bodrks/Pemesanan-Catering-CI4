<?php

namespace App\Controllers;

use App\Models\Customer_model;

class ForgotPassword extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customer_model();
        $this->email = \Config\Services::email();
        helper(['date']);
    }

    public function index()
    {
        $data = [
            'title' => 'Lupa Password',
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);
        return view('dashboard/forgotpassword', $data);
    }

    public function forgot()
    {
        $to = $this->request->getPost('email');
        if (!empty($to)) {
            $data = $this->customerModel->get_customer_by_email($to);
            if ($data) {
                $token = $this->customerModel->get_customer_by_email($to)->token;
                $id_customer = $this->customerModel->get_customer_by_email($to)->id_customer;
                $edit = [
                    'reset_time' => date('Y-m-d h:i:s')
                ];
                $this->customerModel->editCustomer($edit, $id_customer);
                $subject = 'Lupa Password - Yeyen Catering';
                $message = 'Hai ' . $this->customerModel->get_customer_by_email($to)->nama . ",<br><br>Silakan klik link di bawah ini untuk mengganti password Anda.<br><br>"
                    . "<a href='" . base_url() . "/forgotPassword/resetpassword/" . $token . "' target='_blank'>Klik untuk mengganti password</a><br>Link akan kadaluarsa dalam 15 menit setelah pesan ini dikirimkan.<br><br>Terima kasih,<br>Yeyen Catering";

                $this->email->setTo($to);
                $this->email->setFrom('yeyencatering23@gmail.com', 'Yeyen Catering');
                $this->email->setSubject($subject);
                $this->email->setMessage($message);

                if ($this->email->send()) {
                    session()->setFlashdata('pesan', 'Email lupa password berhasl dikirimkan.<br>Silahkan cek email untuk reset password anda.');
                    return redirect()->to('/login');
                } else {
                    session()->setFlashdata('gagal', 'Maaf<br>Tidak dapat mengirim email lupa password.<br>Kontak Admin!');
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('gagal', 'Kami tidak dapat menemukan email anda.');
                return redirect()->to('forgotPassword');
            }
        }
    }

    public function reset($token = null)
    {
        if (!empty($token)) {
            $datacst = $this->customerModel->verify_token_reset($token);
            // dd($datacst);
            if ($datacst) {
                // dd($this->verifyExpired($datacst->reset_time));
                if ($this->verifyExpired($datacst->reset_time)) {
                    $data = [
                        'customer' => $this->customerModel->get_customer_by_token($token),
                        'validation' => \Config\Services::validation(),
                    ];
                    return view('/dashboard/resetPassword', $data);
                } else {
                    session()->setFlashdata('gagal', 'Link telah kadaluarsa');
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('gagal', 'Tidak dapat menemukan link');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('gagal', 'Tidak dapat memproses permintaan anda');
            return redirect()->to('/login');
        }
    }

    public function verifyExpired($regTime)
    {
        $currTime = now();
        $regTime = strtotime($regTime);
        $diffTime = (int)$currTime - (int)$regTime;
        // dd($diffTime);
        if ($diffTime > 900) {
            return false;
        } else {
            return true;
        }
    }

    public function ubah($token)
    {
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
            return redirect()->to('/forgotPassword/resetpassword/' . $token)->withInput();
        }

        $id_customer = $this->customerModel->get_customer_by_token($token)->id_customer;
        $password = password_hash($this->request->getPost('conf_password'), PASSWORD_DEFAULT);
        $data = array(
            'password' => $password
        );
        $this->customerModel->editCustomer($data, $id_customer);
        session()->setFlashdata('pesan', 'Password berhasil diubah. Silahkan Login untuk melanjutkan.');
        return redirect()->to('/login');
    }
}
