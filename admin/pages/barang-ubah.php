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

      $query_ord = "SELECT * FROM `barang` WHERE `kode_barang` = '".$_GET['id']."'";
      $result = $conn->query($query_ord);
      $row = $result->fetch_assoc();

      $kode_barang = $row['kode_barang'];
      $nama_barang = $row['nama_barang'];
      $harga_barang = $row['harga_barang'];
      $keterangan_barang = $row['keterangan_barang'];
      $kategori_barang = $row['kategori_barang'];
      $photo_barang = $row['photo_barang'];
    ?>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Barang
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo $situs; ?>admin/pages/barang.php"><i class="fa fa-dropbox"></i> Barang</a></li>
            <li class="active">Barang Ubah</li>
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
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Ubah Barang</h3>
                </div>
                <div class="box-body">
                  <form action="../action/barang/ubah.php" method="post" id="input" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" required>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="harga">Harga Barang</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang" value="<?php echo $harga_barang; ?>" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="ket">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" placeholder="Keterangan" rows="5" required><?php echo $keterangan_barang; ?></textarea>
                      </div>
                      <div class="form-group col-xs-4">
                        <div class="col-xs-12" style="padding-left:0px">
                          <label for="photo">Kategori</label>
                          <select class="form-control" id="kategori" name="kategori" required>
                            <option  value="">Pilih Kategori</option>
                            <?php
                              $query_ord = "SELECT * FROM kategori";
                              if ($result = $conn->query($query_ord)) {
                                while ($row = $result->fetch_assoc()) {
                                  if ($kategori_barang == $row['kode_kategori']) {
                                    echo "<option value = '".$row['kode_kategori']."' selected>".$row['nama_kategori']."</option>";
                                  }
                                  else {
                                    echo "<option value = '".$row['kode_kategori']."'>".$row['nama_kategori']."</option>";
                                  }
                                }
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-xs-12" style="padding-left:0px">
                          <input type="checkbox" name="ubahphoto" id="ubahphoto" onclick="return ubahgambar();">
                          <label for="ubahphoto">Ubah Photo</label> 
                          <input type="file" class="form-control" id="photo" name="photo" disabled>
                        </div>
                      </div>
                      <div class="col-xs-2">
                      <div class="square-150x150">
                        <img src='../action/barang/image.php?id=<?php echo $kode_barang; ?>'>
                      </div>
                      </div>
                    </div>
                    <div class="box-footer clearfix" style="text-align:center">
                      <a href="<?php echo $situs; ?>admin/pages/barang.php" class="btn btn-default">Batal</a>
                      <input class="btn btn-primary" type="submit" value="Simpan" name="submit"/>
                    </div>
                  </form>
                </div>           
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
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
      function ubahgambar() {
        if (document.getElementById('photo').disabled == true)
          document.getElementById('photo').disabled=false;
        else
          document.getElementById('photo').disabled=true;
      }
    </script>

  </body>
</html>
