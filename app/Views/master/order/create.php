<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="section-header">
    <h4>Tambah Pesanan</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Data Paket</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Paket</th>
                                <th>Nama Paket</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            use phpDocumentor\Reflection\Types\Null_;

                            $no = 1;
                            foreach ($paket as $key => $value) { ?>
                                <?php echo form_open('master/order/tambahCart');
                                echo form_hidden('id', $value['id_paket']);
                                echo form_hidden('name', $value['nama_paket']);
                                echo form_hidden('gambar', $value['gambar']);
                                echo form_hidden('price', $value['harga']);
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $value['id_paket']; ?></td>
                                    <td>Paket <?= $value['nama_paket']; ?></td>
                                    <td><img src="/images/<?= $value['gambar']; ?>" alt="" width="80px"></td>
                                    <td><?= number_to_currency($value['harga'], 'IDR', 'id_IDN'); ?></td>
                                    <td>
                                        <button type="submit" class="btn-success btn-sm-1"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                                <?php echo form_close(); ?>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Keranjang</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
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
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th><i class="fas fa-ban"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart->contents() as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['name']; ?></td>
                                    <td><?= $value['price']; ?></td>
                                    <td>
                                        <form action="<?= base_url('master/order/updateCart'); ?>" method="post">
                                            <input type="hidden" name="id_paket" id="id_paket" value="<?= $value['id']; ?>">
                                            <input type="hidden" name="rowid" id="rowid" value="<?= $value['rowid']; ?>">
                                            <input type="number" name="qty" max="500" min="50" id="qty" value="<?= $value['qty']; ?>" data-toggle="tootltp" title="tekan enter untuk update keranjang">
                                            <button class="btn btn-primary btn-sm fa fa-check" style="display:none;" title="Simpan">
                                        </form>
                                    </td>
                                    <td><?= number_to_currency($value['subtotal'], 'IDR', 'id_IDN'); ?></td>
                                    <td><a href="<?= base_url('master/order/' . $value['rowid'] . '/deleteCart'); ?>" class="btn btn-outline-danger btn-sm btn-block mb-2" role="button"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                        <tfoot>
                            <td>
                                <h6>Total : <?= number_to_currency($cart->total(), 'IDR', 'id_IDN'); ?></h6>
                                <?php if ($cart->totalItems() != NULL) { ?>
                                    <a href="<?= base_url('/master/order/checkout'); ?>" class="btn btn-success" role="button">Checkout</a>
                                <?php } ?>
                            </td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>