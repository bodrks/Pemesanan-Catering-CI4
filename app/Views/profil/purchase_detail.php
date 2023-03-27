<?= $this->extend('layout/profil_template'); ?>

<?= $this->section('content'); ?>

<div class="col-lg-10 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h5 class="border-bottom pb-2"><strong>Detail Pemesanan</strong></h5>
                <?php if ($index->transaction_status == 'pending') { ?>
                    <span class="text-danger">Pembayaran kadaluarsa 3 hari setelah pemesanan. Silahkan lakukan pembayaran.</span>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="id_pemesanan">No</label><br>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0 mb-1" name="id_pemesanan" id="id_pemesanan" value="<?= $index->id_pemesanan; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0" name=" alamat" id="alamat" value="<?= $index->alamat; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="tgl_digunakan">Tanggal Digunakan</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0" name=" tgl_digunakan" id="tgl_digunanakn" value="<?= date('d F Y', strtotime($index->tgl_digunakan)); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="bank">Bank Payment</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0" name=" bank" id="bank" value="<?= $index->bank; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="va_number">VA Number</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0 mb-1" style=" width:53%" id="myInput" value="<?= $index->va_number; ?>" readonly>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="copy_text()" data-toggle="tooltip" title="Copy to Clipboard"><i class="fa fa-clone" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="status">Status Pembayaran</label>
                        </div>
                        <div class="col-sm-8">
                            <?php if (($index->transaction_status) == 'pending') { ?>
                                <div class="font-size-lg"><span class="badge bg-info text-white">Menunggu Pembayaran</span></div><br>
                            <?php } else if (($index->transaction_status) == 'settlement') { ?>
                                <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div><br>
                            <?php } else if (($index->transaction_status) == 'cancel') { ?>
                                <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div><br>
                            <?php } else { ?>
                                <div class="font-size-lg"><span class="badge bg-danger text-white">Gagal</span></div><br>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <div class="col text-right">
                    <label for="tgl_pemesanan">Tanggal Pemesanan : <?= date('d F Y', strtotime($index->tgl_pemesanan)); ?></label><br><br><br><br><br>
                    <?php if ($index->transaction_status == 'settlement') { ?>
                        <a href="<?= base_url('profil/' . $index->id_pemesanan . '/invoice'); ?>" class="btn btn-danger" role="button" data-toggle="tooltip" title="Faktur"><i class="fa fa-file-text-o" aria-hidden="true"></i> Faktur</a>
                    <?php } ?>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-sm text-center">
                    <thead class="thead bg-matcha text-white">
                        <tr>
                            <th>No</th>
                            <th>Qty</th>
                            <th>Nama Paket</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pesanan as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value->qty; ?></td>
                                <td><?= $value->nama_paket; ?></td>
                                <td><img src="<?= base_url('images/' . $value->gambar); ?>" alt="Product" width="100px"></td>
                                <td><?= number_to_currency($value->harga, 'IDR', 'id_IDN'); ?></td>
                                <td><?= number_to_currency($value->sub_total, 'IDR', 'id_IDN'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot class="tfoot bg-secondary">
                        <tr>
                            <td colspan="5" align="right"><strong>Total</strong></td>
                            <td><strong><?= number_to_currency($index->total, 'IDR', 'id_IDN'); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function copy_text() {
        $('[data_toggle="tooltip"]').tooltip();
        var copyText = document.getElementById("myInput");
        copyText.select();
        document.execCommand("Copy");
        alert("Text copied");
    }
</script>

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
</style>

<?= $this->endSection(); ?>