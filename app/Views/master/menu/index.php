<?= $this->extend('layout/master_template'); ?>

<?= $this->section('content'); ?>
<div class="section-header">
    <h4>Data Menu</h4>
    <div class="row">
        <div class="col">
            <form class="form-inline ml-4" method="post" action="">
                <ul class="navbar-nav">
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none bg-success"><i class="fas fa-search"></i></a></li>
                </ul>
                <div class="input-group-append">
                    <input class="form-control" name="keyword" type="search" placeholder="Search" aria-label="Search" data-width="400">
                    <button class="btn btn-outline-success" type="submit" name="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="text-right">
        <a class="btn btn-warning mb-3" href="<?= base_url('/master/menu/add'); ?>" role="button">Tambah Data</a>
    </div>

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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Menu</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (5 * ($currentPage - 1)); ?>
                        <?php foreach ($getMenu as $menu) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $menu['id_menu']; ?></td>
                                <td><?= $menu['nama_menu']; ?></td>
                                <td><img src="/images/<?= $menu['gambar']; ?>" class="img-tumbnail img-preview img-mw-100" width="150px"></td>
                                <td>
                                    <a href=" <?= base_url('master/menu/' . $menu['id_menu'] . '/detail'); ?>" class="btn btn-success" data-bs-target="#editModal">
                                        Detail</a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>

                </table>
                <?= $pager->links('menu', 'menu_pagination'); ?>
            </div>
        </div>
    </div>
</div>
</body>
<?= $this->endSection(); ?>