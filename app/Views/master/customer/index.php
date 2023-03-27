<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h4>Data Customer</h4>
</div>
<div class="container">
    <div class="text-right">
        <a class="btn btn-warning mb-3" href="<?= base_url('/master/customer/add'); ?>" role="button">Tambah Data</a>
    </div>
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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($getCustomer as $cst) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $cst['nama']; ?></td>
                                <td><?= $cst['email']; ?></td>
                                <td><?= $cst['no_telp']; ?></td>
                                <td><img src="/user_images/<?= $cst['gambar']; ?>" class="img-tumbnail img-preview img-mw-100" width="150px"></td>
                                <td>
                                    <a href="<?= base_url('master/customer/' . $cst['id_customer'] . '/detail'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                        Detail</a>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

</body>
<?= $this->endSection(); ?>