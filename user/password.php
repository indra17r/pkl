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
    ?>

	<section><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Beranda</a></li>
				  <li class="active">Ubah Password</li>
				</ol>
			</div>
			<div class="row">

				<?php include 'menu.php'; ?>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-md-5 col-md-offset-3">
							<div class="signup-form"><!--sign up form-->
								<form action="action/password.php" method="post" onsubmit="return konfirmasi();">
									<input type="password" name="lama" id="lama" placeholder="Password Lama" required autofocus>
									<input type="password" name="baru" id="baru" placeholder="Password Baru" required>
									<input type="password" name="ulang" id="ulang" placeholder="Ulangi Password" required>
									
									<button type="submit" class="btn btn-default" name="submit" value="submit">Simpan Password</button>
								</form>
							</div><!--/sign up form-->
						</div>
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
    function konfirmasi() {
      var baru = document.getElementById('baru').value;
      var ulang = document.getElementById('ulang').value;
      if (baru != ulang){
        alert("Password konfirmasi tidak sama, silahkan cek kembali");
        document.getElementById('ulang').focus();
          return false;
      }
    }
    <?php
    $gagal = 0;
    if(isset($_GET['gagal'])) {
      $gagal = $_GET['gagal'];
    }
    ?>
      if (<?php echo $gagal ?> == 1){
        alert("Terjadi kesalahan pada server");
        window.open("<?php echo $situs; ?>user/password.php","_self");
      }
      else if (<?php echo $gagal ?> == 2){
        alert("Password salah");
        window.open("<?php echo $situs; ?>user/password.php","_self");
      }
    </script>
</body>
</html>