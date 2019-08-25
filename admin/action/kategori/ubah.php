<?php
include '../../../koneksi.php';
$id = $_POST['id'];
$nama_kategori = $_POST['nama'];

if(isset($_POST['submit']))
{
	$sql = "UPDATE kategori SET nama_kategori = '".$nama_kategori."'
	WHERE kode_kategori = '".$id."'";

	if ($conn->query($sql) === TRUE) {
	    header('Location: /pkl/admin/pages/kategori.php');
	} else {
	    header('Location: /pkl/admin/pages/kategori.php');
	}
}

$conn->close();
?>