<?php
session_start();
include '../koneksi.php';
$username = $_POST['inputusername'];
$md5_password=md5($_POST['inputpassword']);

$sql = "SELECT * FROM admin where username_admin = '".$username."' and password_admin = '".$md5_password."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $md5_password;
	$_SESSION["hakakses"] = 'admin';
	header('Location: ../admin/index.php');
} else {
	$sql = "SELECT * FROM konsumen where username_konsumen = '".$username."' and password_konsumen = '".$md5_password."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $md5_password;
		$_SESSION["hakakses"] = 'user';
		header('Location: ../index.php');
	} else {
		header('Location: ../login.php?gagal=1');
	}
}
$conn->close();
?>