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
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.min.css">

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
            Pesan
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Pesan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
              <!-- quick email widget -->
                <div class="nav-tabs-custom">
                <ul class="nav nav-pills">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Pesanan Baru</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Pesanan Diproses</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Pesanan Terbayar</a></li>
                  <li><a href="#tab_4" data-toggle="tab">Pesanan Terkirim</a></li>
                  <li><a href="#tab_5" data-toggle="tab">Pesanan Sukses</a></li>
                  <li><a href="#tab_6" data-toggle="tab">Pesanan Batal</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                   
                    <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="180px">Ongkos Kirim</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 0 ";  
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row["kode_pesan"]."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($uang['jumlah_uang'], 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td><form action='../action/pesan/proses.php?kodepesan=".$row['kode_pesan']."' method = 'post' id='tambah".$i."'>

                    <div class='input-group input-group-sm'>
                    <input type='text' class='form-control' name='ongkir' required>
                    <span class='input-group-btn'>
                      <button class='btn btn-primary btn-flat' type='submit' value='Ditambahkan' name='submit'>Tambah</button>
                    </span>
                    </div>

                    </form></td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <div class="box-body">
                    <table id="example3" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="130px">Terbayar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 1 ";  
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    #<!-- ambil jumlah ongkir -->
                    $query_ongkir = "SELECT ongkir_pesan FROM pesan WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_ongkir = $conn->query($query_ongkir);
                    $ongkir = $result_ongkir->fetch_assoc();
                    #<!-- ambil jumlah total pembayaran -->
                    $jumlah = $uang['jumlah_uang'] + $ongkir['ongkir_pesan'] + $row['digit'];
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td><a href='../action/pesan/bayar.php?kode_pesan=".$row['kode_pesan']."' class='text-green'><i class='fa fa-check-square'><b>  TERBAYAR</b></a></td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->   
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    <div class="box-body">
                    <table id="example4" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="180px">Kode Resi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, 
                    CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit 
                    FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 2 ";
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    #<!-- ambil jumlah ongkir -->
                    $query_ongkir = "SELECT ongkir_pesan FROM pesan WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_ongkir = $conn->query($query_ongkir);
                    $ongkir = $result_ongkir->fetch_assoc();
                    #<!-- ambil jumlah total pembayaran -->
                    $jumlah = $uang['jumlah_uang'] + $ongkir['ongkir_pesan'] + $row['digit'];
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td><form action='../action/pesan/kirim.php?kodepesan=".$row['kode_pesan']."' method = 'post' id='tambah".$i."'>

                    <div class='input-group input-group-sm'>
                    <input type='text' class='form-control' name='resi' required>
                    <span class='input-group-btn'>
                      <button class='btn btn-primary btn-flat' type='submit' value='Terkirim' name='submit'>Terkirim</button>
                    </span>
                    </div>

                    </form></td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->  
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_4">
                    <div class="box-body">
                    <table id="example5" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="180px">Kode Resi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, 
                    CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit, pesan.resi_pesan
                    FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 3 ";
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    #<!-- ambil jumlah ongkir -->
                    $query_ongkir = "SELECT ongkir_pesan FROM pesan WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_ongkir = $conn->query($query_ongkir);
                    $ongkir = $result_ongkir->fetch_assoc();
                    #<!-- ambil jumlah total pembayaran -->
                    $jumlah = $uang['jumlah_uang'] + $ongkir['ongkir_pesan'] + $row['digit'];
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td>".$row['resi_pesan']."
                    <form method='get' action='http://cekresi.com/' target='_BLANK'>
                    
                    

                    <div class='input-group input-group-sm'>
                    <input type='hidden' name='noresi' value=".$row['resi_pesan']." />
                    <span class='input-group-btn'>
                      <button class='btn btn-primary btn-flat' type='submit' value='Track Resi' name='submit'>Track Resi</button>
                    </span>
                    </div>

                    <br />
                    </form></td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->     
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_5">
                    <div class="box-body">
                    <table id="example6" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="180px">Kode Resi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, 
                    CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit, pesan.resi_pesan
                    FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 4 ";
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    #<!-- ambil jumlah ongkir -->
                    $query_ongkir = "SELECT ongkir_pesan FROM pesan WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_ongkir = $conn->query($query_ongkir);
                    $ongkir = $result_ongkir->fetch_assoc();
                    #<!-- ambil jumlah total pembayaran -->
                    $jumlah = $uang['jumlah_uang'] + $ongkir['ongkir_pesan'] + $row['digit'];
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td>".$row['resi_pesan']."</td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_6">
                    <div class="box-body">
                    <table id="example7" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th width="95px">Kode Pesan</th>
                    <th>Nama Konsumen</th>
                    <th>Barang</th>
                    <th width="170px">Tanggal Pesan</th>
                    <th>Terbilang</th>
                    <th width="130px">Detail Pesanan</th>
                    <th width="180px">Kode Resi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query_ord = "SELECT konsumen.username_konsumen, pesan.kode_pesan, konsumen.nama_konsumen, pesan.tanggal_pesan, pesan.keterangan_pesan, 
                    CONVERT(SUBSTRING(telp_konsumen, -3), UNSIGNED INTEGER) AS digit, pesan.resi_pesan
                    FROM pesan LEFT JOIN konsumen ON pesan.username_konsumen=konsumen.username_konsumen WHERE status_pesan = 5 ";
                    if ($result = $conn->query($query_ord)) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                    #<!-- ambil jumlah barang -->
                    $query_stok = "SELECT count(*) AS jumlah_barang FROM stok WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_stok = $conn->query($query_stok);
                    $data = $result_stok->fetch_assoc();
                    #<!-- ambil jumlah uang -->
                    $query_uang = "SELECT sum(harga_barang) AS jumlah_uang FROM stok LEFT JOIN barang ON stok.kode_barang=barang.kode_barang WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_uang = $conn->query($query_uang);
                    $uang = $result_uang->fetch_assoc();
                    #<!-- ambil jumlah ongkir -->
                    $query_ongkir = "SELECT ongkir_pesan FROM pesan WHERE kode_pesan =".$row['kode_pesan']."";
                    $result_ongkir = $conn->query($query_ongkir);
                    $ongkir = $result_ongkir->fetch_assoc();
                    #<!-- ambil jumlah total pembayaran -->
                    $jumlah = $uang['jumlah_uang'] + $ongkir['ongkir_pesan'] + $row['digit'];
                    $date = strtotime($row['tanggal_pesan']);
                    echo "
                    <tr>
                    <td>".$row['kode_pesan']."</td>
                    <td>".$row['nama_konsumen']."</td>
                    <td>".$data['jumlah_barang']." barang</td>
                    <td>".date('d M Y - H:i',$date)."</td>
                    <td>Rp. ".number_format($jumlah, 0, '', '.').",-</td>
                    <td><a href='../pages/pesan-detail.php?kode_pesan=".$row['kode_pesan']."' class='text-blue'><i class='fa fa-folder-open'><b>  DETAIL</b></a></td>
                    <td>".$row['resi_pesan']."</td>
                    </tr>
                    ";
                    $i+=1;
                    }

                    }
                    ?>
                    </tbody>

                    </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
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
        $('#example2').DataTable({
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });
    </script>
    <script>
      $(function () {
        $('#example3').DataTable({
          "columns"   : [null, null, null, null, null, null, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });


    </script>    <script>
      $(function () {
        $('#example4').DataTable({
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });
    </script>

        <script>
      $(function () {
        $('#example5').DataTable({
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });
    </script>

        <script>
      $(function () {
        $('#example6').DataTable({
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });
    </script>

        <script>
      $(function () {
        $('#example7').DataTable({
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
          "autoWidth": false
        });
      });
    </script>    
	
  </body>
</html>
