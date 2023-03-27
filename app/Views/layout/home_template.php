<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title; ?></title>

    <!-- Bootstrap -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="<?= base_url(); ?>/home_template/assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/home_template/assets/css/font-awesome.css" rel="stylesheet">

    <!-- Jquery UI -->
    <link type="text/css" href="<?= base_url(); ?>/home_template/assets/css/jquery-ui.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="<?= base_url(); ?>/home_template/assets/css/argon-design-system.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link type="text/css" href="<?= base_url(); ?>/home_template/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?= base_url(); ?>/home_template/package/dist/sweetalert2.min.css">

    <!-- Optional Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <header class="header clearfix bg-matcha2">
        <div class="top-bar d-none d-sm-block bg-matcha2">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <ul class="top-links contact-info">
                            <li><i class="fa fa-envelope-o"></i> catering_yeyen@yahoo.com </li>
                            <li><i class="fa fa-whatsapp"></i> +62 85100204185</li>
                        </ul>
                    </div>
                    <div class="col-6 text-right">
                        <ul class="top-links account-links">
                            <?php if ($name == '') { ?>
                                <li><i class="fa fa-user-plus"></i> <a href="<?= base_url('/register'); ?>">Register</a></li>
                                <li><i class="fa fa-power-off"></i> <a href="<?= base_url('/login'); ?>">Login</a></li>
                            <?php } else { ?>
                                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                        <i class="fa fa-user-circle-o"></i>
                                        <div class="d-sm-none d-lg-inline-block">Hi, <?= $name; ?> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-title text-dark"></div>
                                        <a href="<?= base_url(); ?>/profil" class="dropdown-item has-icon text-dark">
                                            <i class="fa fa-user" style="color: black;"></i> Profile
                                        </a>
                                        <a href="<?= base_url(); ?>/profil/order" class="dropdown-item has-icon text-dark">
                                            <i class="fa fa-shopping-bag" style="color: black;"></i> Pesanan Saya
                                        </a>
                                        <!-- <a href="#" class="dropdown-item has-icon text-dark">
                                            <i class="fa fa-cog" style="color: black;"></i> Settings
                                        </a> -->
                                        <div class="dropdown-divider"></div>
                                        <a href="<?= base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                                            <i class="fa fa-sign-out" style="color: red;"></i> Logout
                                        </a>
                                    </div>
                                </li>
                            <?php   } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-12 col-sm-6">
                        <a class="navbar-brand text-white mr-lg-5" href="<?= base_url(); ?>">
                            <span class="logo">Yeyen Catering</span>
                        </a>
                    </div>
                    <div class="col-lg-7 col-12 col-sm-6">
                        <form action="#" class="search">
                            <div class="input-group w-100">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-matcha" type="submit">
                                        <i class="fa fa-search" style="color: #fff;"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-12 col-sm-6">
                        <div class="right-icons pull-right d-none d-lg-block">
                            <div class="single-icon wishlist">
                                <li class="nav-item dropdown">
                                    <a data-toggle="dropdown" title="Pesanan" href="#" aria-expanded="true"><i class="fa fa-bell-o fa-2x"></i></a>
                                    <?php if (count($pending) > 0) { ?>
                                        <span class="badge badge-default"><?= count($pending); ?></span>
                                    <?php } ?>
                                    <div class="dropdown-menu dropdown-menu-lg">
                                        <p class="text-center">Order</p>
                                        <?php foreach ($pending as $key => $value) { ?>
                                            <a href="#" class="dropdown-item">
                                                <div class="fotopending">
                                                    <div class="fotopending-body">
                                                        <h3 class="dropdown-item-title">
                                                            Pesanan <?= $value->id_pemesanan; ?>
                                                        </h3>
                                                        <p class="text-sm">Tanggal : <?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></p>
                                                        <p class="text-sm text-muted"><?php if (($value->transaction_status) == 'pending') { ?>
                                                        <div class="font-size-lg"><span class="badge bg-warning">Menunggu Pembayaran</span></div>
                                                    <?php } else if (($value->transaction_status) == 'settlement') { ?>
                                                        <div class="font-size-lg"><span class="badge bg-success">Sukses</span></div>
                                                    <?php } else { ?>
                                                        <div class="font-size-lg"><span class="badge bg-danger">Gagal</span></div>
                                                    <?php  } ?></p>
                                                    <p class="text-sm" style="color: red;"><?= number_to_currency($value->total, 'IDR', 'id_IDN'); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <div class="dropdown-divier border-top"></div>
                                        <a class="dropdown-item dropdown-footer" href="<?= base_url('/profil/order'); ?>">Show Order</a>
                                    </div>
                                </li>
                            </div>
                            <?php
                            $keranjang = $cart->contents();
                            $jml_item = 0;
                            $jml_item = $jml_item + count($keranjang);
                            ?>
                            <div class="single-icon shopping-cart">
                                <li class="nav-item dropdown">
                                    <a data-toggle="dropdown" title="Keranjang" href="#" aria-expanded="true"><i class="fa fa-shopping-cart fa-2x"></i></a>
                                    <?php if ($jml_item > 0) { ?>
                                        <span class="badge badge-default"><?= $jml_item; ?></span>
                                    <?php } ?>
                                    <div class="dropdown-menu dropdown-menu-lg">
                                        <?php if (empty($keranjang)) { ?>
                                            <a class="dropdown-item" href="#">
                                                <p>Keranjang masih kosong</p>
                                            </a>
                                        <?php } else { ?>
                                            <p class="text-center">Items</p>
                                            <?php foreach ($keranjang as $key => $value) { ?>
                                                <a class="dropdown-item" href="#">
                                                    <div class="fotokeranjang">
                                                        <img src="<?= base_url('images/' . $value['options']['gambar']); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                                        <div class="fotokeranjang-body">
                                                            <h3 class="dropdown-item-title">
                                                                Paket <?= $value['name']; ?>
                                                                <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                                                            </h3>
                                                            <p class="text-sm"><?= number_to_currency($value['price'], 'IDR'); ?></p>
                                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= $value['qty']; ?> item</p>
                                                            <p class="text-sm" style="color: red;"><?= number_to_currency($value['subtotal'], 'IDR'); ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php } ?>
                                            <div class="dropdown-divier border-top"></div>
                                            <a class="dropdown-item dropdown-footer" href="<?= base_url('cart'); ?>">Show Cart</a>
                                        <?php } ?>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom bg-matcha">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= base_url(); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">Pages</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url(); ?>/package">Package</a>
                                <a class="dropdown-item" href="product-detail.html">Gallery</a>
                                <?php if ($keranjang > 0) { ?>
                                    <a class="dropdown-item" href="<?= base_url('cart'); ?>">Cart</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div> <!-- collapse .// -->
            </div> <!-- container .// -->
        </nav>
    </header>
    <!------------------------------------------
    SLIDER
    ------------------------------------------->

    <?= $this->renderSection('content'); ?>

    <footer class="footer bg-matcha2">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo-footer">
                                <span class="logo">Yeyen Catering</span>
                            </div>
                            <p class="text">Sektor: Belanja » Hadiah, kartu dan persediaan pesta<br>
                                Industri: Katering untuk acara, Hadiah, kartu dan persediaan pesta, Toko Pengantin</p>
                            <p class="call">Got Question? Call us 24/7<span>+0341-5107999</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Our Location</h4>
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Jl. Darsono Barat no.15 Kota Batu</li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> 0341-5107999</li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i> catering_yeyen@yahoo.com</li>
                                <li><i class="fa fa-whatsapp" aria-hidden="true"></i> 085100204185 (Yeyen/Owner)</li>
                                <li><i class="fa fa-whatsapp" aria-hidden="true"></i> 082143181909 (Marketing/Adi)</li>
                                <li><i class="fa fa-whatsapp" aria-hidden="true"></i> 081233944859 (Marketing/Lilin)</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-inner border-top">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p>Copyright © 2022 Mohammad Fajar Mahendra -
                                    All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Core -->
    <script src="<?= base_url(); ?>/home_template/assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/home_template/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>/home_template/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/home_template/assets/js/core/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/home_template/package/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>/home_template/package/dist/sweetalert2.min.js"></script>

    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Argon JS -->
    <!-- <script src="/public/home_template/assets/js/argon-design-system.js"></script> -->

    <!-- Main JS-->
    <script src="<?= base_url(); ?>/home_template/assets/js/main.js"></script>
</body>

</html>