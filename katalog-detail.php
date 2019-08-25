<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details |musliModern.com</title>
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
			<div class="row">

				<?php
					include 'part/menu.php';
					$kode_barang = $_GET["kodebarang"];
					$query_barang = 'SELECT nama_barang,harga_barang,keterangan_barang FROM barang WHERE kode_barang='.$kode_barang.'';
					$result_barang = $conn->query($query_barang);
					$barang = $result_barang->fetch_assoc();
				?>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="action/image-barang.php?id=<?php echo $kode_barang; ?>" alt="" />
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
								<h2><?php echo $barang["nama_barang"]; ?></h2>
								<p>Kode: <?php echo $kode_barang; ?></p>
								<?php
									$query_sedia = 'SELECT count(*) as ada FROM stok WHERE status_stok=0 AND kode_barang='.$kode_barang.'';
									$result_sedia = $conn->query($query_sedia);
									$sedia = $result_sedia->fetch_assoc();
									$hakakses = '';
									if(isset($_SESSION["hakakses"]))
										$hakakses = $_SESSION["hakakses"];
									if($hakakses == 'user') {
										if ($sedia["ada"]==0) {
								?>
											<span>
												<span>Rp. <?php echo number_format($barang["harga_barang"], 0, "", "."); ?>,-</span><br>
												<form name="addcart" id="addcart" method="post">
													<label>Banyak:</label>
													<input type="hidden" name="kodebarang" value="<?php echo $kode_barang; ?>" />
													<input type="number" value="0" disabled />
													<button type="submit" class="btn btn-fefault cart" disabled>
														<i class="fa fa-shopping-cart"></i>
														 Keranjang
													</button>
												</form>
											</span>
											<p><b>Tersedia:</b> Tidak Ada</p>
									<?php
										}
										else {
									?>
											<span>
												<span>Rp. <?php echo number_format($barang["harga_barang"], 0, "", "."); ?>,-</span><br>
												<form name="addcart" id="addcart" method="post" action="user/action/keranjang-masuk.php">
													<label>Banyak:</label>
													<input type="hidden" name="kodebarang" value="<?php echo $kode_barang; ?>" />
													<input type="number" name="jumlah" value="1" min="1" max="<?php echo $sedia["ada"]; ?>" />
													<button type="submit" name="submit" class="btn btn-fefault cart">
														<i class="fa fa-shopping-cart"></i>
														 Keranjang
													</button>
												</form>
											</span>
											<p><b>Tersedia:</b> Ada (<?php echo $sedia["ada"]; ?> buah)</p>
								<?php
										}
									}
									else {
										if ($sedia["ada"]==0) {
								?>
											<span>
												<span>Rp. <?php echo number_format($barang["harga_barang"], 0, "", "."); ?>,-</span><br>
											</span>
											<p><b>Tersedia:</b> Tidak Ada</p>
											<p><b>Silahkan:</b></p>
											<p>Login terlebih dahulu sebelum melakukan pembelian.</p>
								<?php
										}
										else {
								?>
											<span>
												<span>Rp. <?php echo number_format($barang["harga_barang"], 0, "", "."); ?>,-</span><br>
											</span>
											<p><b>Tersedia:</b> Ada (<?php echo $sedia["ada"]; ?> buah)</p>
											<p><b>Silahkan:</b></p>
											<p>Login terlebih dahulu sebelum melakukan pembelian.</p>
								<?php
										}
									}
								?>
								<p><b>Keterangan:</b></p>
								<p style="text-align: justify;"><?php echo nl2br($barang["keterangan_barang"]); ?></p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
				</div>
			</div>
		</div>
	</section>

	<?php include 'part/footer.php'; ?>
  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>