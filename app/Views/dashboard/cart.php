<?= $this->extend('layout/cart_template'); ?>

<?= $this->section('content'); ?>

<section class="breadcrumb-section pb-1 pt-1">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" style="color: black;">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('package'); ?>" style="color:black;">Packages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
        </ol>
    </div>
</section>
<section class="products-grid pb-4 pt-4">
    <div class="container pb-5 mt-n2 mt-md-n3">
        <?php if ($cart->totalItems() == 0) { ?>
            <div class="row">
                <div class="col-xl-9 col-md-8">
                    <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-matcha text-white"><span>Keranjang Masih Kosong</span><a class="font-size-sm" href="<?= base_url() ?>/package"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left" style="width: 1rem; height: 1rem;">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>Continue shopping</a></h2>
                </div>
            </div>
        <?php } else { ?>
            <form action="<?= base_url('cart/update'); ?>" method="POST">
                <div class="row">
                    <div class="col-xl-9 col-md-8">
                        <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-matcha text-white"><span>Keranjang Belanja</span><a class="font-size-sm" href="<?= base_url() ?>/package"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left" style="width: 1rem; height: 1rem;">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>Continue shopping</a></h2>
                        <!-- Item-->
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('gagal')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('gagal'); ?>
                            </div>
                        <?php endif; ?>
                        <?php $i = 1;
                        foreach ($cart->contents() as $key => $value) { ?>
                            <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                                <div class="media d-block d-sm-flex text-center text-sm-left">
                                    <a class="cart-item-thumb mx-auto mr-sm-4" href="#"><img src="<?= base_url('images/' . $value['options']['gambar']); ?>" alt="Product"></a>
                                    <div class="media-body pt-3">
                                        <h3 class="product-card-title font-weight-semibold border-0 pb-0"><a href="#">Paket <?= $value['name']; ?></a></h3>
                                        <div class="font-size-sm"><span class="text-muted mr-2">Harga :</span><?= number_to_currency($value['price'], 'IDR', 'id_IDN'); ?></div>
                                        <!-- <div class="font-size-sm"><span class="text-muted mr-2">Color:</span>Black</div> -->
                                        <div class="font-size-lg text-danger pt-2"><span class="text-dark">Sub Total : </span><?= number_to_currency($value['subtotal'], 'IDR', 'id_IDN'); ?></div>
                                    </div>
                                </div>
                                <div class="pt-2 pt-sm-0 pl-sm-3 mx-sm-0 text-center text-sm-left" style="max-width: 10rem;">
                                    <div class="form-group mb-2">
                                        <label for="quantity1">Quantity/Pack</label>
                                        <input class="form-control form-control-sm" type="number" min="50" id="qty" name="qty<?= $i++ ?>" value="<?= $value['qty']; ?>">
                                    </div>

                                    <a href="<?= base_url('cart/' . $value['rowid'] . '/delete'); ?>" class="btn btn-outline-danger btn-sm btn-block mb-2" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 mr-1">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>Remove</a>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-secondary btn-sm btn-block mb-2" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw mr-1">
                                        <polyline points="23 4 23 10 17 10"></polyline>
                                        <polyline points="1 20 1 14 7 14"></polyline>
                                        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                    </svg>Update Cart</button>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger btn-sm btn-block mb-2-inline" role="button" href="<?= base_url(); ?>/cart/clear">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 mr-1">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>Empty Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar-->
                    <div class="col-xl-3 col-md-4 pt-3 pt-md-0">
                        <h2 class="h6 px-4 py-3 bg-matcha text-white text-center">Subtotal</h2>
                        <div class="h3 font-weight-semibold text-center py-3"><?= number_to_currency($cart->total(), 'IDR', 'id_IDN'); ?><br>
                            <span class="text-sm text-muted" style="font-style: italic;">Tiga Juta Lima Ratus Tujuh Puluh Lima Ribu Rupiah</span>
                        </div>
                        <hr>
                        <a class="btn btn-matcha text-white btn-block" href="<?= base_url('/cart/checkout'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>Proceed to Checkout
                        </a>
                    </div>
                </div>
            </form>

        <?php } ?>
    </div>
</section>

<style type="text/css">
    body {
        margin-top: 20px;
    }

    .cart-item-thumb {
        display: block;
        width: 14rem
    }

    .cart-item-thumb>img {
        display: block;
        width: 100%
    }

    .product-card-title>a {
        color: #222;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }

    .product-card-title {
        display: block;
        margin-bottom: .75rem;
        padding-bottom: .875rem;
        border-bottom: 1px dashed #e2e2e2;
        font-size: 1rem;
        font-weight: normal;
    }

    .text-muted {
        color: #888 !important;
    }

    .bg-secondary {
        background-color: #f7f7f7 !important;
    }

    .accordion .accordion-heading {
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: bold;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }
</style>


<?= $this->endSection(); ?>