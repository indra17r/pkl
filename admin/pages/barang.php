<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
            Barang
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Barang</li>
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
                  <h3 class="box-title">Input Barang</h3>
                </div>
                <div class="box-body">
                  <form action="../action/barang/tambah.php" method="post" id="input" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" required>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="harga">Harga Barang</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="ket">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" placeholder="Keterangan" rows="5" required></textarea>
                      </div>

                      <div class="form-group col-xs-6">
                        <label for="photo">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori" required>
                          <option value="">Pilih Kategori</option>
                          <?php
                            $query_ord = "SELECT * FROM kategori";
                            if ($result = $conn->query($query_ord)) {
                              while ($row = $result->fetch_assoc()) {
                                echo "<option value = '".$row['kode_kategori']."'>".$row['nama_kategori']."</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" required>
                      </div>
                    </div>
                    <div class="box-footer clearfix">
                      <input class="pull-right btn btn-primary" type="submit" value="Simpan" name="submit"/>
                    </div>
                  </form>
                </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="50px">No.</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Photo</th>
                        <th width="50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query_ord = "SELECT * FROM barang left join kategori on barang.kategori_barang=kategori.kode_kategori";

                      if ($result = $conn->query($query_ord)) {
                        $i=1;
                          while ($row = $result->fetch_assoc()) {
                            $img = imagecreatefromstring($row['photo_barang']);
                              echo "
                              <tr>
                                  <td>".$i."</td>
                                  <td>".$row['nama_barang']."</td>
                                  <td>Rp. ".number_format($row['harga_barang'], 0, '', '.').",-</td>
                                  <td>".$row['keterangan_barang']."</td>
                                  <td>".$row['nama_kategori']."</td>
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
                                  <td>
                                    <a href='../pages/barang-ubah.php?action=ubah&id=".$row["kode_barang"]."'><i class='fa fa-pencil'></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='../action/barang/hapus.php?id=".$row['kode_barang']."' onclick='konfirmasidel()' class='text-red'><i class='fa fa-remove'></i></a>
                                  </td>
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
          "columns"   : [null, null, null, null, null, {"orderable":false}, {"orderable":false}],
        "lengthMenu": [[5, 10, 30, -1], [5, 10, 30, "All"]],
        });
      });

    function konfirmasidel() {
    if (confirm("Apakah Anda Ingin Menghapus Data ???") == false) {
        return event.preventDefault();
      }
    }
    </script>

  </body>
</html>
