<?php
session_start();
include "../koneksi.php";

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah') {

        $id_karyawan = $_POST['id_karyawan'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
        $kelas = $_POST['kelas'];
        $tanggal = $_POST['tanggal'];
        $jam_awal = $_POST['jam_awal'];
        $jam_akhir = $_POST['jam_akhir'];
        $jumlah_jam = $_POST['jumlah_jam'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $target_materi = $_POST['target_materi'];
        $realisasi_materi = $_POST['realisasi_materi'];
        $catatan = $_POST['catatan'];
        $jumlah_siswa = $_POST['jumlah_siswa'];
        $jumlah_hadir = $_POST['jumlah_hadir'];
        $jumlah_sakit = $_POST['jumlah_sakit'];
        $jumlah_izin = $_POST['jumlah_izin'];
        $jumlah_alpha = $_POST['jumlah_alpha'];


        $sql = "insert into absensi (id_karyawan, id_tahun_ajar, id_mata_pelajaran, kelas, tanggal, jam_awal, jam_akhir, jumlah_jam, pertemuan_ke, target_materi, realisasi_materi, catatan, jumlah_siswa, jumlah_hadir, jumlah_sakit, jumlah_izin, jumlah_alpha, dibuat_pada, diubah_pada, divalidasi_pada, divalidasi_oleh, dihapus_pada) values($id_karyawan,$id_tahun_ajar,$id_mata_pelajaran,'$kelas','$tanggal','$jam_awal','$jam_akhir',$jumlah_jam,'$pertemuan_ke','$target_materi','$realisasi_materi','$catatan',$jumlah_siswa,$jumlah_hadir,$jumlah_sakit,$jumlah_izin,$jumlah_alpha,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'TAMBAH';
        }
        //echo $sql;
        header('location:../index.php?p=absensi');
    } else if ($_POST['aksi'] == 'tambah-individual') {

        $id_karyawan = $_POST['id_karyawan'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
        $kelas = $_POST['kelas'];
        $tanggal = $_POST['tanggal'];
        $jam_awal = $_POST['jam_awal'];
        $jam_akhir = $_POST['jam_akhir'];
        $jumlah_jam = $_POST['jumlah_jam'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $target_materi = $_POST['target_materi'];
        $realisasi_materi = $_POST['realisasi_materi'];
        $catatan = $_POST['catatan'];
        $jumlah_siswa = $_POST['jumlah_siswa'];
        $jumlah_hadir = $_POST['jumlah_hadir'];
        $jumlah_sakit = $_POST['jumlah_sakit'];
        $jumlah_izin = $_POST['jumlah_izin'];
        $jumlah_alpha = $_POST['jumlah_alpha'];


        $sql = "insert into absensi (id_karyawan, id_tahun_ajar, id_mata_pelajaran, kelas, tanggal, jam_awal, jam_akhir, jumlah_jam, pertemuan_ke, target_materi, realisasi_materi, catatan, jumlah_siswa, jumlah_hadir, jumlah_sakit, jumlah_izin, jumlah_alpha, dibuat_pada, diubah_pada, divalidasi_pada, divalidasi_oleh, dihapus_pada) values($id_karyawan,$id_tahun_ajar,$id_mata_pelajaran,'$kelas','$tanggal','$jam_awal','$jam_akhir',$jumlah_jam,'$pertemuan_ke','$target_materi','$realisasi_materi','$catatan',$jumlah_siswa,$jumlah_hadir,$jumlah_sakit,$jumlah_izin,$jumlah_alpha,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'TAMBAH';
        }
        //echo $sql;
        header('location:../index.php?p=jadwal-summary');
    } else if ($_POST['aksi'] == 'ubah') {
        $id_absensi = $_POST['id_absensi'];
        $id_karyawan = $_POST['id_karyawan'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
        $kelas = $_POST['kelas'];
        $tanggal = $_POST['tanggal'];
        $jam_awal = $_POST['jam_awal'];
        $jam_akhir = $_POST['jam_akhir'];
        $pertemuan_ke = $_POST['pertemuan_ke'];
        $target_materi = $_POST['target_materi'];
        $realisasi_materi = $_POST['realisasi_materi'];
        $catatan = $_POST['catatan'];
        $jumlah_siswa = $_POST['jumlah_siswa'];
        $jumlah_hadir = $_POST['jumlah_hadir'];
        $jumlah_sakit = $_POST['jumlah_sakit'];
        $jumlah_izin = $_POST['jumlah_izin'];
        $jumlah_alpha = $_POST['jumlah_alpha'];

        $sql = "update absensi set id_karyawan=$id_karyawan, id_tahun_ajar=$id_tahun_ajar, id_mata_pelajaran=$id_mata_pelajaran, kelas='$kelas', tanggal='$tanggal', jam_awal='$jam_awal', jam_akhir='$jam_akhir', pertemuan_ke=$pertemuan_ke, target_materi='$target_materi', realisasi_materi='$realisasi_materi', catatan='$catatan', jumlah_siswa=$jumlah_siswa, jumlah_hadir=$jumlah_hadir, jumlah_sakit=$jumlah_sakit, jumlah_izin=$jumlah_izin, jumlah_alpha=$jumlah_alpha, diubah_pada=DEFAULT where id_absensi=$id_absensi";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'UBAH';
        }

        header('location:../index.php?p=absensi');
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_absensi = $_GET['id'];

        $sql = "update absensi set dihapus_pada=(select now()) where id_absensi=$id_absensi";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'HAPUS';
        }
        //echo $sql;
        header('location:../index.php?p=absensi');
    } else if ($_GET['aksi'] == 'hapus-individual') {
        $id_absensi = $_GET['id'];

        $sql = "update absensi set dihapus_pada=(select now()) where id_absensi=$id_absensi";
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

        $sql = "update absensi set divalidasi_pada=(select now()),divalidasi_oleh='$user' where md5(id_karyawan)='$token' and tanggal between '$awal' and '$akhir' and divalidasi_pada IS NULL";
        mysqli_query($koneksi, $sql);

        //echo $sql;
        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'VALIDASI';
        }
        $link='location:../index.php?p=validasi-absensi&id_periode_absensi='.$periode.'&id_unit_kerja='.$unit;
        header($link);
    } else if ($_GET['aksi'] == 'validasi-satu') {
        $token = $_GET['token'];
        $tanggal = $_GET['tanggal'];        
        $user = $_SESSION['user_nama'];
        $periode = $_GET['id_periode_absensi'];
        $unit = $_GET['id_unit_kerja'];

        $sql = "update absensi set divalidasi_pada=(select now()),divalidasi_oleh='$user' where md5(id_karyawan)='$token' and tanggal='$tanggal' and divalidasi_pada IS NULL";
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
