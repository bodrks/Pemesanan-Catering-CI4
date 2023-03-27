<?= $this->extend('layout/home_template'); ?>

<?= $this->section('content'); ?>

<section class="breadcrumb-section pb-1 pt-1">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>" style="color: black;">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Packages</li>
        </ol>
    </div>
</section>
<section class="products-grid pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="products-top">
                            <div class="products-top-inner">
                                <div class="products-found">
                                    <p> Pembelian paket minimal 50 pack</p>
                                </div>
                                <div class="products-sort">
                                    <span>Sort By : </span>
                                    <select>
                                        <option>Default</option>
                                        <option>Price</option>
                                        <option>Recent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="row">
                    <?php foreach ($paket as $key => $value) { ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <?php echo form_open('package/add');
                            echo form_hidden('id', $value['id_paket']);
                            echo form_hidden('price', $value['harga']);
                            echo form_hidden('name', $value['nama_paket']);
                            echo form_hidden('gambar', $value['gambar']);
                            echo form_hidden('qty', '50');
                            ?>
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="<?= base_url('package/detail/' . $value['id_paket']); ?>">
                                        <img src="/images/<?= $value['gambar']; ?>" class="img-fluid" />
                                    </a>
                                </div>
                                <div class="product-content text-center">
                                    <h3><a href="<?= base_url('package/detail/' . $value['id_paket']); ?>">Paket <?= $value['nama_paket']; ?></a></h3>
                                    <div class="product-price text-center">
                                        <span><?= number_to_currency($value['harga'], 'IDR', 'id_IDN') ?></span><br><br>
                                    </div>
                                    <button type="submit" class="btn btn-matcha text-white inline" data-toggle="tooltip" data-placement="top" title="Add to Cart (50)"><i class="fa fa-cart-plus" aria-hidden="true"></i></i> (50)</button>
                                    <a href="<?= base_url('package/detail/' . $value['id_paket']); ?>" class="btn btn-matcha text-white inline" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>