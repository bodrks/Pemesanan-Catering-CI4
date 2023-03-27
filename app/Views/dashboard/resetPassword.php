<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Reset Password</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Reset Password</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?= base_url('/forgotPassword/resetpassword/' . $customer->token . '/ubah'); ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id_customer" value="<?= $customer->id_customer; ?>">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="text" class="form-control" name="email" tabindex="1" disabled value="<?= $customer->email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input id="new_password" type="password" class="form-control <?= ($validation->hasError('new_password')) ?
                                                                                                            'is-invalid' : ''; ?>" name="new_password" tabindex="1">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('new_password'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="conf_password">Confirmation Password</label>
                                        <input id="conf_password" type="password" class="form-control <?= ($validation->hasError('conf_password')) ?
                                                                                                            'is-invalid' : ''; ?>" name="conf_password" tabindex="1">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('conf_password'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                                            Ubah Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Mohammad Fajar Mahendra 2022
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/template/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/template/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>