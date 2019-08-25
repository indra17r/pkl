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
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
								$query_ord = "SELECT * FROM promo";
								if ($result = $conn->query($query_ord)) {
									$i=0;
									while ($row = $result->fetch_assoc()) {
										if ($i == 0) {
											echo '<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>';
										}
										else {
											echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'"></li>';
										}
										$i+=1;
									}
								}
							?>
						</ol>
						<div class="carousel-inner">
							<?php
								$query_gambar = "SELECT * FROM promo";
								if ($result_gambar = $conn->query($query_gambar)) {
									$i=0;
									while ($gambar = $result_gambar->fetch_assoc()) {
										if ($i == 0) {
											echo "
											<div class='item active'>
												<img src='action/image-promo.php?id=".$gambar['kode_promo']."' alt='' style='height:441px; width:1140px'/>
											</div>
											";
										}
										else {
											echo "
											<div class='item'>
												<img src='action/image-promo.php?id=".$gambar['kode_promo']."' alt='' style='height:441px; width:1140px'/>
											</div>
											";
										}
										$i+=1;
									}
								}
							?>
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<?php include 'part/menu.php'; ?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">6 Terbaru</h2>
						<?php
							$query_terbaru = "SELECT kode_barang, nama_barang, harga_barang FROM barang ORDER BY tanggal_masuk DESC LIMIT 6";
							if ($result_terbaru = $conn->query($query_terbaru)) {
								while ($terbaru = $result_terbaru->fetch_assoc()) {
									$query_sedia = 'SELECT count(*) as ada FROM stok WHERE status_stok=0 AND kode_barang='.$terbaru['kode_barang'].'';
									$result_sedia = $conn->query($query_sedia);
									$sedia = $result_sedia->fetch_assoc();
									echo '
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<div class="square-255x255">
														<img src="action/image-barang.php?id='.$terbaru['kode_barang'].'" alt="" />
													</div>
													<h2>Rp. '.number_format($terbaru["harga_barang"], 0, "", ".").',-</h2>
													<p><b>'.$terbaru["nama_barang"].'</b></p>';
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
													echo '<a href="katalog-detail.php?kodebarang='.$terbaru["kode_barang"].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail</a>
												</div>
											</div>
										</div>
									</div>
									';
								}
							}
						?>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	<?php include 'part/footer.php'; ?>
		<?php
			$sukses = 0;
			if(isset($_GET['sukses'])) {
				$sukses=$_GET['sukses'];
			}
		?>
		<script>
		if (<?php echo $sukses; ?> == 1){
			alert("Anda Sudah Terdaftar !!!.");
			window.open("<?php echo $situs.'index.php'; ?>","_self");
		}
		</script>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>