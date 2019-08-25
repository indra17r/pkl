<?php
include '../../../koneksi.php';
$kode_barang = $_GET['kodebarang'];
$jumlahstok = $_POST['jumlah'];

if(isset($_POST['submit']))
{
	$i = 0;
	while ($i < $jumlahstok) {
		$sql = "INSERT INTO stok VALUE('', '".$kode_barang."', NULL, CURRENT_TIMESTAMP, NULL , 0)";
		if ($conn->query($sql) === TRUE) {
		    header('Location: /pkl/admin/pages/stok.php');
		} else {
		    header('Location: /pkl/admin/pages/stok.php');
		}
		$i+=1;
	}
}

$conn->close();
?>