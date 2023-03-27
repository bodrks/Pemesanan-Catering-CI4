<?= $this->extend('layout/master_template'); ?>

<?= $this->Section('content'); ?>

<div class="section-header">
    <h4>Dashboard</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class='fas fa-user-cog'></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                        <?= $admin; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class='fas fa-users'></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Customer</h4>
                    </div>
                    <div class="card-body">
                        <?= $customer; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class='fas fa-pizza-slice'></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Menu</h4>
                    </div>
                    <div class="card-body">
                        <?= $menu; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class='fas fa-book-open'></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Paket</h4>
                    </div>
                    <div class="card-body">
                        <?= $paket; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class='fas fa-cart-arrow-down'></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <?= $order; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<?= $this->endSection(); ?>