<?php
session_start();
if (empty($_SESSION['user_id'])) {
  header("location:login.php");

  // $_SESSION['user_id']       =1;
  // $_SESSION['user_nama']     ="TEST USER";
  // $_SESSION['user_akses']    =1;
  // $_SESSION['status_proses']         =''; 
}
include "versi.php";
include "koneksi.php";
include "controller.php";
$status_proses = $_SESSION['status_proses'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> <!-- SKIP -->
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> <!-- SKIP -->
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $APP_NAME . " V " . $APP_VERSION; ?></span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['user_nama']; ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">
              <?php
              $hari_angka = date("w");
              switch ($hari_angka) {
                case 1:
                  $hari = "Senen";
                  break;
                case 2:
                  $hari = "Selasa";
                  break;
                case 3:
                  $hari = "Rabo";
                  break;
                case 4:
                  $hari = "Kamis";
                  break;
                case 5:
                  $hari = "Jumat";
                  break;
                case 6:
                  $hari = "Sabtu";
                  break;
                default:
                  $hari = "Minggu";
              }
              echo $hari . ", " . date("d-m-Y");
              ?>
            </li>

            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>


            <?php
            //$_SESSION['level']=1;
            if ($_SESSION['user_akses'] == 1) {
              include "menu_admin.php";
            } else if ($_SESSION['user_akses'] == 3) {
              include "menu_pengajar.php";
            }
            ?>
            <li class="nav-item">
              <a href="aksi/karyawan.php?aksi=logout" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php
    //$konten ="konten/home.php";
    include $konten; ?>

    <footer class="main-footer">
      <strong>Copyright &copy; 2021 <a href="https://backtoskull.wordpress.com">Agus Ariyanto</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->




  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline 
<script src="plugins/sparklines/sparkline.js"></script>-->
  <!-- JQVMap 
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>

  <!-- Plugin Sweet Alert -->
  <script src="dist/js/sweetalert2.all.min.js"></script>
  <!--<script src="dist/js/script-alert.js"></script> -->

  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>


  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>


  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example1_desc").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [0, "desc"],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_desc_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      $('#finditem').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#noorder').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });


      //$('.select2').select2();
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
      $('#id_karyawan').select2({
        dropdownParent: $('#jadwalModal'),
        theme: 'bootstrap4'
      });

      $('#id_mata_pelajaran').select2({
        dropdownParent: $('#jadwalModal'),
        theme: 'bootstrap4'
      });


      $(document).ready(function() {

        // Select Karyawan Berdasarkan Unit Kerja
        $('.modal').on('change', '#id_unit_kerja', function() {
          var id_unit_kerja = document.getElementById("id_unit_kerja").value;
          //alert(id_unit_kerja);
          $.ajax({
            type: 'POST',
            url: "server-side/get_karyawan.php",
            data: {
              id_unit_kerja: id_unit_kerja
            },
            cache: false,
            success: function(msg) {
              $("#id_karyawan").html(msg);
            }
          });
        });

        $(document).on('change', '#id_unit_kerja_cari', function() {

          var id_unit_kerja_cari = document.getElementById("id_unit_kerja_cari").value;
          //alert(id_unit_kerja_cari);
          $.ajax({
            type: 'POST',
            url: "server-side/get_prodi.php",
            data: {
              id_unit_kerja_cari: id_unit_kerja_cari
            },
            cache: false,
            success: function(msg) {
              $("#id_prodi_cari").html(msg);
            }
          });

        });

        $(document).on('change', '#id_prodi', function() {

          var id_prodi = document.getElementById("id_prodi").value;
          //alert(id_prodi);
          $.ajax({
            type: 'POST',
            url: "server-side/get_matpel.php",
            data: {
              id_prodi: id_prodi
            },
            cache: false,
            success: function(msg) {
              $("#id_mata_pelajaran_cari").html(msg);
            }
          });

        });


      });


      // Modal Get Info Jadwal
      $(document).on('click', '.info_jadwal_tgl', function() {

        var tgl = $(this).data('tgl');


        // AJAX request
        $.ajax({
          url: 'server-side/info_jadwal_tgl.php',
          type: 'post',
          data: {
            tgl: tgl
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);
          }
        });
      });

      // Modal Get Info User Karyawan
      $(document).on('click', '.info_karyawan_user', function() {

        var id = $(this).data('id');


        // AJAX request
        $.ajax({
          url: 'server-side/info_karyawan_user.php',
          type: 'post',
          data: {
            id: id
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);
          }
        });
      });

      // Modal Get Validasi Summary
      $(document).on('click', '.info_validasi_sum', function() {

        var id = $(this).data('id');
        var awal = $(this).data('awal');
        var akhir = $(this).data('akhir');
        var periode = $(this).data('periode');
        var unit = $(this).data('unit');


        // AJAX request
        $.ajax({
          url: 'server-side/get_jadwal_sum.php',
          type: 'post',
          data: {
            id: id,
            awal: awal,
            akhir: akhir,
            periode: periode,
            unit: unit
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);
          }
        });
      });
     
      $('.modal').on('click', '#myCheck', function() {
        var x = document.getElementById("sandi");
        alert(x.value);
        if (x.type === "password") {
          x.type = "text";

        } else {
          x.type = "password";
        }
       
      });
     

    });
  </script>

  <script>
    // Modul Sweet Alert
    var statusProses = '<?= $status_proses; ?>';

    if (statusProses === 'HAPUS') {
      Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: 'Berhasil Menghapus Data',
        showConfirmButton: false,
        timer: 1000

      })
    }
    if (statusProses === 'TAMBAH') {
      Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: 'Berhasil Menambah Data',
        showConfirmButton: false,
        timer: 1000

      })
    }
    if (statusProses === 'UBAH') {
      Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: 'Berhasil Mengubah Data',
        showConfirmButton: false,
        timer: 1000

      })
    }
    if (statusProses === 'RESTORE') {
      Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: 'Berhasil Memulihkan Data',
        showConfirmButton: false,
        timer: 1000

      })
    }
    if (statusProses === 'VALIDASI') {
      Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: 'Berhasil Validasi Data',
        showConfirmButton: false,
        timer: 1000

      })
    }
  </script>

  <?php
  $_SESSION['status_proses'] = '';
  ?>

</body>

</html>