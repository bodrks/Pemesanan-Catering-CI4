<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h2 class="mt-2">Detail Menu</h2>
</div>
<div class="section-body">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="/images/<?= $menu->gambar; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $menu->nama_menu; ?></h5><br>
                                <p class="card-title">Kategori: <?= $kategori->nama_kategori; ?></h5>
                                <p class="card-text"><?= $menu->deskripsi; ?></p>

                                <a href="<?= base_url('master/menu/' . $menu->id_menu . '/edit'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                    Edit</a>
                                <a href="<?= base_url('master/menu/' . $menu->id_menu . '/hapus'); ?>" onclick="javascript:return confirm('Apakah Anda yakin ingin menghapus data Menu?')" class="btn btn-danger">
                                    Hapus</a>
                                <br><br>
                                <a href="/master/menu">Kembali ke daftar menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>