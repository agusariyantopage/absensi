<?php
session_start();
include "../koneksi.php";

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah') {

        $id_karyawan = $_POST['id_karyawan'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        $jam_awal = $_POST['jam_awal'];
        $jam_akhir = $_POST['jam_akhir'];
        $jumlah_jam = $_POST['jumlah_jam'];
        


        $sql = "insert into jadwal (id_karyawan, id_tahun_ajar, id_mata_pelajaran, kelas, hari, tanggal,tanggal_akhir, jam_awal, jam_akhir, jumlah_jam, dibuat_pada, diubah_pada, dihapus_pada) values($id_karyawan,$id_tahun_ajar,$id_mata_pelajaran,'$kelas','$hari','$tanggal','$tanggal_akhir','$jam_awal','$jam_akhir',$jumlah_jam,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'TAMBAH';
        }
        //echo $sql;
        //header('location:../index.php?p=jadwal');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    
    } else if ($_POST['aksi'] == 'ubah') {
        $id_jadwal = $_POST['id_jadwal'];
        $id_karyawan = $_POST['id_karyawan'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
        $kelas = $_POST['kelas'];
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        $jam_awal = $_POST['jam_awal'];
        $jam_akhir = $_POST['jam_akhir'];
        $jumlah_jam = $_POST['jumlah_jam'];

        $sql = "update jadwal set id_karyawan=$id_karyawan, id_tahun_ajar=$id_tahun_ajar, id_mata_pelajaran=$id_mata_pelajaran, kelas='$kelas',hari='$hari', tanggal='$tanggal',tanggal_akhir='$tanggal_akhir', jam_awal='$jam_awal', jam_akhir='$jam_akhir',jumlah_jam=$jumlah_jam, diubah_pada=DEFAULT where id_jadwal=$id_jadwal";
        mysqli_query($koneksi, $sql);
        

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'UBAH';
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_jadwal = $_GET['id'];

        $sql = "update jadwal set dihapus_pada=(select now()) where id_jadwal=$id_jadwal";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'HAPUS';
        }
        //echo $sql;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else if ($_GET['aksi'] == 'hapus-individual') {
        $id_jadwal = $_GET['id'];

        $sql = "update jadwal set dihapus_pada=(select now()) where id_jadwal=$id_jadwal";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'HAPUS';
        }
        //echo $sql;
        header('location:../index.php?p=jadwal-summary');
    } else if ($_GET['aksi'] == 'validasi-semua') {
        $token = $_GET['token'];
        $awal = $_GET['awal'];
        $akhir = $_GET['akhir'];
        $user = $_SESSION['user_nama'];
        $periode = $_GET['id_periode_absensi'];
        $unit = $_GET['id_unit_kerja'];

        $sql = "update jadwal set divalidasi_pada=(select now()),divalidasi_oleh='$user' where md5(id_karyawan)='$token' and tanggal between '$awal' and '$akhir'";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'VALIDASI';
        }
        $link='location:../index.php?p=validasi-absensi&id_periode_absensi='.$periode.'&id_unit_kerja='.$unit;
        header($link);
    }
}
