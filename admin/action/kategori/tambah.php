<?php
include '../../../koneksi.php';
$nama_kategori = $_POST['nama'];

if(isset($_POST['submit']))
{
	$sql = "INSERT INTO kategori VALUE('', '".$nama_kategori."')";
		if ($conn->query($sql) === TRUE) {
		    header('Location: /pkl/admin/pages/kategori.php');
		} else {
		    header('Location: /pkl/admin/pages/kategori.php');
		}
}

$conn->close();
?>