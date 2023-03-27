<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Edit Data Admin</h4>
</div>
<div class="container">
    <a href="<?= base_url('/master/admin'); ?>" class="btn btn-danger mb-2"><i class="fa fa-times" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/admin/update'); ?>">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" readonly="readonly" value="<?= $admin->username; ?>" name="username" required class="form-control <?= ($validation->hasError('username')) ?
                                                                                                                                                'is-invalid' : ''; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" value="<?= $admin->email; ?>" name="email" required class="form-control <?= ($validation->hasError('email')) ?
                                                                                                                    'is_invalid' : ''; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nama Admin</label>
                    <input type="text" value="<?= $admin->nama_admin; ?>" name="nama_admin" required class="form-control  <?= ($validation->hasError('nama_admin')) ?
                                                                                                                                'is-invalid' : ''; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_admin'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">No Telepon</label>
                    <input type="text" value="<?= $admin->no_telp; ?>" name="no_telp" required class="form-control <?= ($validation->hasError('no_telp')) ?
                                                                                                                        'is-invalid' : ''; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_telp'); ?>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-warning mt-2">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>