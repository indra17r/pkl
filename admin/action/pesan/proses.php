<?php
include '../../../koneksi.php';
$kode_pesan = $_GET['kodepesan'];
$ongkir_pesan = $_POST['ongkir'];

if(isset($_POST['submit']))
{
	$sql = "UPDATE pesan SET status_pesan = 1 , ongkir_pesan = '".$ongkir_pesan."'
	WHERE kode_pesan = '".$kode_pesan."'";
	
		if ($conn->query($sql) === TRUE) {
		    header('Location: ../../../email/mail-belumbayar.php?kodepesan='.$kode_pesan.'');
		} else {
		    header('Location: ../../pages/pesan.php');
		}
}
$conn->close();

?>