<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Asset Management | <?= lang('Auth.loginTitle') ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('/adminLTE/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/adminLTE/dist/css/adminlte.min.css'); ?>">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <?= view('Myth\Auth\Views\_message_block') ?>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Asset</b> Management</a>
            </div>
            <div class="card-body">

                <p class="login-box-msg">Masuk untuk mengelola aset</p>

                <form action="<?= route_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if ($config->validFields === ['email']) : ?>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="input-group mb-3">
                        <input type="text" class="form-control" name='user' placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div> -->


                    <div class="input-group mb-3">
                        <input type="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($config->allowRemembering) : ?>
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <label for="remember">
                                        <?= lang('Auth.rememberMe') ?>
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>

                <?php if ($config->allowRegistration) : ?>
                    <p class="mb-0">
                        <a href="<?= route_to('register') ?>" class="text-center"><?= lang('Auth.needAnAccount') ?></a>
                    </p>
                <?php endif; ?>
                <?php if ($config->activeResetter) : ?>

                    <p class="mb-1">
                        <a href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
                    </p>
                <?php endif; ?>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('/adminLTE/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('/adminLTE/dist/js/adminlte.min.js'); ?>"></script>
</body>

</html>