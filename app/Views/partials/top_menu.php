<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?= base_url(); ?>" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Panduan Pengguna</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->

    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline" action="#">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" id='general-search' type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="button">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->

    <!-- <li class="nav-item">
      <a class="nav-link" href="#" role="button" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
        <i class="fas fa-barcode"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>

    <?php if (isset($user->username)) : ?>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?= base_url('adminLTE/dist/img/user.png'); ?>" class="user-image img-circle elevation-2" alt="User Image">
          <!-- <i class="far fa-lg fa-user-circle"></i> -->
          <span class="d-none d-md-inline">
            <?= isset($user->username) ? $user->username : 'user'; ?></span>

        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="<?= base_url('adminLTE/dist/img/user.png'); ?>" class="img-circle elevation-2" alt="User Image">

            <p>

              <?= isset($user->username) ? $user->username : 'user'; ?>
              <small><?= isset($user->email) ? $user->email : 'email'; ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <!-- <li class="user-body">
          <div class="row">
            <div class="col-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-4 text-center">
              <a href="#">Friends</a>
            </div>
          </div>
        </li> -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat float-right">Logout</a>
          </li>
        </ul>
      </li>
    <?php else : ?>
      <li class="nav-item">
        <a href="/login" class="nav-link btn btn-primary text-white" role="button" type="button">Login</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>
<!-- /.navbar -->