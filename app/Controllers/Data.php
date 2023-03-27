<?php

namespace App\Controllers;

use App\Models\Admin_model;
use App\Models\Customer_model;
use App\Models\Menu_model;
use App\Models\Order_model;
use App\Models\Paket_model;

class Data extends BaseController
{
    protected $customerModel;
    protected $menuModel;
    protected $orderModel;
    protected $paketModel;
    protected $adminModel;

    public function __construct()
    {
        $this->customerModel = new Customer_model();
        $this->menuModel = new Menu_model();
        $this->orderModel = new Order_model();
        $this->paketModel = new Paket_model();
        $this->adminModel = new Admin_model();
        helper(['form', 'number']);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'admin' => $this->adminModel->getJumlah(),
            'menu' => $this->menuModel->getJumlah(),
            'paket' => $this->paketModel->getJumlah(),
            'customer' => $this->customerModel->getJumlah(),
            'order' => $this->orderModel->getJumlah(),
            'username' => $this->username
        ];
        return view('master/dashboard', $data);
    }
}
