<?php

namespace App\Controllers;

use App\Models\Customer_model;

class LoginCustomer extends BaseController
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
        $data = ['title' => 'Login'];
        helper(['form']);
        return view('dashboard/login', $data);
    }

    public function auth()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $this->customerModel->where('username', $username)->orWhere('email', $username)->first();
        // dd($data);
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                if ($data['is_active'] == 'inactive') {
                    $session->setFlashdata('gagal', 'Akun anda belum aktif. Silahkan aktivasi email anda.<a href="aktivasi">Resend email');
                    return redirect()->to('/login');
                } else {
                    $ses_data = [
                        'username'   => $data['username'],
                        'email'      => $data['email'],
                        'nama'       => $data['nama'],
                        'id_customer' => $data['id_customer'],
                        'no_telp'    => $data['no_telp'],
                        'alamat'     => $data['alamat'],
                        'gambar'      => $data['gambar'],
                        'password'   => $data['password'],
                        'status' => $data['is_active'],
                        'logged_cst'  => true,
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('gagal', 'Password Salah');
                // dd($verify_pass);
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('gagal', 'Username atau email tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function register()
    {
        $data = [
            'title' => 'Register - Yeyen Catering',
            'ambil' => $this->customerModel->ambil_id(),
            'validation' => \Config\Services::validation(),
        ];
        return view('dashboard/register', $data);
    }

    public function daftar()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha[customer.nama]',
                'errors' => [
                    'required' => 'nama harus diisi.',
                    'alpha' => 'inputan hanya dapat berisi karakter alfabet.'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha|is_unique[customer.username]',
                'errors' => [
                    'required' => 'username harus diisi.',
                    'is_unique' => 'username sudah terdaftar.',
                    'alpha' => 'inputan hanya dapat berisi karakter alfabet.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[customer.email]',
                'errors' => [
                    'required' => 'email harus diisi.',
                    'is_unique' => 'email sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required[customer.password]',
                'errors' => ['required' => 'password harus diisi.']
            ]
        ])) {
            return redirect()->to('register')->withInput();
        }
        $token = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
        $data = [
            'id_customer' => $this->customerModel->ambil_id(),
            'username' => $this->request->getPost('username'),
            'gambar' => 'default.png',
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'token' => $token,
            'activation_time' => date('Y-m-d h:i:s')
        ];
        $this->customerModel->saveCustomer($data);
        $to = $this->request->getPost('email');
        $subject = 'Pendaftaran akun Yeyen Catering';
        $message = 'Hai ' . $this->request->getVar('nama') . ",<br><br>Terima kasih akun Anda berhasil"
            . " dibuat. Silakan klik tautan di bawah ini untuk mengaktifkan akun Anda.<br><br>"
            . "<a href='" . base_url() . "/register/activate/" . $token . "' target='_blank'>Klik untuk aktivasi</a><br>Link akan kadaluarsa dalam 60 menit setelah pesan ini dikirimkan.<br><br>Terima kasih,<br>Yeyen Catering";

        $this->email->setTo($to);
        $this->email->setFrom('yeyencatering23@gmail.com', 'Yeyen Catering');
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Pendaftaran berhasil.<br>Silahkan cek email untuk aktivasi akun.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Pendaftaran berhasil. Maaf<br>Tidak dapat mengirim link aktivasi.<br>Kontak Admin!');
            return redirect()->to('/login');
        }
    }

    public function activateToken($token = null)
    {
        if (!empty($token)) {
            $datacst = $this->customerModel->verifyToken($token);
            if ($datacst) {
                if ($this->verifyExpired($datacst->activation_time)) {
                    if ($datacst->is_active == 'inactive') {
                        $status = $this->customerModel->updateStatus($token);
                        if ($status == true) {
                            session()->setFlashdata('pesan', 'Akun berhasil diaktifkan. Silahkan Login.');
                        }
                    } else {
                        session()->setFlashdata('pesan', 'Akun anda sudah aktif.');
                    }
                } else {
                    session()->setFlashdata('gagal', 'Link aktivasi telah kadaluarsa.');
                }
            } else {
                session()->setFlashdata('gagal', 'Tidak dapat menemukan link aktivasi.');
            }
        } else {
            session()->setFlashdata('gagal', 'Tidak dapat memproses permintaan anda.');
        }
        return view('dashboard/login');
    }

    public function verifyExpired($regTime)
    {
        $currTime = now();
        $regTime = strtotime($regTime);
        $diffTime = (int)$currTime - (int)$regTime;
        if ($diffTime > 3600) {
            return false;
        } else {
            return true;
        }
    }

    public function getEmail()
    {
        return view('dashboard/resendemail');
    }
    public function resendEmail()
    {
        $to = $this->request->getPost('email');
        if (!empty($to)) {
            $data = $this->customerModel->get_customer_by_email($to);
            // dd($data);
            if ($data) {
                // dd($this->customerModel->get_customer_by_email($to));
                $token = $this->customerModel->get_customer_by_email($to)->token;
                $subject = 'Aktivasi akun Yeyen Catering';
                $message = 'Hai ' . $this->customerModel->get_customer_by_email($to)->nama . ",<br><br>Silakan klik tautan di bawah ini untuk mengaktifkan akun Anda.<br><br>"
                    . "<a href='" . base_url() . "/register/activate/" . $token . "' target='_blank'>Klik untuk aktivasi</a><br>Link kadaluarsa dalam 60 menit setelah pesan ini dikirimkan.<br>Terima kasih,<br>Yeyen Catering";

                $this->email->setTo($to);
                $this->email->setFrom('yeyencatering23@gmail.com', 'Yeyen Catering');
                $this->email->setSubject($subject);
                $this->email->setMessage($message);

                if ($this->email->send()) {
                    session()->setFlashdata('pesan', 'Email aktivasi berhasl dikirimkan.<br>Silahkan cek email untuk aktivasi akun.');
                    return redirect()->to('/login');
                } else {
                    session()->setFlashdata('gagal', 'Maaf<br>Tidak dapat mengirim link aktivasi.<br>Kontak Admin!');
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('gagal', 'Kami tidak dapat menemukan email.');
                return redirect()->to('/aktivasi');
            }
        }
    }
}
