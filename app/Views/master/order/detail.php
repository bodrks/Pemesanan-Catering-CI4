<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h2 class="mt-2">Detail Pemesanan</h2>
</div>
<a href="<?= base_url('/master/order'); ?>" class="btn btn-secondary mb-2"><i class="fa fa-home" aria-hidden="true"></i></a>
<div class="section-body">
    <!-- <div class="container"> -->
    <div class="card mb-3">
        <div class="container">
            <div class="row pt-4">
                <div class="col">
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="id_pemesanan">No</label><br>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0 mb-1" name="id_pemesanan" id="id_pemesanan" value="<?= $pesanan->id_pemesanan; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0" name=" alamat" id="alamat" value="<?= $pesanan->alamat; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-4">
                            <label for="tgl_digunakan">Tanggal Digunakan</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="border-0" name=" tgl_digunakan" id="tgl_digunanakn" value="<?= date('d F Y', strtotime($pesanan->tgl_digunakan)); ?>" disabled>
                        </div>
                    </div>
                    <?php if ($pesanan->payment_method == 'Midtrans') { ?>
                        <div class="form-group row mb-0">
                            <div class="col-sm-4">
                                <label for="bank">Bank Payment</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="border-0" name=" bank" id="bank" value="<?= $pesanan->bank; ?>" disabled>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="status">Status Pembayaran</label>
                        </div>
                        <div class="col-sm-8">
                            <?php if (($pesanan->transaction_status) == 'pending') { ?>
                                <div class="font-size-lg"><span class="badge bg-warning text-white">Menunggu Pembayaran</span></div><br>
                            <?php } else if (($pesanan->transaction_status) == 'settlement') { ?>
                                <div class="font-size-lg"><span class="badge bg-success text-white">Sukses</span></div><br>
                            <?php } else if (($pesanan->transaction_status) == 'cancel') { ?>
                                <div class="font-size-lg"><span class="badge bg-warning text-white">Dibatalkan</span></div><br>
                            <?php } else { ?>
                                <div class="font-size-lg"><span class="badge bg-danger text-white">Gagal</span></div><br>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <div class="col text-right">
                    <label for="tgl_pemesanan">Tanggal Pemesanan : <?= date('d F Y', strtotime($pesanan->tgl_pemesanan)); ?></label><br><br><br><br><br>
                    <?php if ($pesanan->transaction_status != 'expired') { ?>
                        <a href="<?= base_url('master/order/struk/' . $pesanan->id_pemesanan); ?>" class="btn btn-danger" role="button" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                    <?php } ?>
                </div>
            </div>
            <div class="row pb-4 pl-3 pr-3 ">
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
                            foreach ($detail as $key => $value) { ?>
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
                        <tfoot class="tfoot bg-light">
                            <tr>
                                <td colspan="5" align="right"><strong>Total</strong></td>
                                <td><strong><?= number_to_currency($pesanan->total, 'IDR', 'id_IDN'); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>