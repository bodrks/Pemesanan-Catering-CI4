<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h4 class="card-title">Data Admin</h4>
</div>
<div class="container">
    <div class="text-right">
        <a class="btn btn-warning mb-3" href="<?= base_url('/master/admin/add'); ?>" role="button">Tambah Data</a>
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
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Admin</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($getAdmin as $adm) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $adm['username']; ?></td>
                                <td><?= $adm['email']; ?></td>
                                <td><?= $adm['nama_admin']; ?></td>
                                <td><?= $adm['no_telp']; ?></td>
                                <td>
                                    <a href="<?= base_url('master/admin/' . $adm['username'] . '/edit'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                        <i class='fas fa-pencil-alt'></i></a>
                                    <a href="<?= base_url('master/admin/' . $adm['username'] . '/hapus'); ?>" onclick="javascript:return confirm('Apakah Anda yakin ingin menghapus data Admin?')" class="btn btn-danger">
                                        <i class='fas fa-trash-alt'></i></a>
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