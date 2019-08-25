<?php
include '../../../koneksi.php';
	$id = mysqli_real_escape_string($conn,$_GET['id']);
	$del = 'delete from kategori where kode_kategori = '.$id;
	mysqli_query($conn, $del);
	mysqli_close($conn);
	header('Location: /pkl/admin/pages/kategori.php');
?>