<?php
include '../koneksi.php';
if($_SESSION['hakakses'] != 'admin')
  echo '<script>window.open("'.$situs.'login.php","_self")</script>';

?>
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo $situs; ?>admin/index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?php echo $situs; ?>images/logo-kecil.png" height="35px"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo $situs; ?>images/logo.png" height="35px"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li>
                <a href="<?php echo $situs; ?>admin/action/logout.php">
                  <i class="fa fa-sign-out"></i>
                  <span>Logout</span>
                </a>
              </li>
             
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <br><br>
        <section class="sidebar">
          <ul class="sidebar-menu">
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'index') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/index.php">
                <i class="fa fa-home"></i> <span>Home</span>
              </a>
            </li>
			<?php
            if(strpos($_SERVER['REQUEST_URI'], 'kategori') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/kategori.php">
                <i class="fa fa-list"></i> <span>Kategori</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'barang') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/barang.php">
                <i class="fa fa-dropbox"></i> <span>Barang</span>
              </a>
            </li>
			<?php
            if(strpos($_SERVER['REQUEST_URI'], 'stok') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/stok.php">
                <i class="fa fa-database"></i> <span>Stok</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'konsumen') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/konsumen.php">
                <i class="fa fa-users"></i> <span>Konsumen</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'pesan') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/pesan.php">
                <i class="fa fa-envelope"></i> <span>Pesan</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'promo') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/promo.php">
                <i class="fa fa-newspaper-o"></i> <span>Promo</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'laporan') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/laporan.php">
                <i class="fa fa-print"></i> <span>Laporan</span>
              </a>
            </li>
            <?php
            if(strpos($_SERVER['REQUEST_URI'], 'password') !== false) {
              echo '<li class="active">';
            }
            else {
              echo '<li>';
            }
            ?>
              <a href="<?php echo $situs; ?>admin/pages/password.php">
                <i class="fa fa-key"></i> <span>Ubah Password</span>
              </a>
            </li>
      
            </ul>
        </section>
        <!-- /.sidebar -->
      </aside>