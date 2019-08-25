<?php
include '../../koneksi.php';
$username_konsumen = $_POST['username'];
$nama_konsumen = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$jeniskel_konsumen = $_POST['jenis'];
$alamat_konsumen = $_POST['alamat'];
$kodepos_konsumen = $_POST['kodepos'];
$telp_konsumen = $_POST['telp'];
$email_konsumen = $_POST['email'];

	$sql = "UPDATE konsumen SET
	nama_konsumen = '".$nama_konsumen."',
	lahir_konsumen = '".$tahun."-".$bulan."-".$tanggal."',
	jeniskel_konsumen = '".$jeniskel_konsumen."',
	alamat_konsumen = '".$alamat_konsumen."',
	kodepos_konsumen = '".$kodepos_konsumen."',
	telp_konsumen = '".$telp_konsumen."',
	email_konsumen = '".$email_konsumen."'

	WHERE username_konsumen = '".$username_konsumen."'";

	if ($conn->query($sql) === TRUE) {
		header('Location: ../profil.php');
	} else {
		header('Location: ../profil.php?salah=1');
	}
$conn->close();
?>