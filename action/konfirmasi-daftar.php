<?php
session_start();
include '../koneksi.php';
$username_konsumen = $_POST['username'];
$md5_password=md5($_POST['sandi']);
$nama_konsumen = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$jeniskel_konsumen = $_POST['jenis'];
$alamat_konsumen = $_POST['alamat'];
$kodepos_konsumen = $_POST['kodepos'];
$telp_konsumen = $_POST['telp'];
$email_konsumen = $_POST['email'];

$sql_kosumen = "SELECT * FROM konsumen where username_konsumen = '".$username_konsumen."'";
$result_konsumen = $conn->query($sql_kosumen);

$sql_admin = "SELECT * FROM admin where username_admin = '".$username_konsumen."'";
$result_admin = $conn->query($sql_admin);

if ($result_konsumen->num_rows > 0 or $result_admin->num_rows > 0) {
   	header('Location: ../login.php?gagal=2');
}
else {
	$sql = "INSERT INTO konsumen VALUE('".$username_konsumen."', '".$md5_password."','".$nama_konsumen."', '".$tahun."-".$bulan."-".$tanggal."', '".$jeniskel_konsumen."','".$alamat_konsumen."', '".$kodepos_konsumen."', '".$telp_konsumen."', '".$email_konsumen."')";
	if ($conn->query($sql) === TRUE) {
		$_SESSION["username"] = $username_konsumen;
		$_SESSION["password"] = $md5_password;
		$_SESSION["hakakses"] = 'user';

		header('Location: ../index.php?sukses=1');
	} else {
		header('Location: ../login.php?gagal=3');
	}
}
$conn->close();
?>