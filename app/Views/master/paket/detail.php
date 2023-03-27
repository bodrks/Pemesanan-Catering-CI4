<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h2>Detail Paket</h2>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2 text-center">Paket <?= $paket->nama_paket; ?></h2><br>
            <div class="card mb-3" style="max-width: 1080px;">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide="0" class="active"></li>
                                    <?php $i = 1;
                                    for ($i = 1; $i < count($gambar); $i++) { ?>
                                        <li data-target="#carouselExampleIndicators" data-slide="<?= $i; ?>"></li>
                                    <?php
                                    } ?>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <?php if (count($gambar) < 1) { ?>
                                            <img src="/images/<?= $paket->gambar; ?>" alt="First slide">
                                        <?php  } else { ?>
                                            <img src="/images/<?= $gambar[0]->gambar_paket; ?>" alt="First slide">
                                        <?php  } ?>
                                    </div>
                                    <?php $j = 1;
                                    for ($j = 1; $j < count($gambar); $j++) { ?>
                                        <div class="carousel-item">
                                            <img src="/images/<?= $gambar[$j]->gambar_paket; ?>" alt="">
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <p class="card-text"><?= $paket->deskripsi; ?></p><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h4 class="card-title">Menu:</h4>
                            <?php
                            foreach ($menu as $key) { ?>
                                <p class="card-text"><?= $key->nama_menu; ?><br></p>
                            <?php } ?>
                            <a href="<?= base_url('master/paket/' . $paket->id_paket . '/edit'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                Edit</a>
                            <a href="<?= base_url('master/paket/' . $paket->id_paket . '/hapus'); ?>" onclick="javascript:return confirm('Apakah Anda yakin ingin menghapus data paket?')" class="btn btn-danger">
                                Hapus</a>
                            <br><br>
                            <a href="/master/paket">Kembali ke daftar paket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>