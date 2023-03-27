<?= $this->extend('layout/profil_template'); ?>

<?= $this->section('content'); ?>
<div class="col-lg-10 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>Profil Saya </h5>
                <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
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
            </div>
            <form method="post" action="<?= base_url('/profil/' . $customer[0]->id_customer . '/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer[0]->id_customer; ?>">
                <input type="hidden" name="gambarLama" value="<?= $customer[0]->gambar; ?>">
                <div class="container border-top">
                    <div class="row">
                        <div class="col-lg-8 border-right">
                            <div class="form-group row pt-2">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <label for="username" class="col-form-label"><?= $customer[0]->username; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $customer[0]->nama; ?>">
                                </div>
                            </div>
                            <div class="form-group row pt-2">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9 ">
                                    <label for="email" class="col-form-label"><?= $customer[0]->email; ?></label>
                                </div>
                            </div>
                            <div class="form-group row pt-2">
                                <label for="no_telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $customer[0]->no_telp; ?>">
                                </div>
                            </div>
                            <div class="form-group row pt-2">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $customer[0]->alamat; ?>">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-warning mt-2">Simpan</button>
                            </div>
                        </div>
                        <div class="col-lg-4 pt-3">
                            <div class="form-check row" style="padding-left: 3.5rem;">
                                <div class="col">
                                    <img src="/user_images/<?= $customer[0]->gambar; ?>" alt="logo" width="150" height="150" class="shadow-light rounded-circle img-thumbnail img-preview">
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col">
                                    <div class="custom-file" style="position: unset;">
                                        <label class="custom-file-label" for="gambar"><?= $customer[0]->gambar; ?></label>
                                        <input type="file" class="custom-file-input <?= ($validation->hasError('gambar')) ?
                                                                                        'is_invalid' : ''; ?>" onchange="previewImg()" id="gambar" name="gambar">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gambar'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4 pl-5">
                                <div class="col">
                                    <span class="text-muted">Ukuran gambar maks 2 MB</span><br>
                                    <span class="text-muted">Format gambar JPG, JPEG, PNG</span>
                                </div>
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