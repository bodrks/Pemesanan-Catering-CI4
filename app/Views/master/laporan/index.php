<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h5 class="card-title"><?= $semua; ?></h5>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('master/laporan/submit'); ?>" method="post">
                <?= csrf_field(); ?>
                <span class="pt-3 pb-2">Tampilkan Laporan</span>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row pt-2">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class='far fa-calendar-alt'></i></span>
                                    </div>
                                    <input class="flatpickr flatpickr-input form-control <?= $validation->hasError('tgl1') ?
                                                                                                'is-invalid' : ''; ?>" type="text" placeholder="Dari Tanggal" id="tgl1" name="tgl1" autofocus value="<?= old('tgl1'); ?>">
                                    <div class=" invalid-feedback">
                                        <?= $validation->getError('tgl1'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class='far fa-calendar-alt'></i></span>
                                    </div>
                                    <input class="flatpickr flatpickr-input form-control <?= $validation->hasError('tgl2') ?
                                                                                                'is-invalid' : ''; ?>" type="text" placeholder="Sampai Tanggal" id="tgl2" name="tgl2" autofocus value="<?= old('tgl2'); ?>">
                                    <div class=" invalid-feedback">
                                        <?= $validation->getError('tgl2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <button class="btn btn-warning form-control" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row pt-2">
                            <div class="col">
                                <button onclick="printDiv('print-area')" class="btn btn-danger form-control"><i class="fas fa-print"></i> Cetak</button> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="print-area">
                <div class="box-body">
                    <div id="wrapper">
                        <div id="receiptData" style="max-width: 2480px; min-width: 250px; margin: 0;">
                            <div id="receipt-data">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group" style="text-align: center; padding-left: 5rem;">
                                                <img src="<?php echo base_url(); ?>/images/yn.png" style="max-width:150px;" alt="YeyenCatering">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div style="text-align: center; padding-right: 15rem;">
                                                <p style="text-align:center;">
                                                <h3>YEYEN CATERING</h3><br>
                                                Jl. Darsono Barat no. 15 Kota Batu</p>
                                                <p style="text-align:center;">Telp 0341-5107999 <br><br>
                                                </p>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">No</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Tgl Pemesanan</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Id Pemesanan</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Customer</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Tgl Digunakan</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Metode Pembayaran</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Status Pembayaran</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Alamat</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Total</th>
                                                    <th class="text-center" style="width: auto; border-bottom: 2px solid #ddd;">Ket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($pesanan as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= date('d F Y', strtotime($value->tgl_pemesanan)); ?></td>
                                                        <td><?= $value->id_pemesanan; ?></td>
                                                        <td><?= $value->nama; ?></td>
                                                        <td><?= date('d F Y', strtotime($value->tgl_digunakan)); ?></td>
                                                        <td><?= $value->payment_method; ?></td>
                                                        <td><?= $value->transaction_status; ?></td>
                                                        <td><?= $value->alamat; ?></td>
                                                        <td><?= $value->total; ?></td>
                                                        <td><?= $value->keterangan; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<!-- Datepicker -->
<script>
    var tgl = new Date();
    flatpickr('.flatpickr', {
        // minDate: tgl.setDate(tgl.getDate() + 1)
    });
</script>

<style type="text/css" media="all">
    body {
        color: #000;
    }

    table,
    th,
    tr {
        text-align: center;
    }

    #wrapper {
        max-width: 2480px;
        margin: auto;
        padding-top: 20px;
    }

    .btn {
        margin-bottom: 5px;
    }

    .table {
        border-radius: 3px;
    }

    .table th {
        background: gray;
        color: white;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    h3 {
        margin: 5px 0;
    }

    @media print {
        .no-print {
            display: none;
        }

        #wrapper {
            max-width: 2480px;
            width: 100%;
            min-width: 250px;
            margin: 0;
        }
    }

    tfoot tr th:first-child {
        text-align: right;
    }
</style>
<script type="text/javascript">
    function printDiv(divName) {
        let printContents = document.getElementById(divName).innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(true);
        setTimeout(function() {}, 1000);
    }
</script>


<?= $this->endSection(); ?>