<?php
include '../../../koneksi.php';

if(isset($_POST['submit']))
{
	$file = $_FILES['photo']['tmp_name'];
	$image = mysqli_real_escape_string($conn,file_get_contents($file));
	$image_size = getimagesize($file);

    if($image_size==FALSE){
		echo "That is not an image";
    }
    else{
		$sql = "INSERT INTO promo VALUE('', '".$image."')";

		if ($conn->query($sql) === TRUE) {
		    header('Location: /pkl/admin/pages/promo.php');
		} else {
		    header('Location: /pkl/admin/pages/promo.php');
		}
    }
}
else
{
    echo "That is not an image!";
}

$conn->close();
?>