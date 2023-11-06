<?= $this->extend('default') ?>
<?= $this->section('page_title'); ?>
Tambah User
<?= $this->endSection(); ?>

<?= $this->section('context'); ?>
Tambah User
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <?= view('\Myth\Auth\Views\_message_block') ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <!-- <div class="form-group">
                        <label for="inputName">Project Name</label>
                        <input type="text" id="inputName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Project Description</label>
                        <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Status</label>
                        <select id="inputStatus" class="form-control custom-select">
                            <option selected disabled>Select one</option>
                            <option>On Hold</option>
                            <option>Canceled</option>
                            <option>Success</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Client Company</label>
                        <input type="text" id="inputClientCompany" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">Project Leader</label>
                        <input type="text" id="inputProjectLeader" class="form-control">
                    </div> -->

                    <!-- <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>

                        <div class="col-sm-6">
                            <input type="password" name="pass_confirm" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection(); ?>