<?php
include '../koneksi.php';
$password_lama=md5($_POST['lama']);
$password_baru=md5($_POST['baru']);

if(isset($_POST['submit']))
{
	if ($password_lama == $_SESSION["password"]) {
		$sql = "UPDATE konsumen SET password_konsumen = '".$password_baru."'
		WHERE username_konsumen = '".$_SESSION['username']."'";

		if ($conn->query($sql) === TRUE) {
		    header('Location: ../profil.php');
		} else {
		    header('Location: ../password.php?gagal=1');
		}
	}
	else 
	{
		header('Location: ../password.php?gagal=2');
	}
}

$conn->close();
?>