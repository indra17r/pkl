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
				  <li class="active">Ubah Profil</li>
				</ol>
			</div>
			<div class="row">

				<?php include 'menu.php'; ?>
					
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<form action="action/profil-ubah.php" method="post">
							<div class="col-sm-6">
								<div class="user-detail"><!--sign up form-->
										<div class="form-group">
					                        <label for="username">Username</label>
											<input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username_konsumen; ?>" readonly>
										</div>
										<div class="form-group">
					                        <label for="nama">Nama Lengkap</label>
											<input type="text" name="nama" id="nama" placeholder="Nama Lengkap" value="<?php echo $nama_konsumen; ?>" autofocus>
										</div>
										 <div class="form-group">
					                        <label for="alamat">Alamat</label>
											<textarea rows="5" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat_konsumen; ?></textarea>
										</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="user-detail"><!--sign up form-->
										<div class="col-sm-4" style="padding-left:0px;padding-right:5px;">
											 <div class="form-group">
						                        <label for="podepos">Kode Pos</label>
												<input type="text" name="kodepos" id="kodepos" placeholder="Kode Pos" value="<?php echo $kodepos_konsumen; ?>">
											</div>
										</div>
										<div class="col-sm-8" style="padding-left:5px;padding-right:0px;">
											<div class="form-group">
						                        <label for="telp">No. Telpon</label>
												<input type="text" name="telp" id="telp" placeholder="No.Telpon" value="<?php echo $telp_konsumen; ?>">
											</div>
										</div>
										<div class="form-group">
					                        <label for="email">E-mail</label>
											<input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $email_konsumen; ?>">
										</div>
										<div>
						                    <label for="lahir">Tanggal Lahir</label>
					                    </div>
					                    <div>
											<div class="col-sm-4" style="padding-left:0px;padding-right:5px;padding-bottom:15px;">
												<select id="tanggal" name="tanggal" required>
													<?php
													for($i=1; $i<=31; $i++){
														if ($i == $tgl) {
													        echo "<option value = '".$i."' selected>".$i."</option>";
													      }
													      else {
													        echo "<option value = '".$i."'>".$i."</option>";
													      }
													}
													?>
												</select>
											</div>
											<div class="col-sm-4" style="padding-left:5px;padding-right:5px;padding-bottom:15px;">
												<select name="bulan" required>
													<?php
													$blnn=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
													for($bulan=1; $bulan<=12; $bulan++){
													  if($bulan<=9) {
													      if ($bulan == $bln) {
													        echo "<option value = '0".$bulan."' selected>".$blnn[$bulan]."</option>";
													      }
													      else {
													        echo "<option value = '0".$bulan."'>".$blnn[$bulan]."</option>";
													      }

													  }
													  else {
													      if ($bulan == $bln) {
													        echo "<option value = '".$bulan."' selected>".$blnn[$bulan]."</option>";
													      }
													      else {
													        echo "<option value = '".$bulan."'>".$blnn[$bulan]."</option>";
													      }

													  }
													}
													?>
												</select>
											</div>
											<div class="col-sm-4" style="padding-left:5px;padding-right:0px;padding-bottom:15px;">
												<select name="tahun" required>
													<?php
													$now=date('Y');
													for($i=$now-14; $i>=$now-80; $i--){
													  if ($i == $thn) {
													    echo "<option value = '".$i."' selected>".$i."</option>";
													    }
													  else {
													    echo "<option value = '".$i."'>".$i."</option>";
													  }
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
					                        <label for="jenis">Jenis Kelamin</label>
												<select id="jenis" name="jenis" required>
												  <?php
												  if ($jeniskel_konsumen == 'Laki-Laki') {
												  echo "<option value='Laki-Laki' selected>Laki-Laki</option>";
												  echo "<option value='Perempuan'>Perempuan</option>";
												    }
												  else {
												   echo "<option value='Laki-Laki'>Laki-Laki</option>";
												  echo "<option value='Perempuan' selected>Perempuan</option>";
												  }
												  ?>
												</select>
										</div>
								</div>
							</div><!--/sign up form-->
							<div class="col-sm-12">
								<div class="user-detail">
									<button type="submit" class="btn btn-default">Simpan</button>
								</div>
							</div>
						</form>
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
	<script>
    <?php
    $gagal = 0;
    if(isset($_GET['gagal'])) {
      $gagal =1;
    }
    ?>
      if (<?php echo $gagal ?> == 1){
        alert("Terjadi kesalahan pada server. Mohon maaf atas ketidak nyamanan");
        window.open("<?php echo $situs; ?>pages/login.php","_self");
      }
    </script>
</body>
</html>