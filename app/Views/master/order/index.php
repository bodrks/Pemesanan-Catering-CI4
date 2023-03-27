<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h4>Data Pemesanan</h4>
</div>
<div class="container">
    <div class="text-right">
        <a class="btn btn-warning mb-3" href="<?= base_url('/master/order/add'); ?>" role="button">Tambah Pesanan</a>
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
                <table class="table table-bordered table-sm table-striped">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 2%;">No</th>
                            <th style="width: 12%;">Tanggal Pemesanan</th>
                            <th style="width: 12%;">Id Pemesanan</th>
                            <th style="width: 15%;">Customer</th>
                            <th style="width: 12%;">Tanggal Digunakan</th>
                            <th style="width: 8%;">Metode Pembayaran</th>
                            <th style="width: 7%;">Status</th>
                            <th style="width: 15%;">Total</th>
                            <th style="width: 12%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($getOrder as $order) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= date('d F Y', strtotime($order['tgl_pemesanan'])); ?></td>
                                <td><?= $order['id_pemesanan']; ?></td>
                                <td><?= $order['nama']; ?></td>
                                <td><?= date('d F Y', strtotime($order['tgl_digunakan'])); ?></td>
                                <td><?= $order['payment_method']; ?></td>
                                <td><?php if ($order['transaction_status'] == 'pending') { ?>
                                        <span class="badge bg-secondary text-white">Pending</span>
                                    <?php } else if ($order['transaction_status'] == 'settlement') { ?>
                                        <span class="badge bg-success text-white">Success</span>
                                    <?php  } else if ($order['transaction_status'] == 'cancel') { ?>
                                        <span class="badge bg-warning text-white">Canceled</span>
                                    <?php  } else { ?>
                                        <span class="badge bg-danger text-white">Expire</span>
                                    <?php  } ?>
                                </td>
                                <td><?= number_to_currency($order['total'], 'IDR', 'id_IDN'); ?></td>

                                <td>
                                    <a href=" <?= base_url('master/order/' . $order['id_pemesanan'] . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-light">
                                        <i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('master/order/struk/' . $order['id_pemesanan']); ?>" data-toggle="tooltip" title="Cetak" class="btn btn-sm btn-danger">
                                        <i class="fas fa-print"></i></a>
                                    <?php if ($order['payment_method'] == 'Cash') { ?>
                                        <a href="<?= base_url('master/order/editstatus/' . $order['id_pemesanan']); ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Status Pembayaran">
                                            <i class="fas fa-pencil-alt"></i></a>
                                    <?php } ?>
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