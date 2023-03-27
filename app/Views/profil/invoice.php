<?= $this->extend('layout/profil_template'); ?>

<?= $this->section('content'); ?>

<div class="col-lg-10 col-md-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="print-area">
                    <div class="box-body">
                        <div id="wrapper">
                            <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">
                                <div id="receipt-data">
                                    <div>
                                        <div style="text-align:center;">
                                            <img src="<?php echo base_url(); ?>/images/yn.png" style="max-width:150px;" alt="YeyenCatering">
                                            <p style="text-align:center;"><strong>Yeyen Catering</strong><br>Jl. Darsono Barat no. 15 Kota Batu</p>
                                            <p style="text-align:center;"> 0341-5107999 <br><br>
                                            </p>
                                            <p></p>
                                        </div>
                                        <p>
                                            Tanggal Pemesanan : <?= date('d F Y', strtotime($pesanan->tgl_pemesanan)); ?> <br>
                                            Nomor Transaksi : <?= $pesanan->id_pemesanan; ?> <br>
                                            Nama Customer : <?= $pesanan->nama; ?><br>
                                            <?php if (($pesanan->payment_method) == 'Midtrans') { ?>
                                                Bank Pembayaran : Bank <?= $pesanan->bank; ?>
                                            <?php  } ?>
                                        </p>
                                        <div style="clear:both;"></div>
                                        <table class="table table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Nama Paket</th>
                                                    <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">QTY</th>
                                                    <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Harga</th>
                                                    <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detail as $key => $value) { ?>
                                                    <tr>
                                                        <td>Paket <?= $value->nama_paket; ?></td>
                                                        <td><?= $value->qty; ?></td>
                                                        <td><?= number_to_currency($value->harga, 'IDR', 'id_IDN'); ?></td>
                                                        <td><?= number_to_currency($value->sub_total, 'IDR', 'id_IDN'); ?></td>
                                                    </tr>
                                                <?php  } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <th colspan="2" class="text-right"><?= number_to_currency($pesanan->total, 'IDR', 'id_IDN'); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="summary">
                                            <p>
                                                Tanggal Digunakan : <?= date('d F Y', strtotime($pesanan->tgl_digunakan)); ?><br>
                                                Keterangan (nuansa) : <?= $pesanan->keterangan; ?><br>
                                                <?php if ($pesanan->transaction_status == 'pending') { ?>
                                                    Status Pembayaran : Menunggu Pembayaran<br>
                                                <?php } else if ($pesanan->transaction_status == 'settlement') { ?>
                                                    Status Pembayaran : Sukses<br>
                                                <?php  } else if ($pesanan->transaction_status == 'expire') { ?>
                                                    Status Pembayaran : Gagal<br>
                                                <?php  } else { ?>
                                                    Status Pembayaran : Dibatalkan<br>
                                                <?php } ?>
                                                Alamat : <?= $pesanan->alamat; ?><br>
                                            </p>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                    <span class="pull-right col-xs-12">
                        <button onclick="printDiv('print-area')" class="btn btn-block btn-danger"><i class="fa fa-print" aria-hidden="true"></i> Print</button> </span>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        max-width: 650px;
        margin: 0 auto;
        padding-top: 20px;
    }

    .btn {
        margin-bottom: 5px;
    }

    .table {
        border-radius: 3px;
    }

    .table th {
        background: #f5f5f5;
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
            max-width: 480px;
            width: 100%;
            min-width: 250px;
            margin: 0 auto;
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