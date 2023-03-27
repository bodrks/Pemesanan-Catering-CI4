<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="container p-5">
    <a href="<?= base_url('master/order'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i></a>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ubah Rincian Pemesanan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-striped">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 12%;">Tanggal Pemesanan</th>
                            <th style="width: 12%;">Id Pemesanan</th>
                            <th style="width: 15%;">Customer</th>
                            <th style="width: 8%;">Metode Pembayaran</th>
                            <th style="width: 15%;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td><?= date('d F Y', strtotime($order->tgl_pemesanan)); ?></td>
                        <td><?= $order->id_pemesanan; ?></td>
                        <td><?= $customer->nama; ?></td>
                        <td><?= $order->payment_method; ?></td>
                        <td><?= number_to_currency($order->total, 'IDR', 'id_IDN'); ?></td>
                    </tbody>
                </table>
            </div>
            <form method="post" action="<?= base_url('master/order/update/' . $order->id_pemesanan); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="gambarLama" value="<?= $order->bukti_bayar_cash; ?>">
                <div class="form-group row pt-5">
                    <div class="col-md-6">
                        <label for="">Status</label>
                        <select name="transaction_status" id="transaction_status" class="form-control">
                            <option selected value="<?= $order->transaction_status; ?>"><?= $order->transaction_status; ?></option>
                            <?php if ($order->transaction_status == 'pending') { ?>
                                <option value="settlement">Settlement (Lunas)</option>
                            <?php  } else if ($order->transaction_status == 'settlement') { ?>
                                <option value="pending">Pending</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tgl_digunakan" class="col-form-label">Tanggal digunakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='far fa-calendar-alt'></i></span>
                            </div>
                            <input class="flatpickr flatpickr-input form-control <?= $validation->hasError('tgl_digunakan') ?
                                                                                        'is-invalid' : ''; ?>" type="text" placeholder="Tanggal Digunakan" id="tgl_digunakan" name="tgl_digunakan" value="<?= $order->tgl_digunakan; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_digunakan'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-form-label">Bukti Pembayaran</label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <img src="/images/<?= $order->bukti_bayar_cash; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="custom-file-input form-control" type="file" id="gambar" name="gambar" onchange="previewImg()">

                            <label class="custom-file-label" for="Gambar">Pilih gambar...</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $order->id_pemesanan; ?>" name="id_pemesanan">
                <div class="text-right ">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<!-- Datepicker -->
<script>
    var tgl = new Date();
    flatpickr('.flatpickr', {
        minDate: tgl.setDate(tgl.getDate() + 1)
    });
</script>
<?= $this->endSection(); ?>