<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Tambah Data Customer</h4>
</div>
<div class="container">
    <a href="<?= base_url('/master/customer'); ?>" class="btn btn-danger mb-2"><i class="fa fa-times" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/customer/save'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="id_customer" class="col-form-label">Id Customer</label>
                    <input type="text" class="form-control" id="id_customer" name="id_customer" value="<?= $ambil; ?>" readonly="readonly">
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-form-label">Nama Customer</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ?
                                                                'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control  <?= ($validation->hasError('email')) ?
                                                                    'is-invalid' : ''; ?>" id="email" name="email" autofocus value="<?= old('email'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-form-label">Username</label>
                    <input type="text" class="form-control  <?= ($validation->hasError('username')) ?
                                                                'is-invalid' : ''; ?>" id="username" name="username" autofocus value="<?= old('username'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-form-label">No. Telp</label>
                    <input type="text" min="0" class="form-control  <?= ($validation->hasError('no_telp')) ?
                                                                        'is-invalid' : ''; ?>" id="no_telp" name="no_telp" autofocus value="<?= old('no_telp'); ?>" size="13" onkeypress="return event.charCode >= 48 && event.charCode<=57">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_telp'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-form-label">Alamat</label>
                    <input type="text" class="form-control  <?= ($validation->hasError('alamat')) ?
                                                                'is-invalid' : ''; ?>" id="alamat" name="alamat" autofocus value="<?= old('alamat'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ?
                                                                        'is-invalid' : ''; ?>" id="password" name="password" autofocus value="<?= old('password'); ?>">
                        <div class="input-group-prepend">
                            <button class="btn rounded-end" type="button">
                                <h7 toggle="#password" class="fa fa-eye fa-lg show-hide"></h7>
                            </button>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/user_images/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="custom-file-input <?= ($validation->hasError('gambar')) ?
                                                                'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" autofocus value="<?= old('gambar'); ?>" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label class="custom-file-label" for="Gambar">Pilih gambar...</label>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-warning mt-2">Simpan</button>
                </div>
            </form>
        </div>
        </form>
    </div>
</div>
<script src="<?= base_url(); ?>vendor\twbs\bootstrap\dist\js\bootstrap.bundle.min.js">
</script>
<script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
<script>
    $(".show-hide").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<?= $this->endSection(); ?>