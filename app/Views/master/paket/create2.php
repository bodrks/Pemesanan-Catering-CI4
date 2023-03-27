<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>

<div class="container p-5">
    <a href="<?= base_url('/master/paket'); ?>" class="btn btn-outline-secondary mb-2"><i class="fa fa-home" aria-hidden="true"></i></a>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4 class="card-title">Tambah Data Paket</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('/master/paket/save'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="id_paket" class="col-sm-2 col-form-label">ID Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_paket" name="id_paket" value="<?= $ambil; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_paket')) ?
                                                                    'is-invalid' : ''; ?>" id="nama_paket" name="nama_paket" autofocus value="<?= old('nama_paket'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_paket'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ?
                                                                    'is-invalid' : ''; ?>" id="harga" name="harga" autofocus value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-2">
                        <img src="/images/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="custom-file-input <?= ($validation->hasError('gambar')) ?
                                                                'is=invalid' : ''; ?>" type="file" id="gambar" name="gambar" autofocus value="<?= old('gambar'); ?>" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label class="custom-file-label" for="Gambar">Pilih gambar...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kategori" name="kategoriname">
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value->id_kategori; ?>"><?= $value->nama_kategori; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sel1" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="selectMenu" name="selectMenu[]">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="jmlitem" id="jmlitem">0 items</label>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning" onclick="bukaModalSelectedMenu()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Paket</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= ($validation->hasError('deskripsi')) ?
                                                            'is-invalid' : ''; ?>" name="deskripsi" id="deskripsi" cols="30" rows="10" autofocus value="<?= old('deskripsi'); ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-outline-primary mt-2" onclick="prosesMenu()" id="simpanPaket">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal menu yang dipilih -->
<div class="modal fade" id="modalSelectedMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table text-center bg-white" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody id="tabelMenu">
                        <td colspan="5">Data Kosong</td>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="prosesMenu()" id="simpanMenu">Simpan Menu</button>
            </div>
        </div>
    </div>
</div>

<script src=<?= base_url("assets/js/jquery-3.3.1.min.js"); ?>></script>
<script src=<?= base_url('vendors/select2/dist/js/select2.min.js'); ?>></script>
<script src=<?= base_url("assets/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js"); ?>></script>

<script>
    var menu = [];
    var ditemukan = false;
    var jmlitem = 0;
    var namenu = [];
    var id_paket = $("#id_paket").val();

    function bukaModalSelectedMenu() {
        tampilkanMenu()
        $("#modalSelectedMenu").modal("show")
    }

    function tampilkanMenu() {
        var isiMenu = ""

        for (let i = 0; i < menu.length; i++) {
            isiMenu += "<tr><td>" + menu[i][1] + "</td><td><button type='button' href='#' class='btn btn-outline-danger' onClick='hapusMenu(" + i + ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>"
        }
        if (menu.length < 1) {
            $("#simpanMenu").prop("disabled", true)
            isiMenu += "<td colspan='5'>Menu masih kosong</td>"
        } else {
            $("#simpanMenu").prop("disabled", false)
        }
        $('#tabelMenu').html(isiMenu)
    }

    function tambahMenu(id, nama) {
        ditemukan = false
        jmlitem = 0
        for (let i = 0; i < menu.length; i++) {
            if (menu[i][0] == id) {
                menu[i][2] += 1
                ditemukan = true
            }
            jmlitem += menu[i][2]
        }
        if (ditemukan == false) {
            menu.push([id, nama, 1])
            jmlitem += 1
        }
        $('#jmlitem').html(jmlitem + " items")
        $('#modalMenu').modal('hide')
    }

    $(document).ready(function() {
        $('#selectMenu').change(function() {
            namenu = $('#selectMenu option:selected').text();
            tambahMenu($('#selectMenu').select(), namenu)
        })
    });

    function hapusMenu(id) {
        menu.splice(id, 1)
        jmlitem -= 1
        $('#jmlitem').html(jmlitem + " items")
        tampilkanMenu()
    }

    $(document).ready(function() {

        $('#kategori').change(function() {
            var id_kategori = $("#kategori").val();
            $.ajax({
                url: "<?php echo base_url(); ?>/paket/get_menu",
                method: "POST",
                data: {
                    id_kategori: id_kategori
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;

                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_menu + '><input type=checkbox>' + data[i].nama_menu + '</button>'
                    }
                    $('#selectMenu').html(html);
                }
            });
        })
    });

    function prosesMenu() {
        // console.log(jmlitem);
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>/paket/tambahDetail",
            data: {
                'id_paket': id_paket,
                'menu': menu,
                'jmlitem': jmlitem
            },
            async: false,
            dataType: "json",
            success: function(data) {
                menu = [];
                tampilkanMenu();
            }
        });
    }
</script>
<?= $this->endSection(); ?>