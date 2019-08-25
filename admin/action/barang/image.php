<?php
include '../../../koneksi.php';
$id = mysqli_real_escape_string($conn,$_GET['id']);
$query_ord = "SELECT * FROM barang where kode_barang = '".$id."'";

$result = $conn->query($query_ord);
$row = $result->fetch_assoc();
$image=$row['photo_barang'];

header("Content-type: image/*");

echo $image;

?>