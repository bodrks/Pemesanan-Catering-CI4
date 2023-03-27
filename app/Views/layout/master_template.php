<?php

use Faker\Provider\Base;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link type="text/css" href="<?= base_url(); ?>/home_template/assets/css/jquery-ui.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

    <title><?= $title; ?></title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
</head>

<body>
    <div class="app">
        <div class="main-wrapper">
            <div class="navbar-bg bg-matcha"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url(); ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $username; ?> </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title"></div>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('master/logout'); ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">Yeyen Catering</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li>
                            <a href="<?= base_url('master'); ?>" class="nav-link">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Master</li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/admin'); ?>">
                                <i class="fas fa-cog" aria-hidden="true"></i>
                                <span>Admin</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/customer'); ?>">
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <span>Customer</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/menu'); ?>">
                                <i class='fas fa-pizza-slice' aria-hidden="true"></i>
                                <span>Menu Catering</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/paket'); ?>">
                                <i class="fas fa-book-open" aria-hidden="true"></i>
                                <span>Paket Catering</span></a>
                        </li>
                        <li class="menu-header">Transaksi</li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/order'); ?>">
                                <i class='fas fa-cart-arrow-down'></i>
                                <span>Pesanan</span></a>
                        </li>
                        <li class="menu-header">Laporan</li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('master/laporan'); ?>">
                                <i class="far fa-file-alt"></i>
                                <span>Laporan Pemesanan</span></a>
                        </li>
                    </ul>

                </aside>
            </div>
        </div>
    </div>
    <div class="main-content">
        <section class="section">
            <?= $this->renderSection('content') ?>
        </section>
    </div>
    <footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; 2022 <div class="bullet"> Mohammad Fajar Mahendra</a>
            </div>
    </footer>

    <script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <script src="<?= base_url() ?>/template/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

    <?= $this->renderSection('scripts') ?>
    <script>
        function previewImg() {

            const gambar = document.querySelector('#gambar');
            const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            gambarLabel.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>