<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Tambah Data Menu</h4>
</div>
<div class="container">
    <a href="<?= base_url('/master/menu'); ?>" class="btn btn-secondary mb-2"><i class="fa fa-home" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/menu/save'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="id_menu" class="col-sm-2 col-form-label">Id Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_menu" name="id_menu" value="<?= $ambil; ?>" readonly="readonly">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="nama_menu" class="col-sm-2 col-form-label">Nama Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_menu')) ?
                                                                    'is-invalid' : ''; ?>" id="nama_menu" name="nama_menu" autofocus value="<?= old('nama_menu'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_menu'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar Menu</label>
                    <div class="col-sm-2">
                        <img src="/images/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="custom-file-input form-control <?= ($validation->hasError('gambar')) ?
                                                                                'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" autofocus value="<?= old('gambar'); ?>" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label class="custom-file-label" for="Gambar">Pilih gambar...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="id_kategori" id="id_kategori">
                            <?php foreach ($getKategori as $key => $value) { ?>
                                <option value="<?= $value->id_kategori; ?>"><?= $value->nama_kategori; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Menu</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('deskripsi')) ?
                                                            'is-invalid' : ''; ?>" name="deskripsi" id="deskripsi" cols="30" rows="10" autofocus value="<?= old('deskripsi'); ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
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
<?= $this->endSection(); ?>