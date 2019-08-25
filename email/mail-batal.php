<?php
include('mail.php');
include ('../koneksi.php');
$kode_pesan = $_GET['kodepesan'];
$query1 = "SELECT * FROM pesan LEFT JOIN konsumen ON konsumen.username_konsumen=pesan.username_konsumen where kode_pesan = ".$kode_pesan."";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$query2 = "SELECT count(*) as jumlah FROM stok WHERE kode_pesan = ".$kode_pesan."";
$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$query3 = "SELECT sum(harga_barang) as harga FROM barang LEFT JOIN stok ON stok.kode_barang=barang.kode_barang WHERE kode_pesan = ".$kode_pesan."";
$result3 = $conn->query($query3);
$row3 = $result3->fetch_assoc();


$email =  $row1['email_konsumen']; // Recipients email ID
$name = $row1['nama_konsumen']; // Recipient's name
$mail->AddAddress($email,$name);
$mail->Subject = "Pesanan anda dengan kode pesan ".$kode_pesan." telah dibatalkan";
$mail->Body = "<body style='margin: 10px;'>
 <div style='width: 670px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
 <br>
 <h2>Pesanan dengan kode pesan ".$kode_pesan." telah anda dibatalkan</h2><br>
 <p>Kami sedih anda telah membatalkan pesanan anda. Namun anda dapat melakukan pesanan lagi dengan pilihan produk terbaik kami</p>
 <p align='center'><a href='http://localhost/pkl/index.php'>musliModern.com</a></p>
 </div>
 <div style='width: 670px; font-family: Helvetica, sans-serif; font-size: 10px; padding:10px; line-height:150%; border:#eaeaea solid 10px;>
 <table>
 <tbody>
 <tr>
 <td>
 <a href='http://localhost/pkl/index.php'><img src='https://goo.gl/V2STFN' alt='' height='39px'/></a>
</td>
<td>
	<p>Jika butuh bantuan, hubungi muslimodernshop@gmail.com atau callcenter 087855231988<br>
	Copyright &copy; musliModern.com</p>
 </td>
 </tr>
 </tbody>
 <table>
 </div>
 </body>"; //HTML Body
//$altBody = "This is the body when user views in plain text format"; //Text Body 
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
header('Location: ../user/pesan.php');
};
?>