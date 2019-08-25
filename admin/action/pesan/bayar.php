<?php
include '../../../koneksi.php';
	$kode_pesan = mysqli_real_escape_string($conn,$_GET['kode_pesan']);
	$bayar = "UPDATE pesan SET status_pesan = 2 WHERE kode_pesan = '".$kode_pesan."'";
	mysqli_query($conn, $bayar);
	mysqli_close($conn);
	header('Location: ../../../email/mail-sudahbayar.php?kodepesan='.$kode_pesan.'');
?>