<?php
include '../../../koneksi.php';
$id = $_POST['id'];
$nama_barang = $_POST['nama'];
$harga_barang = $_POST['harga'];
$keterangan_barang = $_POST['ket'];
$kategori_barang = $_POST['kategori'];

if(isset($_POST['submit']))
{
	$photo = $_POST['ubahphoto'];
	if($photo == true){
		$file = $_FILES['photo']['tmp_name'];
		$image = mysqli_real_escape_string($conn,file_get_contents($file));
		$image_size = getimagesize($file);

	    if($image_size==FALSE){
			echo "That is not an image";
	    }
	    else{
			$sql = "UPDATE barang SET
			nama_barang = '".$nama_barang."',
			harga_barang = '".$harga_barang."',
			keterangan_barang = '".$keterangan_barang."',
			kategori_barang = '".$kategori_barang."',
			photo_barang = '".$image."'
			WHERE kode_barang = '".$id."'";

			if ($conn->query($sql) === TRUE) {
			    header('Location: /pkl/admin/pages/barang.php');
			} else {
			    header('Location: /pkl/admin/pages/barang.php');
			}
	    }
	}
	else{
		$sql = "UPDATE barang SET
		nama_barang = '".$nama_barang."',
		harga_barang = '".$harga_barang."',
		keterangan_barang = '".$keterangan_barang."',
		kategori_barang = '".$kategori_barang."'
		WHERE kode_barang = '".$id."'";
		if ($conn->query($sql) === TRUE) {
		    header('Location: /pkl/admin/pages/barang.php');
		} else {
		    header('Location: /pkl/admin/pages/barang.php');
		}
	}
}
else
{
    echo "That is not an image!";
}

$conn->close();
?>