
<?php
 // Define relative path from this script to mPDF
if($_GET['status'] == 0) $nama_dokumen='Pesanan Baru';
elseif($_GET['status'] == 1) $nama_dokumen='Pesanan Diproses';
elseif($_GET['status'] == 2) $nama_dokumen='Pesanan Terbayar';
elseif($_GET['status'] == 3) $nama_dokumen='Pesanan Terkirim';
elseif($_GET['status'] == 4) $nama_dokumen='Pesanan Sukses';
elseif($_GET['status'] == 5) $nama_dokumen='Pesanan Batal';

include("../vendor/autoload.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document

//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 
?>
<style>
table {
  border-collapse: collapse;
  width:100%;
}
table, th, td {
  border:1px solid black;
}
td{
  text-align: center;
  border-top: 0px;
  border-bottom: 0px;
}
th{
  background-color: #f5f5f5;
}
.judul {
  border-color: white;
}
</style>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
<!--CONTOH Code START-->
<?php
 //KONEKSI
      include '../koneksi.php';
?>
<table>
<tr>
<td rowspan=2 class="judul">
<img src="../images/logo.png" height="25px">
</td>
<td style="font-size:20px" class="judul">
<b>Laporan <?php echo $nama_dokumen; ?></b>
</td>
<td rowspan=2 width="190px" class="judul" style="text-align: right;">
<?php echo date('d/M/Y'); ?>
</td>
</tr>
<tr>
<td class="judul">
  <b>Muslim Modern</b>
</td>
</tr>
</table><br>


<table>
  <thead>
    <tr>
      <th width="40px">No.</th>
      <th>Nama Konsumen</th>
      <th>Jumlah Barang</th>
      <th>Tanggal Pesan</th>
      <th>Terbilang</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_GET['status']))
      {
        $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = ".$_GET['status'];  
   if ($result = $conn->query($query_ord)) {
      $i=1;
        while ($row = $result->fetch_assoc()) {

  $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
  $result_stok = $conn->query($query_stok);
  $data = $result_stok->fetch_assoc();
  #<!-- ambil jumlah uang -->
  $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
  $result_uang = $conn->query($query_uang);
  $uang = $result_uang->fetch_assoc();
  #<!-- ambil jumlah ongkir -->
  #<!-- ambil jumlah total pembayaran -->

  $unik = 0;
  $ongkir = 0;
  if($_GET['status'] != '0') {
    $query_ongkir = "SELECT ongkir_pesan, CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE kode_pesan =".$row['kode_pesan']."";
    $result_ongkir = $conn->query($query_ongkir);
    $ongkir = $result_ongkir->fetch_assoc();
    $unik = $row['digit'];
    $ongkir = $ongkir['ongkir_pesan'];
  }
  $jumlah = $uang['jumlah_uang'] + $ongkir + $unik;
  $date = strtotime($row['tanggal_pesan']);
  if($i%2 == 0) {
      echo "<tr style='background-color: #f5f5f5;'>";
  }
  else {
                      echo'<tr>';
  }
        echo "<td>".$i."</td>
        <td style='text-align: left;'>".$row['nama_konsumen']."</td>
        <td>".$data['jumlah_barang']." Barang</td>
        <td>".date('d M Y - H:i',$date)."</td>
        <td style='text-align: right;'>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
        </tr>
        ";
        $i+=1;
        }
      }

     }
    ?>
  </tbody>
  
</table>
<!--CONTOH Code END-->
 
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();

//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
//echo $html;
exit;
?>
