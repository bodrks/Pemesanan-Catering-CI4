<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Tambah Data Paket</h4>
</div>
<div class="container">
    <a href=" <?= base_url('/master/paket'); ?>" class="btn btn-secondary mb-2"><i class="fa fa-home" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
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
            <form method="post" action="<?= base_url('/master/paket/save'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="id_paket" class="col-sm-2 col-form-label">ID Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_paket" name="id_paket" value="<?= $ambil; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_paket')) ?
                                                                    'is-invalid' : ''; ?>" id="nama_paket" name="nama_paket" autofocus value="<?= old('nama_paket'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_paket'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ?
                                                                    'is-invalid' : ''; ?>" id="harga" name="harga" autofocus value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input class="form-control <?= ($validation->hasError('gambar')) ?
                                                            'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar[]" multiple="multiple">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <!-- <label class="custom-file-label" for="Gambar"></label> -->
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sel1" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10 col-md-4">
                        <div class="container" style="width: 350px; height:300px; overflow-y:scroll; border:1px solid #ccc;">
                            <?php foreach ($menu as $mn) { ?>
                                <input type="checkbox" value="<?= $mn->id_menu; ?>" name="id_menu[]" id="id_menu"> <?= $mn->nama_menu; ?><br>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Paket</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('deskripsi')) ?
                                                            'is-invalid' : ''; ?>" name="deskripsi" id="deskripsi" cols="30" rows="10" autofocus value="<?= old('deskripsi'); ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-warning mt-2" id="simpanPaket">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>