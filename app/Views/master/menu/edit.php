<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Ubah Data Menu</h4>
</div>
<div class="container">
    <a href="<?= base_url('master/menu/' . $menu->id_menu . '/detail'); ?>" class="btn btn-danger mb-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/menu/' . $menu->id_menu . '/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="gambarLama" value="<?= $menu->gambar; ?>">
                <div class="form-group row">
                    <label for="id_menu" class="col-sm-2 col-form-label">Id Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_menu" name="id_menu" value="<?= $menu->id_menu; ?>" readonly="readonly">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="nama_menu" class="col-sm-2 col-form-label">Nama Menu</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= $menu->nama_menu; ?>" class="form-control <?= ($validation->hasError('nama_menu')) ?
                                                                                                    'is-invalid' : ''; ?>" id="nama_menu" name="nama_menu">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_menu'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar Menu</label>
                    <div class="col-sm-2">
                        <img src="/images/<?= $menu->gambar; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="custom-file-input form-control <?= ($validation->hasError('gambar')) ?
                                                                                'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label class="custom-file-label" for="Gambar"><?= $menu->gambar; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="id_kategori" id="id_kategori">
                            <option selected value="<?= $selectkat->id_kategori; ?>"><?= $selectkat->nama_kategori; ?></option>
                            <?php foreach ($kategori as $value) { ?>
                                <option value="<?= $value->id_kategori; ?>"><?= $value->nama_kategori; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Menu</label>
                    <div class="col-sm-10">
                        <input type="text" min="0" class="form-control  <?= ($validation->hasError('deskripsi')) ?
                                                                            'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= $menu->deskripsi; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-warning mt-2">Update</button>
                </div>
            </form>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>