<?php
include '../../../koneksi.php';
$nama_barang = $_POST['nama'];
$harga_barang = $_POST['harga'];
$keterangan_barang = $_POST['ket'];
$kategori_barang = $_POST['kategori'];

if(isset($_POST['submit']))
{
	$file = $_FILES['photo']['tmp_name'];
	$image = mysqli_real_escape_string($conn,file_get_contents($file));
	$image_size = getimagesize($file);

    if($image_size==FALSE){
		echo "That is not an image";
    }
    else{
		$sql = "INSERT INTO barang VALUE('', '".$nama_barang."', '".$harga_barang."', '".$keterangan_barang."', '".$kategori_barang."', '".$image."', CURRENT_TIMESTAMP)";

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