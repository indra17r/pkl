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
	
	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Beranda</a></li>
				  <li class="active">Pemesanan</li>
				</ol>
			</div>
			<div class="row">
				<?php include 'menu.php'; ?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
				<div class="col-sm-12 padding-center">				
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#setuju" data-toggle="tab">Menunggu Persetujuan</a></li>
								<li><a href="#bayar" data-toggle="tab">Menunggu Pembayaran</a></li>
								<li><a href="#proses" data-toggle="tab">Diproses</a></li>
								<li><a href="#terima" data-toggle="tab">Konfirmasi Penerimaan</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="setuju" >
								<table class="table">
									<thead>
										<tr>
											<th>Kode Pesan</th>
											<th>Tanggal Pesan</th>
											<th>Total Barang</th>
											<th>Detail</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$query1 = "SELECT pesan.kode_pesan, pesan.ongkir_pesan, pesan.tanggal_pesan FROM pesan 
									LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 0 AND pesan.username_konsumen='".$username."'";  
									if ($result1 = $conn->query($query1)) {
									$i=1;
									while ($row1 = $result1->fetch_assoc()) {
									#<!-- ambil jumlah uang -->
									$query2 = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row1["kode_pesan"]."";
									$result2 = $conn->query($query2);
									$row2 = $result2->fetch_assoc();
									$date = strtotime($row1['tanggal_pesan']);
									echo "
									<tr>
									<td>".$row1['kode_pesan']."</td>
									<td>".date('d M Y - H:i',$date)."</td>
									<td>Rp. ".number_format($row2['jumlah_uang'], 0, '', '.').",-</td>
									<td><a href='pesan-detail.php?kode_pesan=".$row1['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
									<td><a href='action/pesan-hapus.php?kodepesan=".$row1['kode_pesan']."' onclick='konfirmasidel()' class='text-blue'><i class='fa fa-trash-o'><b>  HAPUS</b></a></td>
									</tr>
									";
									$i+=1;
									}
									}
									?>
									</tbody>
								</table>
								<br>
							</div>
							
							<div class="tab-pane fade" id="bayar" >
								<table class="table">
									<thead>
										<tr>
											<th>Kode Pesan</th>
											<th>Tanggal Pesan</th>
											<th>Harus Dibayar</th>
											<th>Detail</th>
											<th>Pembayaran</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$query1 = "SELECT pesan.kode_pesan, pesan.ongkir_pesan, pesan.tanggal_pesan, CONVERT(SUBSTRING(konsumen.telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan 
                                    LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 1 AND pesan.username_konsumen='".$username."'";  
									if ($result1 = $conn->query($query1)) {
									$i=1;
									while ($row1 = $result1->fetch_assoc()) {
									#<!-- ambil jumlah uang -->
									$query2 = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row1["kode_pesan"]."";
									$result2 = $conn->query($query2);
									$row2 = $result2->fetch_assoc();
									$total = $row1["ongkir_pesan"] + $row1["digit"] + $row2["jumlah_uang"];
									$date = strtotime($row1['tanggal_pesan']);
									echo "
									<tr>
									<td>".$row1['kode_pesan']."</td>
									<td>".date('d M Y - H:i',$date)."</td>
									<td>Rp. ".number_format($total, 0, '', '.').",-</td>
									<td><a href='pesan-detail.php?kode_pesan=".$row1['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
									<td align='center' width='200px'> Rekening<br><b>BNI Cab. Tanjung Perak 0987654321</b><br>
									Whatsapps Kode Pesan <b>'".$row1['kode_pesan']."'</b> & Foto Resi Ke<br><b>087855231988<b></b></td>
									</tr>
									";
									$i+=1;
									}
									}
									?>
									</tbody>
								</table>
								<br>
							</div>
							
							<div class="tab-pane fade" id="proses" >
								<table class="table">
									<thead>
										<tr>
											<th>Kode Pesan</th>
											<th>Tanggal Pesan</th>
											<th>Total Terbayar</th>
											<th>Detail</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$query1 = "SELECT pesan.kode_pesan, pesan.ongkir_pesan, pesan.tanggal_pesan, CONVERT(SUBSTRING(konsumen.telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan 
                                    LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 2 AND pesan.username_konsumen='".$username."'";  
									if ($result1 = $conn->query($query1)) {
									$i=1;
									while ($row1 = $result1->fetch_assoc()) {
									#<!-- ambil jumlah uang -->
									$query2 = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row1["kode_pesan"]."";
									$result2 = $conn->query($query2);
									$row2 = $result2->fetch_assoc();
									$total = $row1["ongkir_pesan"] + $row1["digit"] + $row2["jumlah_uang"];
									$date = strtotime($row1['tanggal_pesan']);
									echo "
									<tr>
									<td>".$row1['kode_pesan']."</td>
									<td>".date('d M Y - H:i',$date)."</td>
									<td>Rp. ".number_format($total, 0, '', '.').",-</td>
									<td><a href='pesan-detail.php?kode_pesan=".$row1['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
									</tr>
									";
									$i+=1;
									}
									}
									?>
									</tbody>
								</table>
								<br>
							</div>
							
							<div class="tab-pane fade" id="terima" >
								<table class="table">
									<thead>
										<tr>
											<th>Kode Pesan</th>
											<th>Tanggal Pesan</th>
											<th>Total Terbayar</th>
											<th>Detail</th>
											<th width="175px">Track Pesanan</th>
											<th width="150px">Konfirmasi</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$query1 = "SELECT pesan.kode_pesan, pesan.resi_pesan, pesan.ongkir_pesan, pesan.tanggal_pesan, CONVERT(SUBSTRING(konsumen.telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan 
                                    LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 3 AND pesan.username_konsumen='".$username."'";  
									if ($result1 = $conn->query($query1)) {
									$i=1;
									while ($row1 = $result1->fetch_assoc()) {
									#<!-- ambil jumlah uang -->
									$query2 = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row1["kode_pesan"]."";
									$result2 = $conn->query($query2);
									$row2 = $result2->fetch_assoc();
									$total = $row1["ongkir_pesan"] + $row1["digit"] + $row2["jumlah_uang"];
									$date = strtotime($row1['tanggal_pesan']);
									echo "
									<tr>
									<td>".$row1['kode_pesan']."</td>
									<td>".date('d M Y - H:i',$date)."</td>
									<td>Rp. ".number_format($total, 0, '', '.').",-</td>
									<td><a href='pesan-detail.php?kode_pesan=".$row1['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
									<td>".$row1['resi_pesan']."
									<form method='get' action='http://cekresi.com/' target='_BLANK'>
									<input type='hidden' name='noresi' value=".$row1['resi_pesan']." />
									<span>
									  <button class='btn btn-primary' type='submit' value='Track Resi' name='submit'>Track Resi</button>
									</span>
									</form>
									</td>
									<td><a class='btn btn-primary' href='action/pesan-terima.php?kodepesan=".$row1['kode_pesan']."'>Sudah Diterima</a></td>
									</tr>
									";
									$i+=1;
									}
									}
									?>
									</tbody>
								</table>
								<br>
							</div>
						</div>
					</div><!--/category-tab-->
				</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	
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