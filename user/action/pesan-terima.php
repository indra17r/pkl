<?php
include '../koneksi.php';
	$kode_pesan = $_GET['kodepesan'];
	$query1 = 'UPDATE pesan SET status_pesan=4 WHERE kode_pesan='.$kode_pesan.'';
	mysqli_query($conn, $query1);
	$query2 = 'UPDATE stok SET status_stok=2, tanggal_keluar=CURRENT_TIMESTAMP WHERE kode_pesan='.$kode_pesan.'';
	mysqli_query($conn, $query2);
	mysqli_close($conn);
	header('Location: ../../email/mail-sukses.php?kodepesan='.$kode_pesan.'');
?>