<?php
include '../koneksi.php';
	$username = $_SESSION['username'];

	$query_ada = 'SELECT kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" AND status_pesan = 6';
	$result_ada = $conn->query($query_ada);
	$ada = $result_ada->fetch_assoc();
	$pesan = 'UPDATE pesan SET status_pesan=0 WHERE kode_pesan='.$ada["kode_pesan"].'';
	mysqli_query($conn, $pesan);
	$ket = $_POST['message'];
	if(isset($_POST['submit'])){
		$pesan = 'UPDATE pesan SET keterangan_pesan="'.$ket.'" WHERE kode_pesan='.$ada["kode_pesan"].'';
		mysqli_query($conn, $pesan);
	};
	mysqli_close($conn);
	header('Location: ../../email/mail-pesanbaru.php?kodepesan='.$ada[kode_pesan].'');
?>