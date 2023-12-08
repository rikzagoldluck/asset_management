 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link align-middle">
     <i class="fas fa-warehouse fa-lg mx-2"></i>
     <!-- <img src="<?= base_url('adminLTE/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
     <span class="brand-text font-weight-light ">Asset Management</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">


     <!-- SidebarSearch Form -->
     <div class="form-inline  mt-3">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="<?= base_url('/'); ?>" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         <li class="nav-header">MENU U/ INPUT</li>
         <li class="nav-item">
           <a href="<?= base_url('/aset-tetap/dashboard'); ?>" class="nav-link">
             <i class="nav-icon fas fa-money-bill"></i>
             <p>
               Aset Tetap
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('/aset-bergerak/dashboard'); ?>" class="nav-link">
             <i class="nav-icon fas fa-money-bill-wave"></i>
             <p>
               Aset Bergerak
             </p>
           </a>
         </li>
         <!-- <li class="nav-item">
           <a href="<?= base_url('/aset-bangunan'); ?>" class="nav-link">
             <i class="nav-icon fas fa-building"></i>
             <p>
               Aset Bangunan
             </p>
           </a>
         </li>-->
         <li class="nav-header">MENU U/ LAPORAN</li>
         <li class="nav-item">
           <a href="<?= base_url('/pelaporan'); ?>" class="nav-link">
             <i class="nav-icon fab fa-searchengin fa-lg"></i>
             <p>
               Pelaporan
             </p>
           </a>
         </li>
         <!-- 
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fab fa-searchengin fa-lg"></i>
             <p>
               Pencarian & Pelaporan
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="<?= base_url('/pelaporan/MasterAsetModel'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Master Aset</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('/pelaporan/AsetTetapModel'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Aset Tetap</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('/pelaporan/AsetBergerakModel'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Aset Bergerak</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('/pelaporan/transaksi'); ?>-aset" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Transaksi Aset</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-map-marked-alt"></i>
             <p>
               Peta Bangunan

             </p>
           </a>
         </li>
         <li class="nav-header">ADMINISTRATOR</li>
         <li class="nav-item">
           <a href="<?= base_url('register') ?>" class="nav-link">
             <i class="nav-icon fas fa-plus"></i>
             <p>
               Tambah

             </p>
           </a>
         </li> -->

       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>