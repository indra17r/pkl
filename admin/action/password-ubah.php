<?php
include '../../koneksi.php';
$password_lama=md5($_POST['lama']);
$password_baru=md5($_POST['baru']);

if(isset($_POST['submit']))
{
	if ($password_lama == $_SESSION["password"]) {
		$sql = "UPDATE admin SET password_admin = '".$password_baru."'
		WHERE username_admin = '".$_SESSION['username']."'";

		if ($conn->query($sql) === TRUE) {
		    header('Location: /pkl/admin');
		} else {
		    header('Location: /pkl/admin');
		}
	}
	else 
	{
		header('Location: /pkl/admin/pages/password.php?salah=1');
	}
}

$conn->close();
?>