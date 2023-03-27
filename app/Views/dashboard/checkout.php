<?= $this->extend('layout/cart_template'); ?>

<?= $this->section('content'); ?>

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?= $idpsn; ?>">
            <input type="hidden" name="tgl_pemesanan" id="tgl_pemesanan" value="<?= $tgl_pemesanan; ?>">
            <input type="hidden" name="id_customer" id="id_customer" value="<?= $id_customer; ?>">
            <input type="hidden" name="total" id="total" value="<?= $cart->total(); ?>">
            <h2>Konfirmasi Pembayaran</h2>
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-sm text-center">
                                <thead class="thead bg-matcha text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Qty</th>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($cart->contents() as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value['qty']; ?></td>
                                            <td>Paket <?= $value['name']; ?></td>
                                            <td><?= number_to_currency($value['price'], 'IDR', 'id_IDN'); ?></td>
                                            <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_IDN'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot class="tfoot bg-secondary">
                                    <tr>
                                        <td colspan="4" align="right"><strong>Total Bayar</strong></td>
                                        <td><strong><?= number_to_currency($cart->total(), 'IDR', 'id_IDN'); ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class=" form-group row">
                                        <label for="tgl_digunakan" class="col-form-label">Tanggal digunakan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="flatpickr flatpickr-input form-control" type="text" placeholder="Tanggal Digunakan" id="tgl_digunakan" name="tgl_digunakan">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 ml-5">
                                    <div class="form-group row">
                                        <label for="nuansa" class="col-form-label">Keterangan (nuansa acara)</label>
                                        <select class="js-example-placeholder-single js-states form-control" name="nuansa" id="nuansa">
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
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea class="form-control mb-3" id="alamat" name="alamat" rows="5" placeholder="Alamat"></textarea>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right pt-8">
                                        <button type="button" class="btn btn-warning mt-2" id="tombolBayar">Bayar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-yYUF8AnGSNaJpuO3"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Datepicker -->
<script>
    var tgl = new Date();
    flatpickr('.flatpickr', {
        minDate: tgl.setDate(tgl.getDate() + 1)
    });

    $(document).ready(function() {
        $(".js-example-placeholder-single").select2({
            placeholder: "Pilih warna dekorasi event anda",
            allowClear: true
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tombolBayar').click(function(e) {
            e.preventDefault();
            if ((($('#tgl_digunakan').val()) == '') || (($('#alamat').val()) == '')) {
                alert('Tanggal digunakan dan alamat harus diisi')
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= base_url(); ?>/payment/payMidtrans",
                    data: {
                        id_pemesanan: $('#id_pemesanan').val(),
                        tgl_pemesanan: $('#tgl_pemesanan').val(),
                        id_customer: $('#id_customer').val(),
                        total: $('#total').val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href="">Why do I have this issue?</a>'
                            })
                        } else {
                            snap.pay(response.snapToken, {
                                // Optional
                                onSuccess: function(result) {
                                    let dataResult = JSON.stringify(result, null, 2);
                                    let dataObj = JSON.parse(dataResult);

                                    $.ajax({
                                        type: "post",
                                        url: "<?= base_url() ?>/payment/finishMidtrans",
                                        data: {
                                            id_pemesanan: response.id_pemesanan,
                                            tgl_pemesanan: response.tgl_pemesanan,
                                            id_customer: response.id_customer,
                                            total: response.total,
                                            tgl_digunakan: $('#tgl_digunakan').val(),
                                            alamat: $('#alamat').val(),
                                            keterangan: $('#nuansa').val(),
                                            order_id: dataObj.order_id,
                                            payment_type: dataObj.payment_type,
                                            transaction_status: dataObj.transaction_status,
                                            transaction_time: dataObj.transaction_time,
                                            bank: dataObj.va_numbers[0]['bank'],
                                            va_number: dataObj.va_numbers[0]['va_number'],
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            if (response.sukses) {
                                                Swal.fire({
                                                    title: response.sukses,
                                                    text: "Silahkan lakukan pembayaran",
                                                    icon: "success"
                                                }).then(function() {
                                                    window.location.assign("<?= base_url() ?>");
                                                })
                                            }
                                        }
                                    });
                                },
                                // Optional
                                onPending: function(result) {
                                    let dataResult = JSON.stringify(result, null, 2);
                                    let dataObj = JSON.parse(dataResult);
                                    // console.log(dataObj.transaction_time);
                                    $.ajax({
                                        type: "post",
                                        url: "<?= base_url() ?>/payment/finishMidtrans",
                                        data: {
                                            id_pemesanan: response.id_pemesanan,
                                            tgl_pemesanan: response.tgl_pemesanan,
                                            id_customer: response.id_customer,
                                            total: response.total,
                                            tgl_digunakan: $('#tgl_digunakan').val(),
                                            alamat: $('#alamat').val(),
                                            keterangan: $('#nuansa').val(),
                                            order_id: dataObj.order_id,
                                            payment_type: dataObj.payment_type,
                                            transaction_status: dataObj.transaction_status,
                                            transaction_time: dataObj.transaction_time,
                                            bank: dataObj.va_numbers[0]['bank'],
                                            va_number: dataObj.va_numbers[0]['va_number'],
                                        },
                                        dataType: 'JSON',
                                        success: function(response) {
                                            if (response.sukses) {
                                                Swal.fire({
                                                    title: response.sukses,
                                                    text: "Silahkan lakukan pembayaran",
                                                    icon: "success"
                                                }).then(function() {
                                                    window.location.assign("<?= base_url() ?>");
                                                })
                                            }
                                        }
                                    });
                                    // console.log(JSON.stringify(result, null, 2));
                                },
                                // Optional
                                onError: function(result) {
                                    let dataResult = JSON.stringify(result, null, 2);
                                    let dataObj = JSON.parse(dataResult);

                                    $.ajax({
                                        type: "post",
                                        url: "<?= base_url() ?>/payment/finishMidtrans",
                                        data: {
                                            id_pemesanan: response.id_pemesanan,
                                            tgl_pemesanan: response.tgl_pemesanan,
                                            id_customer: response.id_customer,
                                            total: response.total,
                                            tgl_digunakan: $('#tgl_digunakan').val(),
                                            alamat: $('#alamat').val(),
                                            keterangan: $('#nuansa').val(),
                                            order_id: dataObj.order_id,
                                            payment_type: dataObj.payment_type,
                                            transaction_status: dataObj.transaction_status,
                                            transaction_time: dataObj.transaction_time,
                                            bank: dataObj.va_numbers[0]['bank'],
                                            va_number: dataObj.va_numbers[0]['va_number'],
                                        },
                                        dataType: "json",
                                        success: function(response) {
                                            if (response.sukses) {
                                                Swal.fire({
                                                    title: response.sukses,
                                                    text: "Silahkan lakukan pembayaran",
                                                    icon: "success"
                                                }).then(function() {
                                                    window.location.assign("<?= base_url() ?>");
                                                })
                                            }
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            }
        })
    });
</script>

<?= $this->endSection(); ?>