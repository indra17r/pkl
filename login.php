<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | musliModern.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<?php

	include 'part/header.php';
	$hakakses = '';
	if(isset($_SESSION["hakakses"]))
		$hakakses = $_SESSION["hakakses"];
	if($hakakses == 'user')
		echo '<script>window.open("'.$situs.'index.php","_self")</script>';
	if($hakakses == 'admin')
		echo '<script>window.open("'.$situs.'admin/index.php","_self")</script>';
	?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Masuk</h2>
						<form action="action/konfirmasi-login.php" method="post">
							<input required name="inputusername" type="text" placeholder="Username" autofocus />
							<input required name="inputpassword" type="password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Masuk</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">ATAU</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Daftar Sekarang!</h2>
						<form action="action/konfirmasi-daftar.php" method="post" onsubmit="return konfirmasi();">
							<input type="text" required name="username" placeholder="Username" />
							<input type="text" required name="nama" placeholder="Nama Lengkap" />
							<input type="text" required name="alamat" placeholder="Alamat Lengkap" />
							<input type="text" required name="kodepos" placeholder="Kode Pos" />
							<input type="text" required name="telp" placeholder="No.Telpon" />
							<input type="email" required name="email" placeholder="E-mail" />
							<input type="password" name="sandi" id="sandi" placeholder="Kata Sandi" />
							<input type="password" name="ulang" id="ulang" placeholder="Ulangi Kata Sandi" />
							<div class="col-sm-3" style="padding-left:0px;padding-right:5px;margin-bottom:10px;">
							  <select name="tanggal" required>
								<option value="">Tanggal</option>
								<?php
								for($i=1; $i<=31; $i++){
									echo "<option value = '".$i."'>".$i."</option>";
								}
								?>
							  </select>
							</div>
							<div class="col-sm-5" style="padding-left:5px;padding-right:5px;margin-bottom:10px;">
							  <select name="bulan" required>
								<option value="">Bulan</option>
								<?php
								$blnn=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
								for($bulan=1; $bulan<=12; $bulan++){
									if($bulan<=9) {
										echo "<option value = '0".$bulan."'>".$blnn[$bulan]."</option>";
									}
									else {
										echo "<option value = '".$bulan."'>".$blnn[$bulan]."</option>";
									}
								}
								?>  
							  </select>
							</div>
							<div class="col-sm-4" style="padding-left:5px;padding-right:0px;margin-bottom:10px;">
							  <select name="tahun" required>
								<option value="">Tahun</option>
								<?php
								$now=date('Y');
								for($i=$now-14; $i>=$now-80; $i--){
									echo "<option value = '".$i."'>".$i."</option>";
								}
								?>
							  </select>
							</div>
							<label><input type="radio" name="jenis" value="Laki-Laki" required>Laki-Laki</label>&nbsp;&nbsp;
							<label><input type="radio" name="jenis" value="Perempuan" required>Perempuan</label>
							<button type="submit" class="btn btn-default">Daftar Baru</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php include 'part/footer.php'; ?>

	<script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
	<script>
		function konfirmasi() {
			var sandi = document.getElementById('sandi').value;
			var ulang = document.getElementById('ulang').value;
			if (sandi != ulang){
				alert("Password konfirmasi tidak sama, silahkan cek kembali");
				document.getElementById('sandi').focus();
				return false;
			}
		}

		<?php
			$gagal = 0;
			if(isset($_GET['gagal'])) {
				$gagal=$_GET['gagal'];
			}
		?>
		if (<?php echo $gagal; ?> == 1){
			alert("Username atau Password Salah.");
			window.open("<?php echo $situs.'login.php'; ?>","_self");
		}
		else if (<?php echo $gagal; ?> == 2){
			alert("Username Telah digunakan, Silahkan Memasukkan Username Lain.");
			window.open("<?php echo $situs.'login.php'; ?>","_self");
		}
		else if (<?php echo $gagal; ?> == 3){
			alert("Terjadi kesalahan pada server. Mohon maaf atas ketidak nyamanan");
			window.open("<?php echo $situs.'login.php'; ?>","_self");
		}
	</script>
</body>
</html>