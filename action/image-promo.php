<?php
include '../koneksi.php';
$id = mysqli_real_escape_string($conn,$_GET['id']);
$query_ord = "SELECT photo_promo FROM promo where kode_promo = '".$id."'";

$result = $conn->query($query_ord);
$row = $result->fetch_assoc();
$image=$row['photo_promo'];

header("Content-type: image/*");

echo $image;

?>