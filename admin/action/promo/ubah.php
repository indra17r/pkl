<?php
include '../../../koneksi.php';
$id = $_POST['id'];

if(isset($_POST['submit']))
{
	$file = $_FILES['photo']['tmp_name'];
	if(isset($file))
	{
		$image = mysqli_real_escape_string($conn,file_get_contents($file));
		$image_size = getimagesize($file);

	    if($image_size==FALSE)
	    {
			echo "That is not an image";
	    }
	    else
	    {
			$sql = "UPDATE promo SET photo_promo = '".$image."' WHERE kode_promo = '".$id."'";

			if ($conn->query($sql) === TRUE)
			{
			    header('Location: /pkl/admin/pages/promo.php');
			}
			else
			{
			    header('Location: /pkl/admin/pages/promo.php');
			}
	    }
	}
}
else
{
    echo "That is not an image!";
}

$conn->close();
?>