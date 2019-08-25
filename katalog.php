<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | musliModern.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

	<?php include 'part/header.php'; ?>
	
	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Beranda</a></li>
				  <li class="active">Katalog</li>
				</ol>
			</div>
			<div class="row">

				<?php include 'part/menu.php'; ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<?php

							$per_hal=9;

							$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

							if (isset($_GET['cari'])){
								$get = 'cari='.$_GET['cari'];
								$cari = $_GET['cari'];
								echo '
								<h2 class="title text-center">Pencarian "'.$cari.'"</h2>';

								$jumlah_record = 'SELECT COUNT(*) AS jum FROM barang LEFT JOIN kategori ON kategori.kode_kategori=barang.kategori_barang
								WHERE nama_kategori LIKE "%'.$cari.'%" OR nama_barang LIKE "%'.$cari.'%" OR keterangan_barang LIKE "%'.$cari.'%"';
								$result_jum = $conn->query($jumlah_record);
								$jum_rec = $result_jum->fetch_assoc();

								$halaman=ceil($jum_rec['jum'] / $per_hal);
								$start = ($page - 1) * $per_hal;

								$query_hasil = 'SELECT kode_barang,nama_barang,harga_barang, nama_kategori, keterangan_barang
								FROM barang LEFT JOIN kategori ON kategori.kode_kategori=barang.kategori_barang
								WHERE nama_kategori LIKE "%'.$cari.'%" OR nama_barang LIKE "%'.$cari.'%" OR keterangan_barang LIKE "%'.$cari.'%" limit '.$start.', '.$per_hal;
							}
							elseif(isset($_GET['kodekategori'])) {
								$get = 'kodekategori='.$_GET['kodekategori'];
								$kode_kategori = $_GET["kodekategori"];
								$query_nama = 'SELECT nama_kategori FROM kategori WHERE kode_kategori='.$kode_kategori.'';
								$nama = $conn->query($query_nama);
								$namakategori = $nama->fetch_assoc();
								echo '
								<h2 class="title text-center">'.$namakategori["nama_kategori"].'</h2>';

								$jumlah_record = "SELECT COUNT(*) AS jum FROM barang WHERE kategori_barang=".$kode_kategori;
								$result_jum = $conn->query($jumlah_record);
								$jum_rec = $result_jum->fetch_assoc();

								$halaman=ceil($jum_rec['jum'] / $per_hal);
								$start = ($page - 1) * $per_hal;

								$query_hasil = 'SELECT kode_barang,nama_barang,harga_barang FROM barang WHERE kategori_barang='.$kode_kategori.' limit '.$start.', '.$per_hal;
							}
							else {
								echo '
								<h2 class="title text-center">6 Terbaru</h2>';
								$query_hasil = 'SELECT kode_barang,nama_barang,harga_barang FROM barang ORDER BY tanggal_masuk DESC LIMIT 6';
							}

							if ($result_hasil = $conn->query($query_hasil)) {
								while ($hasil = $result_hasil->fetch_assoc()) {
									$query_sedia = 'SELECT count(*) as ada FROM stok WHERE status_stok=0 AND kode_barang='.$hasil['kode_barang'].'';
									$result_sedia = $conn->query($query_sedia);
									$sedia = $result_sedia->fetch_assoc();
									echo'
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<div class="square-255x255">
														<img src="action/image-barang.php?id='.$hasil["kode_barang"].'" alt="" />
													</div>
													<h2>Rp. '.number_format($hasil["harga_barang"], 0, "", ".").',-</h2>
													<p><b>'.$hasil["nama_barang"].'</b></p>';
													if ($sedia["ada"]==0) {
													?>
																<p><b>Tersedia:</b> Tidak Ada</p>
																
													<?php
															}
															else {
													?>
																
																<p><b>Tersedia:</b> <?php echo $sedia["ada"]; ?> buah</p>
																
													<?php
															}
													echo '<a href="katalog-detail.php?kodebarang='.$hasil["kode_barang"].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail</a>
												</div>
											</div>
										</div>
									</div>';
								}
							}

							if(isset($_GET['cari']) or isset($_GET['kodekategori'])) {
						?>
								<div class="pagination-area">
									<ul class="pagination">
										<?php
											if($page == 1) {
												echo '<li><a href="#" class="disabled"><i class="fa fa-angle-double-left"></i></a></li>';
											}
											else {
												echo '<li><a href="?'.$get.'&page='.($page-1).'"><i class="fa fa-angle-double-left"></i></a></li>';
											}
											for($x=1;$x<=$halaman;$x++){
												if($page == $x) {
													echo'<li><a href="?'.$get.'&page='.$x.'" class="active">'.$x.'</a></li>';
												}
												else {
													echo'<li><a href="?'.$get.'&page='.$x.'">'.$x.'</a></li>';
												}
											}
											if($page == $halaman) {
												echo '<li><a href="#" class="disabled"><i class="fa fa-angle-double-right"></i></a></li>';
											}
											else {
												echo '<li><a href="?'.$get.'&page='.($page+1).'"><i class="fa fa-angle-double-right"></i></a></li>';
											}
										?>
									</ul>
								</div>
							<?php
								}
							?>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	<?php include 'part/footer.php'; ?>
  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>