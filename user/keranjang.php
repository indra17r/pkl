<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pesanan | musliModern.com</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <?php
    include '../part/header.php';
	$username = $_SESSION["username"];
    ?>
	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Beranda</a></li>
				  <li class="active">Keranjang</li>
				</ol>
			</div>
			<div class="row">
				<?php include 'menu.php'; ?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Barang</td>
							<td class="description"></td>
							<td class="price">Harga</td>
							<td class="price">Banyak</td>
							<td class="total">Jumlah</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
						$username = $_SESSION['username'];
						$query_kodepes = 'SELECT kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" AND status_pesan=6 LIMIT 1';
						$result_kodepes = $conn->query($query_kodepes);
						$kodepes = $result_kodepes->fetch_assoc();
						$query_ada = 'SELECT count(*) AS jumstok FROM stok WHERE kode_pesan="'.$kodepes['kode_pesan'].'"';
						$result_ada = $conn->query($query_ada);
						$ada = $result_ada->fetch_assoc();
						if ($ada['jumstok'] == 0) {
							echo'
							<tr>
								<td colspan="6">
									<h4 align="center">Tidak Ada Barang</h4>
								</td>
							</tr>
							';
						} else {	
							$query1 = 'SELECT kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" AND status_pesan=6';
							$result1 = $conn->query($query1);
							$hasil1 = $result1->fetch_assoc();
							$query2 = 'SELECT barang.kode_barang, nama_barang, harga_barang, keterangan_barang, banyak FROM barang
                            RIGHT JOIN (SELECT kode_barang, count(*) as banyak FROM stok WHERE kode_pesan='.$hasil1["kode_pesan"].' GROUP BY kode_barang) as stok 
                            ON stok.kode_barang=barang.kode_barang';
							if ($result2 = $conn->query($query2)) {
								while ($hasil2 = $result2->fetch_assoc()) {
									$jumlah = $hasil2["harga_barang"] * $hasil2["banyak"];
									echo'
									<tr>
										<td class="cart_product">
											<a href="../katalog-detail.php?kodebarang='.$hasil2["kode_barang"].'"><div class="square-100x100"><img src="../action/image-barang.php?id='.$hasil2["kode_barang"].'" alt=""></div></a>
										</td>
										<td class="cart_description">
											<h4><a href="../katalog-detail.php?kodebarang='.$hasil2["kode_barang"].'">'.$hasil2["nama_barang"].'</a></h4>
											<p>'.$hasil2["keterangan_barang"].'</p>
										</td>
										<td class="cart_price">
											<p>Rp. '.number_format($hasil2["harga_barang"], 0, "", ".").',-</p>
										</td>
										<td class="cart_quantity">
											<p>'.$hasil2["banyak"].' buah</p>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">Rp. '.number_format($jumlah, 0, "", ".").',-</p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" onclick="konfirmasidel()" href="action/keranjang-hapus.php?kodepesan='.$hasil1["kode_pesan"].'&kodebarang='.$hasil2["kode_barang"].'"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									';
								};
							};
							
						};
						
						?>
					</tbody>
				</table>
			</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-6">
				<div class="heading">
					<h3>Bagaimana Cara Membayar?</h3>
					<p align="justify">Setelah Checkout, Admin akan menyetujui Pemesanan maks 1x24 jam. Selanjutnya anda harus membayar sesuai jumlah di Menu 'Menunggu Pembayaran' dan pesanan diproses oleh admin.</p>
				</div>
				</div>
				<div class="col-sm-6">
					
					<div class="total_area">
						<?php
						if ($ada['jumstok'] == 0) {
							echo'
						<ul>
							<li>Jumlah Keranjang<span>Rp. 0,-</span></li>
						</ul>
						';
						} else {
						$query3 = 'SELECT sum(harga_barang) as total FROM barang
						RIGHT JOIN (SELECT kode_barang FROM stok WHERE kode_pesan='.$hasil1["kode_pesan"].') as stok ON stok.kode_barang=barang.kode_barang';
						$result3 = $conn->query($query3);
						$hasil3 = $result3->fetch_assoc();
						echo'
						<ul>
							<li>Jumlah Keranjang<span>Rp. '.number_format($hasil3["total"], 0, "", ".").',-</span></li>
							<a class="btn btn-default update" href="checkout.php">Lanjutkan Pesan</a>
						</ul>
							
						';
						};
						?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<?php
	    include '../part/footer.php';
	?>
  <script>
      function konfirmasidel() {
    if (confirm("Apakah Anda Ingin Menghapus Data ???") == false) {
        return event.preventDefault();
      }
    }
    </script>

    <script src="../js/jquery.js"></script>
	<script src="../js/price-range.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>