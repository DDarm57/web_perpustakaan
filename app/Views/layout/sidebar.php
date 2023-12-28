   <!-- Nav Item - Dashboard -->
   <li class="nav-item">
       <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>">
           <i class="fas fa-fw fa-tachometer-alt"></i>
           <span>Dashboard</span>
       </a>
   </li>

   <div class="nav-item">
       <a class="nav-link" href="<?= site_url('admin/transaksi'); ?>">
           <i class="fas fa-address-book"></i>
           <span>Transaksi</span>
       </a>
   </div>

   <div class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           <i class="fas fa-fw fa-cog"></i>
           <span>Data Buku</span>
       </a>
       <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">List:</h6>
               <a class="collapse-item" href="<?= site_url('admin/data_buku'); ?>">Buku</a>
               <a class="collapse-item" href="<?= site_url('admin/kategori_buku'); ?>">Kategori</a>
           </div>
       </div>
   </div>

   <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
           <i class="fas fa-address-card"></i>
           <span>Data Siswa</span>
       </a>
       <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">List:</h6>
               <a class="collapse-item" href="<?= site_url('admin/data_siswa'); ?>">Siswa</a>
               <a class="collapse-item" href="<?= site_url('admin/data_kelas'); ?>">Kelas</a>
           </div>
       </div>
   </li>

   <div class="nav-item">
       <a class="nav-link" href="<?= site_url('admin/riwayat_peminjaman'); ?>">
           <i class="fas fa-history"></i>
           <span>Riwayat Peminjaman</span>
       </a>
   </div>