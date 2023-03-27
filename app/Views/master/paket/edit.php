<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Edit Data Paket</h4>
</div>
<div class="container">
    <a href="<?= base_url('master/paket'); ?>" class="btn btn-secondary mb-2"><i class="fa fa-home" aria-hidden="true"></i></a>
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
            <form method="post" action="<?= base_url('/master/paket/' . $paket->id_paket . '/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="gambarLama" value="<?= $paket->gambar; ?>">
                <div class="form-group row">
                    <label for="id_paket" class="col-sm-2 col-form-label">ID Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_paket" name="id_paket" value="<?= $paket->id_paket; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_paket')) ?
                                                                    'is-invalid' : ''; ?>" id="nama_paket" name="nama_paket" autofocus value="<?= $paket->nama_paket; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_paket'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ?
                                                                    'is-invalid' : ''; ?>" id="harga" name="harga" autofocus value="<?= $paket->harga; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <!-- <div class="col-sm-2">
                        <img src="/images/<?= $paket->gambar; ?>" class="img-thumbnail img-preview">
                    </div> -->
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input <?= ($validation->hasError('gambar')) ?
                                        'is=invalid' : ''; ?>" type="file" id="gambar" name="gambar[]" multiple>
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <span class="text-muted"><br>Jika tidak ada gambar yg diupload, gambar tidak akan diubah</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sel1" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10 col-md-4">
                        <div class="container" style="width:300px; height:300px; overflow-y:scroll; border:2px solid #ccc;">
                            <?php

                            use PhpParser\Node\Stmt\Echo_;

                            $dbselected = [];
                            $i = 0;
                            foreach ($menu as $mn) {
                                $dbselected[$i] = $mn->id_menu;
                                $i++;
                            }
                            $i = 0;
                            foreach ($datamenu as $dt) { ?>
                                <input type="checkbox" name="id_menu[]" id="id_menu" <?php if (in_array(
                                                                                            $dt->id_menu,
                                                                                            $dbselected
                                                                                        )) echo 'checked="checked"'; ?> value="<?= $dt->id_menu; ?>"> <?= $dt->nama_menu; ?><br>
                            <?php $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ?
                                                                    'is-invalid' : ''; ?>" name="deskripsi" id="deskripsi" value="<?= $paket->deskripsi; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-warning mt-2">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>