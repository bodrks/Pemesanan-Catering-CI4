<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Checkout</h4>
</div>
<div class="container container-sm d-flex justify-content-center">
    <div class="card" style="width: 80rem;">
        <form action="<?= base_url('/master/order/save'); ?>" method="post">
            <div class="card-body">
                <div class="form-group row pb-3">
                    <div class="col-6">
                        <label for="tgl_pemesanan" class="col-form-label">Tanggal Pemesanan</label>
                        <input type="text" class="form-control" id="tgl_pemesanan" name="tgl_pemesanan" value="<?= $tgl; ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="nama_pelanggan" class="col-form-label">Nama Customer</label>
                        <select name="id_customer" id="id_customer" class="form-control">
                            <?php foreach ($customer as $key => $value) { ?>
                                <option value="<?= $value['id_customer']; ?>"><?= $value['nama']; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-sm table-striped table-bordered bg-light text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($cart->contents() as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>Paket <?= $value['name']; ?></td>
                                    <td><?= number_to_currency($value['price'], 'IDR', 'id_IDN'); ?></td>
                                    <td><?= $value['qty']; ?></td>
                                    <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_IDN'); ?></td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group row pt-5">
                    <div class="col">
                        <label for="tgl_digunakan" class="col-form-label">Tanggal digunakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='far fa-calendar-alt'></i></span>
                            </div>
                            <input class="flatpickr flatpickr-input form-control <?= $validation->hasError('tgl_digunakan') ?
                                                                                        'is-invalid' : ''; ?>" type="text" placeholder="Tanggal Digunakan" id="tgl_digunakan" name="tgl_digunakan" autofocus value="<?= old('tgl_digunakan'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_digunakan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="nuansa" class="col-form-label">Keterangan (nuansa acara)</label>
                        <select class="form-control" name="nuansa" id="nuansa" required>
                            <option></option>
                            <option value="Merah">Merah</option>
                            <option value="Putih">Putih</option>
                            <option value="Hijau">Hijau</option>
                            <option value="Hijau muda">Hijau muda</option>
                            <option value="Kuning">Kuning</option>
                            <option value="Biru">Biru</option>
                            <option value="Biru muda">Biru muda</option>
                            <option value="Pink">Pink</option>
                            <option value="Emas">Emas</option>
                            <option value="Blewah">Blewah</option>
                            <option value="Ungu">Ungu</option>
                            <option value="Abu-abu">Abu-abu</option>
                            <option value="Orange">Orange</option>
                            <option value="Maroon">Maroon</option>
                        </select>
                        <label class="feedback text-sm-2 text-muted"><span><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> anda hanya dapat memilih warna yg terdapat pada pilihan diatas.</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea class="form-control mb-3" id="alamat" name="alamat" rows="5" style="height: 160px;max-height: 250px;" required></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col">
                        <label for="total" class="col-form-label"><strong>Total</strong></label>
                        <input type="text" class="form-control" id="total" name="total" value="<?= number_to_currency($cart->total(), 'IDR', 'id_IDN'); ?>" readonly>
                        <input type="hidden" name="totalcart" id="totalcart" value="<?= $cart->total(); ?>">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-end">
                    <button type="submit" class="btn btn-success form-control">Checkout</button>
                </div>
            </div>
        </form>
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