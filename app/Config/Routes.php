<?php

namespace Config;

use App\Controllers\LoginCustomer;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard::index');
$routes->add('log', 'LoginCustomer::auth');
$routes->add('login', 'LoginCustomer::index');
$routes->add('logout', 'LoginCustomer::logout');
$routes->add('register', 'LoginCustomer::register');
$routes->add('register/activate/(:segment)', 'LoginCustomer::activateToken/$1');
$routes->add('daftar', 'LoginCustomer::daftar');
$routes->add('aktivasi', 'LoginCustomer::getEmail');
$routes->add('resendEmail', 'LoginCustomer::resendEmail');

$routes->group('forgotPassword', function ($routes) {
    $routes->add('/', 'ForgotPassword::index');
    $routes->add('resetlink', 'ForgotPassword::forgot');
    $routes->add('resetpassword/(:segment)', 'ForgotPassword::reset/$1');
    $routes->add('resetpassword/(:segment)/ubah', 'ForgotPassword::ubah/$1');
});

$routes->group('payment', function ($routes) {
    $routes->get('/', 'Payment::index');
    $routes->add('payMidtrans', 'Dashboard::payMidtrans');
    $routes->add('finishMidtrans', 'Dashboard::finishMidtrans');
});

$routes->group('profil', function ($routes) {
    $routes->get('/', 'Profil::index', ['filter' => 'authcst']);
    $routes->post('(:segment)/update', 'Profil::update/$1', ['filter' => 'authcst']);
    $routes->get('ubahpass', 'Profil::ubahPass', ['filter' => 'authcst']);
    $routes->post('(:segment)/resetpassword', 'Profil::resetPassword/$1', ['filter' => 'authcst']);
    $routes->get('order', 'Profil::allPurchase', ['filter' => 'authcst']);
    $routes->get('order/(:segment)/cancel', 'Profil::cancelOrder/$1', ['filter' => 'authcst']);
    $routes->get('order/(:segment)/detail', 'Profil::detailPesanan/$1', ['filter' => 'authcst']);
    $routes->add('(:segment)/invoice', 'Profil::invoice/$1', ['filter' => 'authcst']);
});

$routes->group('package', function ($routes) {
    $routes->add('/', 'Dashboard::paket');
    $routes->add('cek', 'Dashboard::cek');
    $routes->add('add', 'Dashboard::add');
    $routes->get('detail/(:segment)', 'Dashboard::detail/$1');
});

$routes->group('cart', function ($routes) {
    $routes->get('/', 'Dashboard::getCart', ['filter' => 'authcst']);
    $routes->add('clear', 'Dashboard::clear');
    $routes->add('update', 'Dashboard::update', ['filter' => 'authcst']);
    $routes->add('checkout', 'Dashboard::checkout', ['filter' => 'authcst']);
    $routes->add('(:segment/delete)', 'Dashboard::delete/$1', ['filter' => 'authcst']);
});

$routes->group('master', function ($routes) {
    $routes->add('login', 'LoginAdmin::index');
    $routes->get('/', 'Data::index', ['filter' => 'auth']);
    $routes->add('log', 'LoginAdmin::auth');
    $routes->add('logout', 'LoginAdmin::logout');

    //routes admin
    $routes->add('admin', 'Admin::index', ['filter' => 'auth']);
    $routes->add('admin/add', 'Admin::add', ['filter' => 'auth']);
    $routes->add('admin/save', 'Admin::save');
    $routes->add('admin/(:segment)/edit', 'Admin::edit/$1', ['filter' => 'auth']);
    $routes->post('admin/update', 'Admin::update/$1');
    $routes->add('admin/(:segment)/hapus', 'Admin::hapus/$1');

    //routes customer
    $routes->add('customer', 'Customer::index', ['filter' => 'auth']);
    $routes->add('customer/add', 'Customer::add', ['filter' => 'auth']);
    $routes->add('customer/save', 'Customer::save');
    $routes->add('customer/(:segment)/edit', 'Customer::edit/$1', ['filter' => 'auth']);
    $routes->add('customer/(:segment)/update', 'Customer::update/$1');
    $routes->add('customer/(:segment)/hapus', 'Customer::hapus/$1');
    $routes->add('customer/(:segment)/detail', 'Customer::detail/$1', ['filter' => 'auth']);

    //routes menu
    $routes->add('menu', 'Menu::index', ['filter' => 'auth']);
    $routes->add('menu/add', 'Menu::add', ['filter' => 'auth']);
    $routes->add('menu/save', 'Menu::save');
    $routes->add('menu/(:segment)/edit', 'Menu::edit/$1', ['filter' => 'auth']);
    $routes->add('menu/(:segment)/update', 'Menu::update/$1');
    $routes->add('menu/(:segment)/hapus', 'Menu::hapus/$1');
    $routes->add('menu/(:segment)/detail', 'Menu::detail/$1', ['filter' => 'auth']);

    //routes paket
    $routes->add('paket', 'Paket::index', ['filter' => 'auth']);
    $routes->add('paket/add', 'Paket::add', ['filter' => 'auth']);
    $routes->add('paket/save', 'Paket::save');
    $routes->add('paket/coba', 'Paket::coba');
    $routes->add('paket/(:segment)/edit', 'Paket::edit/$1', ['filter' => 'auth']);
    $routes->add('paket/(:segment)/update', 'Paket::update/$1');
    $routes->add('paket/(:segment)/hapus', 'Paket::hapus/$1');
    $routes->add('paket/(:segment)/detail', 'Paket::detail/$1', ['filter' => 'auth']);

    //routes order
    $routes->add('order', 'Order::index', ['filter' => 'auth']);
    $routes->add('order/add', 'Order::add', ['filter' => 'auth']);
    $routes->add('order/editstatus/(:segment)', 'Order::editStatus/$1', ['filter' => 'auth']);
    $routes->post('order/update/(:segment)', 'Order::update/$1');
    $routes->post('order/tambahCart', 'Order::tambahCart');
    $routes->post('order/updateCart', 'Order::updateCart');
    $routes->add('order/(:segment)/deleteCart', 'Order::deleteCart/$1');
    $routes->get('order/(:segment)/detail', 'Order::detailPemesanan/$1');
    $routes->get('order/checkout', 'Order::checkout', ['filter' => 'auth']);
    $routes->get('order/clearCart', 'Order::clearCart');
    $routes->add('order/save', 'Order::save');
    $routes->get('order/struk/(:segment)', 'Order::struk/$1', ['filter' => 'auth']);

    $routes->get('laporan', 'Laporan::index', ['filter' => 'auth']);
    $routes->post('laporan/submit', 'Laporan::submit');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
