<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="<?= base_url(); ?>template/node_modules/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?= base_url(); ?>/images/yn.png" alt="logo" width="100">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="<?= base_url('/daftar'); ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id_customer" value="<?= $ambil; ?>">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control <?= ($validation->hasError('username')) ?
                                                                                                        'is-invalid' : ''; ?>" name="username" autofocus value="<?= old('username'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('username'); ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="nama">Full Name</label>
                                            <input id="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ?
                                                                                                    'is-invalid' : ''; ?>" name="nama" autofocus value=" <?= old('nama'); ?>"">
                                        <div class=" invalid-feedback">
                                            <?= $validation->getError('nama'); ?>
                                        </div>
                                    </div>
                            </div>

                            <div class=" form-group row">
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control <?= ($validation->hasError('email')) ?
                                                                                            'is-invalid' : ''; ?>" name="email" autofocus value="<?= old('email'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="password" class="d-block">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control pwstrength <?= ($validation->hasError('password')) ?
                                                                                                                'is-invalid' : ''; ?>" name="password">
                                        <div class="input-group-prepend">
                                            <button class="btn rounded-end" type="button">
                                                <h7 toggle="#password" class="fa fa-eye fa-lg show-hide"></h7>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
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
    <script>
        $(".show-hide").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>