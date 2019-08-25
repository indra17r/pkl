<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profil | musliModern.com</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
	
</head><!--/head-->
<body>
    <?php
    include '../part/header.php';

    $username = $_SESSION['username'];
    $query6 = 'SELECT kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" AND status_pesan=6';
    $result6 = $conn->query($query6);
    $ada6 = $result6->fetch_assoc();
    $kode_pesan = $ada6['kode_pesan'];

    $query1 = 'SELECT DATE_FORMAT(tanggal_pesan, "%d %M %Y") AS tanggal_pesan, keterangan_pesan, resi_pesan, ongkir_pesan, status_pesan FROM pesan WHERE kode_pesan='.$kode_pesan.'';
    $result1 = $conn->query($query1);
    $ada1 = $result1->fetch_assoc();
    $query2 = 'SELECT nama_konsumen, alamat_konsumen, kodepos_konsumen, telp_konsumen, CONVERT(SUBSTRING(konsumen.telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM konsumen WHERE username_konsumen="'.$username.'"';
    $result2 = $conn->query($query2);
    $ada2 = $result2->fetch_assoc();
    $query5 = 'SELECT sum(harga_barang) as total FROM barang
    RIGHT JOIN (SELECT kode_barang FROM stok WHERE kode_pesan='.$kode_pesan.') as stok ON stok.kode_barang=barang.kode_barang';
    $result5 = $conn->query($query5);
    $ada5 = $result5->fetch_assoc();
    $grand = $ada5['total'] + $ada1['ongkir_pesan'] + $ada2['digit'];
    ?>

  <section id="cart_items">
    <div class="container">

      <div class="step-one">
        <h2 class="heading">Pesan</h2>
      </div>
      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-4">
            <div class="shopper-info">
              <?php
              echo'
              <p>Kode Pesan</p>
              <h4>'.$kode_pesan.'</h4>
              <br>
              <p>Tanggal Pemesanan</p>
              <h4>'.$ada1["tanggal_pesan"].'</h4>
              <br>
              <p>Total</p>
              <h4>Rp. '.number_format($ada5["total"], 0, "", ".").',-</h4>
              <h6>Belum Termasuk Ongkos Kirim & Kode Unik</h6>
              ';
              ?>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="bill-to">
            <?php
              echo'
              <p>Alamat Tujuan</p>
              <h4>'.$ada2["nama_konsumen"].'</h4>
              <h5>'.$ada2["alamat_konsumen"].'</h5>
              <h5>'.$ada2["kodepos_konsumen"].'</h5>
              <h5>Telp. '.$ada2["telp_konsumen"].'</h5>
              ';
              ?>
            </div>
          </div>
          <div class="col-sm-4">
              <div class="order-message">
              <p>Keterangan Pesanan</p>
              <form method="post" action="action/checkout-masuk.php" id="ket">
              <textarea name="message"  placeholder="Keterangan Pesanan" rows="8"></textarea>
              <button class="btn btn-primary" type="submit" value="Pesan" name="submit">Pesanan Dikirim</button>
              </form>
            </div>
          </div>          
        </div>
      </div>
      <div class="review-payment">
        <h2>Barang dan Pembayaran</h2>
      </div>

      <div class="table-responsive cart_info">
        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Barang</td>
              <td class="description"></td>
              <td class="price">Harga</td>
              <td class="price">Banyak</td>
              <td class="total">Jumlah</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $query3 = 'SELECT count(*) as ada FROM pesan WHERE username_konsumen="'.$username.'" AND status_pesan=6';
            $result3 = $conn->query($query3);
            $ada3 = $result3->fetch_assoc();
            $query4 = 'SELECT barang.kode_barang, nama_barang, harga_barang, keterangan_barang, banyak FROM barang
            RIGHT JOIN (SELECT kode_barang, count(*) as banyak FROM stok WHERE kode_pesan='.$kode_pesan.' GROUP BY kode_barang) as stok 
            ON stok.kode_barang=barang.kode_barang';
            if ($result4 = $conn->query($query4)) {
              while ($ada4 = $result4->fetch_assoc()) {
                $jumlah = $ada4["harga_barang"] * $ada4["banyak"];
                echo'
                <tr>
                  <td class="cart_product">
                    <a href="../katalog-detail.php?kodebarang='.$ada4["kode_barang"].'"><div class="square-100x100"><img src="../action/image-barang.php?id='.$ada4["kode_barang"].'" alt="" ></div></a>
                  </td>
                  <td class="cart_description">
                    <h4><a href="../katalog-detail.php?kodebarang='.$ada4["kode_barang"].'">'.$ada4["nama_barang"].'</a></h4>
                    <p>'.$ada4["keterangan_barang"].'</p>
                  </td>
                  <td class="cart_price">
                    <p>Rp. '.number_format($ada4["harga_barang"], 0, "", ".").',-</p>
                  </td>
                  <td class="cart_price">
                    <p>'.$ada4["banyak"].' buah</p>
                  </td>
                  <td class="cart_total">
                    <p class="cart_total_price">Rp. '.number_format($jumlah, 0, "", ".").',-</p>
                  </td>
                </tr>
                ';
              };
            };
              echo'
              <tr>
              <td colspan="4"></td>
              <td>
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Total</td>
                    <td>Rp '.number_format($ada5["total"], 0, "", ".").',-</td>
                  </tr>
                  <tr>
                    <td>Ongkos Kirim</td>
                    <td>Rp 0,-</td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Kode Unik</td>
                    <td>Rp 0,-</td>                   
                  </tr>
                  <tr>
                    <td>Grand Total</td>
                    <td><span>Rp 0,-</span></td>
                  </tr>
                </table>
              </td>
              </tr>
              ';
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section> <!--/#cart_items-->

	
	<?php
	    include '../part/footer.php';
	?>
    <script src="../js/jquery.js"></script>
	<script src="../js/price-range.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>