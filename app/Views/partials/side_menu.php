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
     <!-- Sidebar user (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="<?= base_url('adminLTE/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Alexander Pierce</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
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
           <a href="/" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="/aset-tetap" class="nav-link">
             <i class="nav-icon fas fa-money-bill"></i>
             <p>
               Aset Tetap
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="/aset-bergerak" class="nav-link">
             <i class="nav-icon fas fa-money-bill-wave"></i>
             <p>
               Aset Bergerak
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="/aset-b angunan" class="nav-link">
             <i class="nav-icon fas fa-building"></i>
             <p>
               Aset Bangunan
             </p>
           </a>
         </li>
         <li class="nav-header">FUNGSI UTILITAS</li>
         <li class="nav-item">
           <a href="/master-aset" class="nav-link">
             <i class="nav-icon fas fa-shopping-basket"></i>
             <p>
               Master Aset

             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-print"></i>
             <p>
               Pelaporan

             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-search"></i>
             <p>
               Pencarian

             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-map-marked-alt"></i>
             <p>
               Peta Bangunan

             </p>
           </a>
         </li>

       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>