<?php
include '../koneksi.php';
	$kode_barang = mysqli_real_escape_string($conn,$_GET['kodebarang']);
	$kode_pesan = mysqli_real_escape_string($conn,$_GET['kodepesan']);
	$del = 'UPDATE stok SET status_stok=0, kode_pesan=NULL 
	WHERE kode_pesan='.$kode_pesan.' AND kode_barang='.$kode_barang.'';
	mysqli_query($conn, $del);
	mysqli_close($conn);
	header('Location: ../keranjang.php');
?>