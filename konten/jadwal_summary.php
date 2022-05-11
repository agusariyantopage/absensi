<?php
$lembaga = $_SESSION['user_lembaga'];
$id_karyawan = $_SESSION['user_id'];
$sql0 = "select * from unit_kerja where kode='$lembaga' order by unit_kerja asc";
$query0 = mysqli_query($koneksi, $sql0);
$data0 = mysqli_fetch_array($query0);
$id_unit_kerja = $data0['id_unit_kerja'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekapitulasi Mengajar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                        <li class="breadcrumb-item active">Rekapitulasi Mengajar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <row>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Rekapitulasi Mengajar</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <!-- Kepala Tabel -->
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal</td>
                                        <td>Kelas</td>
                                        <td>Divalidasi Oleh</td>
                                        <td>Jumlah Jam / SKS</td>

                                    </tr>
                                </thead>
                                <!-- Isi Tabel -->
                                <?php
                                $sql3 = "select * from periode_absensi where aktif=1";
                                $query3 = mysqli_query($koneksi, $sql3);
                                $data3 = mysqli_fetch_array($query3);
                                $tanggal_awal = $data3['tanggal_awal'];
                                $tanggal_akhir = $data3['tanggal_akhir'];


                                $begin = new DateTime($tanggal_awal);
                                $end = new DateTime($tanggal_akhir);
                                $end = $end->modify('+1 day');

                                $interval = new DateInterval('P1D');
                                $daterange = new DatePeriod($begin, $interval, $end);
                                $no = 0;
                                $grandtotal_jam = 0;
                                foreach ($daterange as $date) {
                                    $no++;
                                    $dow = $date->format("w");
                                    switch ($dow) {
                                        case 0:
                                            $hari = "Minggu";
                                            break;
                                        case 1:
                                            $hari = "Senin";
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
                                    }
                                    $tgl = $date->format("Y-m-d");
                                    $sql1 = "select sum(jumlah_jam) as total_jam from jadwal where tanggal='$tgl' and id_karyawan=$id_karyawan and dihapus_pada IS NULL";
                                    $query1 = mysqli_query($koneksi, $sql1);
                                    $data1 = mysqli_fetch_array($query1);
                                    $total_jam = $data1['total_jam'];
                                    if (is_null($total_jam)) {
                                        $total_jam = 0;
                                    }
                                    $grandtotal_jam = $grandtotal_jam + $total_jam;

                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td>
                                            <button type="button" data-tgl="<?= $date->format("Y-m-d"); ?>" class="btn btn-link info_jadwal_tgl" data-toggle="modal" data-target="#exampleModal9"><?= $date->format("d-m-Y") . "(" . $hari . ")"; ?></button>
                                        </td>
                                        <td>
                                            <?php
                                            $sql2 = "select * from jadwal where tanggal='$tgl' and id_karyawan=$id_karyawan and dihapus_pada IS NULL";
                                            $query2 = mysqli_query($koneksi, $sql2);
                                            if (mysqli_num_rows($query2) >= 1) {
                                                while ($data2 = mysqli_fetch_array($query2)) {
                                                    echo $data2['kelas'] . ' ';
                                                    
                                                    $valid = '<font class="text-success">'.$data2['divalidasi_oleh'] . ' ( ' . $data2['divalidasi_pada'] . ' )';
                                                }
                                            } else {
                                                $valid = "<font class='text-danger'>-- Tidak Ada Data --</font>";
                                            }

                                            ?>
                                        </td>
                                        <td><?= $valid; ?></td>
                                        <td align="right"><?= $total_jam; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4">Total Jam</td>
                                    <td align="right"><?= $grandtotal_jam; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </row>


        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Untuk Informasi Absensi -->
<div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Informasi Jam Mengajar</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>