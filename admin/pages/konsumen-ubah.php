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

      $query_ord = "SELECT * FROM `konsumen` WHERE `username_konsumen` = '".$_GET['id']."'";
      $result = $conn->query($query_ord);
      $row = $result->fetch_assoc();

      $username_konsumen = $row['username_konsumen'];
      $nama_konsumen = $row['nama_konsumen'];
      $lahir_konsumen = $row['lahir_konsumen'];
      list($thn, $bln, $tgl) = explode('-', $lahir_konsumen);
      $jeniskel_konsumen = $row['jeniskel_konsumen'];
      $alamat_konsumen = $row['alamat_konsumen'];
      $kodepos_konsumen = $row['kodepos_konsumen'];
      $telp_konsumen = $row['telp_konsumen'];
      $email_konsumen = $row['email_konsumen'];
    ?>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Konsumen
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $situs; ?>admin/index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo $situs; ?>admin/pages/konsumen.php"><i class="fa fa-users"></i> Konsumen</a></li>
            <li class="active">Konsumen Ubah</li>
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
                  <h3 class="box-title">Ubah Konsumen</h3>
                </div>
                <div class="box-body">
                  <form action="../action/konsumen/ubah.php" method="post" id="input" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?php echo $_GET['id']; ?>">
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="<?php echo $username_konsumen; ?>" disabled>
                      </div>
                      <div class="form-group col-xs-6" style="margin-bottom:0px;">
                        <label for="lahir">Tanggal Lahir</label>
                      </div>
                      <div class="form-group col-xs-6">
                        <div class="form-group col-xs-3" style="margin-bottom:0px; padding-left:0px;">
                          <select class="form-control" id="tanggal" name="tanggal" required>
                            <option value="">Tanggal</option>
                            <?php
                            for($i=1; $i<=31; $i++){
                                  if ($i == $tgl) {
                                    echo "<option value = '".$i."' selected>".$i."</option>";
                                  }
                                  else {
                                    echo "<option value = '".$i."'>".$i."</option>";
                                  }
                            }
                            ?>

                          </select>
                        </div>

                        <div class="form-group col-xs-3" style="margin-bottom:0px;">
                          <select class="form-control" id="bulan" name="bulan" required>
                            <option value="">Bulan</option>
                             <?php
                            $blnn=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
                            for($bulan=1; $bulan<=12; $bulan++){
                              if($bulan<=9) {
                                  if ($bulan == $bln) {
                                    echo "<option value = '0".$bulan."' selected>".$blnn[$bulan]."</option>";
                                  }
                                  else {
                                    echo "<option value = '0".$bulan."'>".$blnn[$bulan]."</option>";
                                  }

                              }
                              else {
                                  if ($bulan == $bln) {
                                    echo "<option value = '".$bulan."' selected>".$blnn[$bulan]."</option>";
                                  }
                                  else {
                                    echo "<option value = '".$bulan."'>".$blnn[$bulan]."</option>";
                                  }

                              }
                            }
                            ?>  
                          </select>
                        </div>

                        <div class="form-group col-xs-3" style="margin-bottom:0px;">
                          <select class="form-control" id="tahun" name="tahun" required>
                            <option value="">Tahun</option>
                            <?php
                            $now=date('Y');
                            for($i=$now-14; $i>=$now-80; $i--){
                              if ($i == $thn) {
                                echo "<option value = '".$i."' selected>".$i."</option>";
                                }
                              else {
                                echo "<option value = '".$i."'>".$i."</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $nama_konsumen; ?>" required>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email konsumen" value="<?php echo $email_konsumen; ?>" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="5" required><?php echo $alamat_konsumen; ?></textarea>
                      </div>
                       <div class="form-group col-xs-2">
                        <label for="kodepos">Kode Pos</label>
                        <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Kode Pos" value="<?php echo $kodepos_konsumen; ?>" required>
                      </div>
                         
                      <div class="form-group col-xs-4">
                        <label for="telp">No. Telp</label>
                        <input type="text" class="form-control" id="telp" name="telp" placeholder="No. telp" value="<?php echo $telp_konsumen; ?>" required>
                      </div>
                      <div class="form-group col-xs-6">
                        <label for="jenis">Jenis Kelamin</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                          <option value="">Pilih Jenis Kelamin</option>
                          <?php
                          if ($jeniskel_konsumen == 'Laki-Laki') {
                          echo "<option value='Laki-Laki' selected>Laki-Laki</option>";
                          echo "<option value='Perempuan'>Perempuan</option>";
                            }
                          else {
                           echo "<option value='Laki-Laki'>Laki-Laki</option>";
                          echo "<option value='Perempuan' selected>Perempuan</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="box-footer clearfix" style="text-align:right">
                      <a href="<?php echo $situs; ?>admin/pages/konsumen.php" class="btn btn-default">Batal</a>
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
    </script>

  </body>
</html>
