<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h2 class="mt-2">Detail Customer</h2>
</div>
<div class="section-body">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="/images/<?= $customer->gambar; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $customer->nama; ?></h5><br>
                                <p class="card-title">id : <?= $customer->id_customer; ?></h5>
                                <p class="card-text">email : <?= $customer->email; ?><br>
                                    alamat : <?= $customer->alamat; ?>
                                </p>

                                <a href="<?= base_url('master/customer/' . $customer->id_customer . '/edit'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                    Edit</a>
                                <a href="<?= base_url('master/customer/' . $customer->id_customer . '/hapus'); ?>" onclick="javascript:return confirm('Apakah Anda yakin ingin menghapus data customer?')" class="btn btn-danger">
                                    Hapus</a>
                                <br><br>
                                <a href="/master/customer">Kembali ke daftar customer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>