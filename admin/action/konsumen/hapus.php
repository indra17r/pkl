<?php
include '../../../koneksi.php';
	$id = mysqli_real_escape_string($conn,$_GET['id']);
	$del = 'delete from konsumen where username_konsumen = "'.$id.'"';
	mysqli_query($conn, $del);
	mysqli_close($conn);
	header('Location: /pkl/admin/pages/konsumen.php');
?>