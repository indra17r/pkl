<?php include 'koneksi.php';

if(strpos($_SERVER['REQUEST_URI'], 'user') !== false) {
	if($_SESSION['hakakses'] != 'user')
		echo '<script>window.open("javascript:history.back()","_self")</script>';
}

?>
<header id="header"><!--header-->
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="<?php echo $situs.'index.php' ?>"><img src="<?php echo $situs.'/images/logo.png' ?>"alt="" height="39px"/></a>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<?php
								$hakakses = '';
								if(isset($_SESSION["hakakses"]))
									$hakakses = $_SESSION["hakakses"];
								if($hakakses == 'user') {
						            if(strpos($_SERVER['REQUEST_URI'], 'profil.php') !== false) {
										echo '
										<li><a href="'.$situs.'user/profil.php" class="active"><i class="fa fa-user"></i> Profil</a></li>';
									}
									else {
										echo '
										<li><a href="'.$situs.'user/profil.php"><i class="fa fa-user"></i> Profil</a></li>';
									}
						            if(strpos($_SERVER['REQUEST_URI'], 'pesan') !== false) {
										echo '
										<li><a href="'.$situs.'user/pesan.php" class="active"><i class="fa fa-crosshairs"></i> Pemesanan</a></li>';
									}
									else {
										echo '
										<li><a href="'.$situs.'user/pesan.php"><i class="fa fa-crosshairs"></i> Pemesanan</a></li>';
									}
						            if(strpos($_SERVER['REQUEST_URI'], 'keranjang') !== false) {
										echo '<li><a href="'.$situs.'user/keranjang.php" class="active"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
										<li><a href="'.$situs.'user/action/logout.php"><i class="fa fa-lock"></i> Keluar</a></li>';
									}
									else {
										echo '<li><a href="'.$situs.'user/keranjang.php"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
										<li><a href="'.$situs.'user/action/logout.php"><i class="fa fa-lock"></i> Keluar</a></li>';
									}
								}
								elseif($hakakses == 'admin') {
									echo '
									<li><a href="'.$situs.'admin/index.php"><i class="fa fa-user"></i> Masuk ke Admin</a></li>';
								}
								else {
						            if(strpos($_SERVER['REQUEST_URI'], 'login') !== false) {
										echo'
										<li><a href="'.$situs.'login.php" class="active"><i class="fa fa-lock"></i> Masuk</a></li>';
									}
									else {
										echo'
										<li><a href="'.$situs.'login.php"><i class="fa fa-lock"></i> Masuk</a></li>';
									}
								}
							?>
							<li>
								<div class="search_box">
									<form id="search" method="get" action="<?php echo $situs; ?>katalog.php">
										<input name="cari" type="text" placeholder="Search" onkeyup="if(event.keyCode == 13){document.getElementById('search').submit();}" />
									</form>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->
</header><!--/header-->