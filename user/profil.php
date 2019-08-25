<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profil | musliModern.com</title>
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

	$query_ord = "SELECT * FROM `konsumen` WHERE `username_konsumen` = '".$_SESSION['username']."'";
	$result = $conn->query($query_ord);
	$row = $result->fetch_assoc();
	$username_konsumen = $row['username_konsumen'];
	$nama_konsumen = $row['nama_konsumen'];
	$lahir_konsumen = $row['lahir_konsumen'];
	list($thn, $bln, $tgl) = explode('-', $lahir_konsumen);
	$jeniskel_konsumen = $row['jeniskel_konsumen'];
	$alamat_konsumen = $row['alamat_konsumen'];
	$kodepos_konsumen = $row['kodepos_konsumen'];
	$telp_konsumen = $row['telp_konsumen'];
	$email_konsumen = $row['email_konsumen'];
    ?>
	
	<section><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Beranda</a></li>
				  <li class="active">Profil</li>
				</ol>
			</div>
			<div class="row">

				<?php include 'menu.php'; ?>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-6">
							<div class="signup-form"><!--sign up form-->
								<form>
									<div class="form-group">
				                        <label for="nama">Username</label>
										<input type="text" value="<?php echo $username_konsumen; ?>" readonly>
									</div>
									<div class="form-group">
				                        <label for="nama">Nama Lengkap</label>
										<input type="text" value="<?php echo $nama_konsumen; ?>" readonly>
									</div>
									 <div class="form-group">
				                        <label for="nama">Alamat</label>
										<textarea rows="5" disabled><?php echo $alamat_konsumen; ?></textarea>
									</div>
								</form>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="signup-form"><!--sign up form-->
								<form>
									<div class="col-sm-4" style="padding-left:0px;padding-right:5px;">
										 <div class="form-group">
					                        <label for="nama">Kode Pos</label>
											<input type="text" value="<?php echo $kodepos_konsumen; ?>" readonly>
										</div>
									</div>
									<div class="col-sm-8" style="padding-left:5px;padding-right:0px;">
										<div class="form-group">
					                        <label for="nama">No. Telpon</label>
											<input type="text" value="<?php echo $telp_konsumen; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
				                        <label for="nama">E-mail</label>					
										<input type="text" name="email" value="<?php echo $email_konsumen; ?>" readonly>
									</div>
									<div class="form-group">
					                    <label for="nama">Tanggal Lahir</label>				
										<input type="text" name="lahir" value="<?php echo $tgl."/".$bln."/".$thn; ?>" readonly>
									</div>
									<div class="form-group">
				                        <label for="nama">Jenis Kelamin</label>
										<input type="text" name="jenis" value="<?php echo $jeniskel_konsumen; ?>" readonly>
									</div>
								</form>
							</div>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php
		include '../part/footer.php';
	?>
    <script src="../js/jquery.js"></script>
	<script src="../js/price-range.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>