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
            Stok
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Stok</li>
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
                  <i class="fa fa-plus-square"></i>
                  <h3 class="box-title">Input Stok</h3>
                </div>
                <div class="box-body">
                  <form action="../pages/stok.php" method="get" id="input" enctype="multipart/form-data">
                      <div class="form-group col-xs-6">
                        <label for="photo">Kategori</label>
                        <div class="input-group input-group-sm">
                          <select class="form-control" id="kategori" name="kategori" required>
                            <option value="all">Semua Kategori</option>
                            <?php
                              $query_ord = "SELECT * FROM kategori";
                              if ($result = $conn->query($query_ord)) {
                                while ($row = $result->fetch_assoc()) {
                                  if(isset($_GET['kategori'])){
                                    if ($_GET['kategori'] == $row['kode_kategori']) {
                                      echo "<option value = '".$row['kode_kategori']."' selected>".$row['nama_kategori']."</option>";
                                    }
                                    else {
                                      echo "<option value = '".$row['kode_kategori']."'>".$row['nama_kategori']."</option>";
                                    }
                                  }
                                  else {
                                      echo "<option value = '".$row['kode_kategori']."'>".$row['nama_kategori']."</option>";
                                  }
                                }
                              }
                            ?>
                          </select>
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-flat" type="submit">Cari</button>
                          </span>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="50px">No.</th>
                        <th>Nama Barang</th>
                        <th>Photo</th>
                        <th>Jumlah Stok</th>
                        <th width="250px">Tambah Stok</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
            					  $query_ord = "SELECT * FROM barang left join kategori on barang.kategori_barang=kategori.kode_kategori";  
            					  if(isset($_GET['kategori']))
            					  {
                        $kodekategori = $_GET['kategori'];
                          if($kodekategori == 'all')
                          {
                            $query_ord = "SELECT * FROM barang left join kategori on barang.kategori_barang=kategori.kode_kategori";  
                          }
                          else
                          {
                                  $query_ord = "SELECT * FROM barang left join kategori on barang.kategori_barang=kategori.kode_kategori WHERE kode_kategori = ".$kodekategori."";

                          }
            					  }

                      if ($result = $conn->query($query_ord)) {
                        $i=1;
                          while ($row = $result->fetch_assoc()) {
                          $img = imagecreatefromstring($row['photo_barang']);
                          $query_stok = "SELECT count(*) AS jumlah FROM stok WHERE status_stok = 0 AND kode_barang =".$row["kode_barang"]."";
          							  $result_stok = $conn->query($query_stok);
          							  $data = $result_stok->fetch_assoc();
                          echo "
          							  <tr>
                          <td>".$i."</td>
                          <td>".$row['nama_barang']."</td>
                          <td><div class='thumb'>";
                          if(imagesx($img) < imagesy($img)) { //portrait
                            echo'
                            <img src="data:image/jpeg;base64,'.base64_encode($row['photo_barang']).'" class="portrait" alt="" />';
                          }
                          else {
                            echo'
                            <img src="data:image/jpeg;base64,'.base64_encode($row['photo_barang']).'" alt="" />';
                          }
                          echo "</div></td>
                          <td>".$data['jumlah']." buah</td>
          								<td><form action='../action/stok/tambah.php?kodebarang=".$row['kode_barang']."' method = 'post' id='tambah".$i."'>

                          <div class='input-group input-group-sm'>
                          <input type='number' class='form-control' name='jumlah' value=0>
                          <span class='input-group-btn'>
                            <button class='btn btn-primary btn-flat' type='submit' value='tambah' name='submit'>Tambah</button>
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
          "columns"   : [null, null, {"orderable":false}, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[5, 10, 30, -1], [5, 10, 30, "All"]],
        });
      });
    </script>

  </body>
</html>
