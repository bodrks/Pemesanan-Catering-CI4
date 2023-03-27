<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h4>Data Paket</h4>
</div>
<div class="container">
    <div class="text-right">
        <a class="btn btn-warning mb-3" href="<?= base_url('/master/paket/add'); ?>" role="button">Tambah Data</a>
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
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Paket</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($getPaket as $pkt) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $pkt['id_paket']; ?></td>
                                <td><?= $pkt['nama_paket']; ?></td>
                                <td><img src="/images/<?= $pkt['gambar']; ?>" class="img-tumbnail img-preview img-mw-100" width="150px"></td>
                                <td>
                                    <a href="<?= base_url('master/paket/' . $pkt['id_paket'] . '/detail'); ?>" class="btn btn-success" data-bs-target="#editModal">
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