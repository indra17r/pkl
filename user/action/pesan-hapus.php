<?php
include '../koneksi.php';
	$kode_pesan = mysqli_real_escape_string($conn,$_GET['kodepesan']);
	$del = 'UPDATE stok SET status_stok=0, kode_pesan=NULL WHERE kode_pesan='.$kode_pesan.'';
	mysqli_query($conn, $del);
	$del2 = 'UPDATE pesan SET status_pesan=5 WHERE kode_pesan='.$kode_pesan.'';
	mysqli_query($conn, $del2);
	mysqli_close($conn);
	header('Location: ../../email/mail-batal.php?kodepesan='.$kode_pesan.'');
?>