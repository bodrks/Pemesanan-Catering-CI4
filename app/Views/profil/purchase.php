<?= $this->extend('layout/profil_template'); ?>

<?= $this->section('content'); ?>
<div class="col-lg-10 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h5>Pesanan</h5>
            </div>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Menunggu Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Semua Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Pesanan Sukses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">Pesanan Gagal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">Pesanan Dibatalkan</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <?php if (count($pesanan_pending) < 1) { ?>
                                <h6>Pesanan Kosong</h6>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-center">
                                        <thead class="thead bg-matcha text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Digunakan</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($pesanan_pending as $key => $value) {
                                                $status = \Midtrans\Transaction::status($value->order_id); ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $value->id_pemesanan; ?></td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                    <td><?php if (($status->transaction_status) == 'pending') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div>
                                                        <?php } else if (($status->transaction_status) == 'settlement') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div>
                                                        <?php } else if (($status->transaction_status) == 'cancel') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div>
                                                        <?php } else { ?>
                                                            <div class="font-size-lg"><span class="badge bg-danger text-whiter">Gagal</span></div>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                    <td><a href="<?= base_url('profil/order/' . $value->id_pemesanan . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary mr-0" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <?php if (($status->transaction_status) == 'settlement') { ?>
                                                            <a href="<?= base_url('profil/' . $value->id_pemesanan . '/invoice'); ?>" class="btn btn-sm btn-danger mr-0" role="button" data-toggle="tooltip" title="Faktur"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if ((($status->transaction_status) != 'expired') && (($status->transaction_status) != 'settlement') && (($status->transaction_status) != 'cancel')) { ?>
                                                            <a href="<?= base_url('profil/order/' . $value->order_id . '/cancel'); ?>" class="btn btn-sm btn-warning" role="button" data-toggle="tooltip" title="Batalkan pesanan" onclick="javascript:return confirm('Apakah Anda yakin ingin membatalkan pesanan ?')"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <?php if (count($pesanan_semua) < 1) { ?>
                                <h6>Pesanan Kosong</h6>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-center">
                                        <thead class="thead bg-matcha text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Digunakan</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($pesanan_semua as $key => $value) {
                                                $status = \Midtrans\Transaction::status($value->order_id); ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $value->id_pemesanan; ?></td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                    <td><?php if (($status->transaction_status) == 'pending') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div>
                                                        <?php } else if (($status->transaction_status) == 'settlement') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div>
                                                        <?php } else if (($status->transaction_status) == 'cancel') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div>
                                                        <?php } else { ?>
                                                            <div class="font-size-lg"><span class="badge bg-danger text-whiter">Gagal</span></div>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                    <td><a href="<?= base_url('profil/order/' . $value->id_pemesanan . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary mr-0" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <?php if (($status->transaction_status) == 'settlement') { ?>
                                                            <a href="<?= base_url('profil/' . $value->id_pemesanan . '/invoice'); ?>" class="btn btn-sm btn-danger mr-0" role="button" data-toggle="tooltip" title="Faktur"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if ((($status->transaction_status) != 'expired') && (($status->transaction_status) != 'settlement') && (($status->transaction_status) != 'cancel')) { ?>
                                                            <a href="<?= base_url('profil/order/' . $value->order_id . '/cancel'); ?>" class="btn btn-sm btn-warning" role="button" data-toggle="tooltip" title="Batalkan pesanan" onclick="javascript:return confirm('Apakah Anda yakin ingin membatalkan pesanan ?')"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <?php if (count($pesanan_sukses) < 1) { ?>
                                <h6>Pesanan Kosong</h6>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-center">
                                        <thead class="thead bg-matcha text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Digunakan</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($pesanan_sukses as $key => $value) {
                                                $status = \Midtrans\Transaction::status($value->order_id); ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $value->id_pemesanan; ?></td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                    <td><?php if (($status->transaction_status) == 'pending') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div>
                                                        <?php } else if (($status->transaction_status) == 'settlement') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div>
                                                        <?php } else if (($status->transaction_status) == 'cancel') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div>
                                                        <?php } else { ?>
                                                            <div class="font-size-lg"><span class="badge bg-danger text-whiter">Gagal</span></div>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                    <td><a href="<?= base_url('profil/order/' . $value->id_pemesanan . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary mr-0" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <?php if (($status->transaction_status) == 'settlement') { ?>
                                                            <a href="<?= base_url('profil/' . $value->id_pemesanan . '/invoice'); ?>" class="btn btn-sm btn-danger mr-0" role="button" data-toggle="tooltip" title="Faktur"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <?php if ((($status->transaction_status) != 'expired') && (($status->transaction_status) != 'settlement') && (($status->transaction_status) != 'cancel')) { ?>
                                                            <a href="<?= base_url('profil/order/' . $value->order_id . '/cancel'); ?>" class="btn btn-sm btn-warning" role="button" data-toggle="tooltip" title="Batalkan pesanan" onclick="javascript:return confirm('Apakah Anda yakin ingin membatalkan pesanan ?')"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                            <?php if (count($pesanan_expired) < 1) { ?>
                                <h6>Pesanan Kosong</h6>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-center">
                                        <thead class="thead bg-matcha text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Digunakan</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($pesanan_expired as $key => $value) {
                                                $status = \Midtrans\Transaction::status($value->order_id); ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $value->id_pemesanan; ?></td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                    <td><?php if (($status->transaction_status) == 'pending') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div>
                                                        <?php } else if (($status->transaction_status) == 'settlement') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div>
                                                        <?php } else if (($status->transaction_status) == 'cancel') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div>
                                                        <?php } else { ?>
                                                            <div class="font-size-lg"><span class="badge bg-danger text-whiter">Gagal</span></div>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                    <td><a href="<?= base_url('profil/order/' . $value->id_pemesanan . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary mr-0" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                            <?php if (count($pesanan_batal) < 1) { ?>
                                <h6>Pesanan Kosong</h6>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0 text-center">
                                        <thead class="thead bg-matcha text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Digunakan</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($pesanan_batal as $key => $value) {
                                                $status = \Midtrans\Transaction::status($value->order_id); ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $value->id_pemesanan; ?></td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                    <td><?php if (($status->transaction_status) == 'pending') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div>
                                                        <?php } else if (($status->transaction_status) == 'settlement') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div>
                                                        <?php } else if (($status->transaction_status) == 'cancel') { ?>
                                                            <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div>
                                                        <?php } else { ?>
                                                            <div class="font-size-lg"><span class="badge bg-danger text-whiter">Gagal</span></div>
                                                        <?php  } ?>
                                                    </td>
                                                    <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                    <td><a href="<?= base_url('profil/order/' . $value->id_pemesanan . '/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-sm btn-primary mr-0" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<style type="text/css">
    body {
        margin-top: 20px;
    }

    .cart-item-thumb {
        display: block;
        width: 14rem
    }

    .cart-item-thumb>img {
        display: block;
        width: 100%
    }

    .product-card-title>a {
        color: #222;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }

    .product-card-title {
        display: block;
        margin-bottom: .75rem;
        padding-bottom: .875rem;
        border-bottom: 1px dashed #e2e2e2;
        font-size: 1rem;
        font-weight: normal;
    }

    .text-muted {
        color: #888 !important;
    }

    .bg-secondary {
        background-color: #f7f7f7 !important;
    }

    .accordion .accordion-heading {
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: bold;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }

    .nav-pills .nav-link {
        padding: 0.75rem 1rem;
        color: #137C5D;
        font-weight: 500;
        font-size: .875rem;
        box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
        background-color: #fff;
        transition: all .15s ease;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #137C5D;
    }
</style>

<?= $this->endSection(); ?>