<?php

namespace App\Controllers;

use App\Models\Admin_model;

class LoginAdmin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin_model();
    }

    public function index()
    {
        $data = ['title' => 'Login'];
        helper(['form']);
        return view('master/login', $data);
    }

    public function auth()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $this->adminModel->where('username', $username)->orWhere('email', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'username'   => $data['username'],
                    'email'      => $data['email'],
                    'nama_admin' => $data['nama_admin'],
                    'logged_in'  => true,
                ];
                $session->set($ses_data);
                return redirect()->to('/master');
            } else {
                $session->setFlashdata('gagal', 'Password Salah');
                // dd($username, $password);
                return redirect()->to('/master/login');
            }
        } else {
            $session->setFlashdata('gagal', 'Username atau email tidak ditemukan');
            return redirect()->to('/master/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/master/login');
    }
}
