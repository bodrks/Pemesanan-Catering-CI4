<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Edit Data Customer</h4>
</div>
<div class="container">
    <a href="<?= base_url('/master/customer/' . $customer->id_customer . '/detail'); ?>" class="btn btn-danger mb-2"><i class="fa fa-times" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/customer/' . $customer->id_customer . '/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="gambarLama" value="<?= $customer->gambar; ?>">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $customer->nama; ?>" name="nama" required class="form-control <?= ($validation->hasError('nama')) ?
                                                                                                                        'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" value="<?= $customer->email; ?>" name="email" required class="form-control <?= ($validation->hasError('email')) ?
                                                                                                                            'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $customer->no_telp; ?>" name="no_telp" required class="form-control <?= ($validation->hasError('no_telp')) ?
                                                                                                                                'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $customer->alamat; ?>" name="alamat" required class="form-control <?= ($validation->hasError('alamat')) ?
                                                                                                                            'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/user_images/<?= $customer->gambar; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('gambar')) ?
                                                                            'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                            <label for="Gambar" class="custom-file-label"><?= $customer->gambar; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $customer->id_customer; ?>" name="id_customer">
                <div class="text-right">
                    <button class="btn btn-warning mt-2">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>