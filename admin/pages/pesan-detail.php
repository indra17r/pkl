<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../plugins/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <?php
      include '../header.php';
      ?>
	  
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Detail Pesan
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo $situs; ?>admin/pages/pesan.php"><i class="fa fa-envelope"></i> Pesan</a></li>
            <li class="active">Pesan Detail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
              <!-- quick email widget -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i><b> Kembali</b></a></h3>
                </div>
                <div class="box-body">
				  <table id="example1" class="table table-bordered table-hover">
				    <thead>
					  <tr>
					    <th>Kode Pesan</th>
						<th>Tanggal Transaksi</th>
						<th width="300px">Total</th>
					  </tr>
					</thead>
					<tbody>
					  <?php
					    $kode_pesan = $_GET['kode_pesan'];
						#<!-- ambil data -->
					    $query_data = "select pesan.tanggal_pesan, pesan.ongkir_pesan, CONVERT(SUBSTRING(konsumen.telp_konsumen, -3), UNSIGNED INTEGER) AS digit, konsumen.nama_konsumen,
						konsumen.alamat_konsumen, konsumen.telp_konsumen, kodepos_konsumen, pesan.keterangan_pesan
					    FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen
						WHERE pesan.kode_pesan = '".$kode_pesan."'";
					    $result_data = $conn->query($query_data);
					    $data = $result_data->fetch_assoc();
					    #<!-- ambil jumlah uang -->
					    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan ='".$kode_pesan."'";
					    $result_uang = $conn->query($query_uang);
					    $uang = $result_uang->fetch_assoc();
					    #<!-- ambil jumlah total pembayaran -->
					    $jumlah = $uang['jumlah_uang'] + $data['ongkir_pesan'] + $data['digit'];
						echo "
						<tr>
						  <td>".$kode_pesan."</td>
						  <td>".$data['tanggal_pesan']."</td>
						  <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
					    </tr>
						";
					  ?>
					</tbody>
				  </table>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Alamat Tujuan</th>
                        <th width="250px">Total Barang</th>
                        <th width="300px">Ongkos Kirim</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						#<!-- ambil umlah barang -->
						$query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan ='".$kode_pesan."'";
						$result_stok = $conn->query($query_stok);
						$stok = $result_stok->fetch_assoc();
					    echo "
						<tr>
						  <td><b>".$data['nama_konsumen']."</b><br>
						  ".$data['alamat_konsumen']."<br>
						  ".$data['kodepos_konsumen']."<br>
						  Telp. ".$data['telp_konsumen']."</td>
						  <td>".$stok['jumlah_barang']." barang</td>
						  <td>Rp. ".number_format($data['ongkir_pesan'], 0, '', '.').",-</td>
						</tr>
						";
                      ?>
                    </tbody>
                  </table>
				  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Barang</th>
                        <th width="250px">Jumlah Barang</th>
                        <th width="300px">Harga Barang</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  $query_ord = "SELECT * FROM barang left join stok on barang.kode_barang = stok.kode_barang WHERE kode_pesan = '".$kode_pesan."'";
                      if ($result = $conn->query($query_ord)) {
                        $i=1;
                          while ($row = $result->fetch_assoc()) {
							  $query_jb = "SELECT count(*) AS jbarang FROM barang left join stok on barang.kode_barang = stok.kode_barang WHERE stok.kode_pesan = ".$kode_pesan." AND barang.kode_barang = ".$row['kode_barang']."";
                              $result_jb = $conn->query($query_jb);
							  $jbarang = $result_jb->fetch_assoc();
							  echo "
                              <tr>
                                  <td><div class='square-100x100'><img src='../action/barang/image.php?id=".$row['kode_barang']."'></div>
								  <b>   ".$row['nama_barang']."</b><br>
								  ".$row['keterangan_barang']."</td>
								  <td>".$jbarang['jbarang']." barang</td>
                                  <td>Rp. ".number_format($row['harga_barang'], 0, '', '.').",-</td>
                              </tr>
                              ";
                              $i+=1;
                          }
                      }
                      ?>
                    </tbody>
                  </table>
				  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Keterangan</th>
                        <th width="300px">Kode Unik</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						#<!-- ambil umlah barang -->
						$query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan ='".$kode_pesan."'";
						$result_stok = $conn->query($query_stok);
						$stok = $result_stok->fetch_assoc();
					    echo "
						<tr>
						  <td>".$data['keterangan_pesan']."</td>
						  <td>Rp. ".number_format($data['digit'], 0, '', '.').",-</td>
						</tr>
						";
                      ?>
                    </tbody>
                  </table>
				  <?php
				  echo"
				  <h3 align=right><b>Total Pembayaran Rp. ".number_format($jumlah, 0, '', '.').",-</b></h3>
				  ";
				  ?>
				  
                </div><!-- /.box-body -->              
              </div>

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y'); ?> musliModern.com</strong>
      </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="../dist/js/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
		$('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

  </body>
</html>
