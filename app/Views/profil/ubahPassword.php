<?= $this->extend('layout/profil_template'); ?>

<?= $this->section('content'); ?>
<div class="col-lg-8 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
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
                <h5>Ubah Password </h5>
            </div>
            <form method="post" action="<?= base_url('/profil/' . $customer[0]->id_customer . '/resetpassword'); ?>">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer[0]->id_customer; ?>">
                <div class="container border-top pb-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row pt-4">
                                <label for="old_password" class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="old_password" name="old_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control <?= $validation->hasError('new_password') ?
                                                                                    'is-invalid' : ''; ?>" id="new_password" name="new_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('new_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="conf_password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-9 ">
                                    <input type="password" class="form-control <?= $validation->hasError('conf_password') ?
                                                                                    'is-invalid' : ''; ?>" id="conf_password" name="conf_password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('conf_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-warning mt-2">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->renderSection('scripts') ?>
<script>
    function previewImg() {

        const gambar = document.querySelector('#gambar');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>