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
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap-social/bootstrap-social.css">

    <title><?= $title; ?></title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/hometemplate/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg bg-matcha"></div>
            <div class="container">
                <nav class="navbar navbar-expand-md fixed-top main-navbar">
                    <a href="#" class="navbar-brand sidebar-gone-hide">Yeyen Catering</a>
                    <div class="navbar-nav">
                        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                    </div>
                    <div class="nav-collapse">
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>
                        </ul>
                    </div>
                    <form class="form-inline ml-4">
                        <ul class="navbar-nav">
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Messages
                                </div>
                                <div class="dropdown-list-content dropdown-list-message">
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="<?= base_url(); ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle">
                                            <div class="is-online"></div>
                                        </div>
                                        <div class="dropdown-item-desc">

                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Notifications
                                </div>
                                <div class="dropdown-list-content dropdown-list-icons">
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-icon bg-primary text-white">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Template update is available now!
                                            <div class="time text-primary">2 Min Ago</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                                <img alt="image" src="<?= base_url(); ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">bodrks</div>
                            </a>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Account</div>
                                <a href="#" class="dropdown-item has-icon">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                                <a href="" class="dropdown-item has-icon">
                                    <i class='fas fa-shopping-cart'></i>Pesanan
                                </a>
                                <a href="" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <nav class="navbar navbar-secondary navbar-expand-lg">
                    <div class="container">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a href="<?= base_url(); ?>" class="nav-link "><i class='fas fa-home'></i><span>HOME</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class='fas fa-book-open'></i></i><span>DAFTAR PAKET</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-clone"></i><span>GALERI</span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
                                    <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                            <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                                                <ul class="dropdown-menu">
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="main-content">
                <section class="section">
                    <?= $this->renderSection('content') ?>
                </section>
            </div>
        </div>
        <footer class="main-footer">
            <div class="hero bg-matcha text-white">
                <div class="hero-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Lokation</h4>
                                <ul class="Location">
                                    <li><i class='fas fa-map-marker-alt'></i> Jl. Darsono Barat no.15 Kota Batu</li>
                                    <li><i class='fas fa-phone'></i> 0341-5107999</li>
                                    <li><i class='far fa-envelope'></i> catering_yeyen@yahoo.com</li>
                                    <li><i class="fab fa-whatsapp"></i> 085100204185</li>
                                </ul>
                            </div>
                            <div class="col">
                                <h4>Navigation</h4>
                                <ul class="navigasi">
                                    <li>
                                        <a class="text-white" href="<?= base_url(); ?>">Home</a>
                                    </li>
                                    <li>
                                        <a class="text-white" href="#">Paket</a>
                                    </li>
                                    <li>
                                        <a class="text-white" href="<?= base_url(); ?>">Menu</a>
                                    </li>
                                    <li>
                                        <a class="text-white" href="<?= base_url(); ?>">Kontak</a>
                                    </li>
                                    <li>
                                        <a class="text-white" href="<?= base_url(); ?>">Tentang</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <h4>Our Business</h4>
                                <ul class="business">
                                    <li>Warung Emak</li>
                                    <li>D'Jebrax Cafe</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-bg bg-matcha2 text-white text-center">
                <br>
                Copyright &copy; 2022 <div class="bullet"></div><br><br>
                Mohammad Fajar Mahendra <br>________________________<br>

                <a href="#" data-toggle="tooltip" title="" data-original-title="Instagram"> <i class="fab fa-instagram"></i></a>

            </div>

        </footer>

        <script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?= base_url(); ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/moment/min/moment.min.js"></script>
        <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>

        <!-- JS Libraies -->
        <script src="<?= base_url() ?>/template/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/chart.js/dist/Chart.min.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/summernote/dist/summernote-bs4.js"></script>
        <script src="<?= base_url() ?>/template/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

        <!-- Template JS File -->
        <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
        <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

</body>

</html>