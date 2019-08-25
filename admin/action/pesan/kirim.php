<?php
include '../../../koneksi.php';
$kode_pesan = $_GET['kodepesan'];
$resi_pesan = $_POST['resi'];

if(isset($_POST['submit']))
{
	$sql = "UPDATE pesan SET status_pesan = 3 , resi_pesan = '".$resi_pesan."'
	WHERE kode_pesan = '".$kode_pesan."'";
	
		if ($conn->query($sql) === TRUE) {
		    header('Location: ../../../email/mail-terkirim.php?kodepesan='.$kode_pesan.'');
		} else {
		    header('Location: ../pages/pesan.php');
		}
}
$conn->close();

?>