<?= $this->extend('layout/home_template'); ?>

<?= $this->section('content'); ?>

<section class="breadcrumb-section pb-1 pt-1">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" style="color: black;">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('package'); ?>" style="color:black;">Packages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
        </ol>
    </div>
</section>
<section class="product-page pt-4">
    <div class="container">
        <div class="row product-detail-inner">
            <div class="col-lg-6 col-md-6 col-12">
                <div id="product-images" class="carousel slide" data-ride="carousel">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <?php if (count($gambar) < 1) { ?>
                            <div class="carousel-item active"> <img src="/images/<?= $paket->gambar; ?>" alt="Product 1"> </div>
                        <?php } else { ?>
                            <div class="carousel-item active"> <img src="/images/<?= $gambar[0]->gambar_paket; ?>" alt="Product 1"> </div>
                        <?php  }
                        for ($i = 1; $i < count($gambar); $i++) { ?>
                            <div class="carousel-item"><img src="/images/<?= $gambar[$i]->gambar_paket; ?>" alt=""></div>
                        <?php  }
                        ?>
                    </div> <!-- Left right -->
                    <a class="carousel-control-prev" href="#product-images" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#product-images" data-slide="next"> <span class="carousel-control-next-icon"></span> </a><!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        <?php if (count($gambar) < 1) { ?>
                            <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="/images/<?= $paket->gambar; ?>" class="img-fluid"> </a> </li>
                        <?php } else { ?>
                            <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="/images/<?= $gambar[0]->gambar_paket; ?>" class="img-fluid"> </a> </li>
                        <?php }
                        for ($j = 1; $j < count($gambar); $j++) { ?>
                            <li class="list-inline-item"> <a id="carousel-selector-<?= $j; ?>" data-slide-to="<?= $j; ?>" data-target="#product-images"> <img src="/images/<?= $gambar[$j]->gambar_paket; ?>" class="img-fluid"> </a> </li>
                        <?php }
                        ?>

                    </ol>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="product-detail">
                    <h2 class="product-name">Paket <?= $paket->nama_paket; ?></h2>
                    <div class="product-price">
                        <span class="price"><?= number_to_currency($paket->harga, 'IDR', 'id_IDN'); ?></span>
                    </div>
                    <div class="product-short-desc">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-details">
                                    <div class="card border-1">
                                        <div class="card-header bg-white">
                                            <h6>Deskripsi</h6>
                                        </div>
                                        <div class="card-body" style="height: 200px;">
                                            <p><?= $paket->deskripsi; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-select">
                        <?php echo form_open('package/add');
                        echo form_hidden('id', $paket->id_paket);
                        echo form_hidden('price', $paket->harga);
                        echo form_hidden('name', $paket->nama_paket);
                        echo form_hidden('gambar', $paket->gambar);
                        echo form_hidden('qty', '50');
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-matcha btn-block text-white">Add to Cart (50)</button>
                            </div>
                        </div>
                        <?php form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-page pb-4">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h4 class="pb-4">Menu Paket <?= $paket->nama_paket; ?></h4>
        </div>
        <div class="row pt-2">
            <?php foreach ($menu as $key => $value) { ?>
                <div class="col-md-3">
                    <div class="card border-0 pt-2" style="width: 16rem;">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="/images/<?= $value->gambar; ?>" width="100px" alt="<?= $value->nama_menu; ?>">
                            </div>
                            <div class="col-sm-7 text-center">
                                <span class="pt-4"><?= $value->nama_menu; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<style>
    .nav-pills .nav-link {
        padding: 0.75rem 1rem;
        color: #137C5D;
        font-weight: 500;
        font-size: .875rem;
        box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
        background-color: #fff;
        transition: all .15s ease;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #137C5D;
    }

    .product-page .product-detail-inner {
        min-height: 600px;
    }
</style>
<?= $this->endSection(); ?>