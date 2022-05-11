<?php
session_start();
include "../koneksi.php";
$id_karyawan = $_POST['id'];
$tanggal_awal = $_POST['awal'];
$tanggal_akhir = $_POST['akhir'];
$periode = $_POST['periode'];
$unit = $_POST['unit'];
$token=md5($id_karyawan);
?>
<a href='aksi/jadwal.php?aksi=validasi-semua&token=<?= $token; ?>&awal=<?= $tanggal_awal; ?>&akhir=<?= $tanggal_akhir; ?>&id_periode_absensi=<?= $periode; ?>&id_unit_kerja=<?= $unit; ?>'><button class='btn btn-info mb-3'>Validasi Semua</button></a>
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

    $begin = new DateTime($tanggal_awal);
    $end = new DateTime($tanggal_akhir);
    $end = $end->modify('+1 day');

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval, $end);
    $no = 0;
    $grandtotal_jam=0;
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
        $grandtotal_jam=$grandtotal_jam+$total_jam;

    ?>
        <tr>
            <td><?= $no; ?></td>
            <td>
                <?= $date->format("d-m-Y") . "(" . $hari . ")"; ?>
            </td>
            <td>
                <?php
                $sql2 = "select * from jadwal where tanggal='$tgl' and id_karyawan=$id_karyawan and dihapus_pada IS NULL";
                $query2 = mysqli_query($koneksi, $sql2);
                if (mysqli_num_rows($query2) >= 1) {
                    while ($data2 = mysqli_fetch_array($query2)) {
                        echo $data2['kelas'] . ' ';
                        $valid = $data2['divalidasi_oleh'].' ( '.$data2['divalidasi_pada'].' )';
                    }
                } else {
                    $valid = "-- Belum Validasi --";
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