<?php
session_start();
include "../koneksi.php";

// Fungsi Hitung Jumlah Anggota
function hitung_jumlah_anggota($koneksi,$id_kelas) {
    $koneksi=$koneksi;
    $id=$id_kelas;
    $sql="update kelas set jumlah=(select COUNT(*) from kelas_anggota where id_kelas=$id and dihapus_pada IS NULL) where id_kelas=$id";
    mysqli_query($koneksi,$sql);
}

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah') {

        $id_unit_kerja = $_POST['id_unit_kerja'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_prodi = $_POST['id_prodi'];
        $nama = $_POST['nama'];


        $sql = "insert into kelas (id_tahun_ajar, id_unit_kerja, id_prodi, nama, jumlah, dibuat_pada, diubah_pada, dihapus_pada) values($id_tahun_ajar,$id_unit_kerja,$id_prodi,'$nama',DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'TAMBAH';
        }
        //echo $sql;
        $link = 'location:../index.php?p=kelas&id_tahun_ajar=' . $id_tahun_ajar . '&id_unit_kerja=' . $id_unit_kerja . '&id_prodi=' . $id_prodi;
        header($link);
    } else if ($_POST['aksi'] == 'ubah') {
        $id_kelas = $_POST['id_kelas'];
        $id_unit_kerja = $_POST['id_unit_kerja'];
        $id_tahun_ajar = $_POST['id_tahun_ajar'];
        $id_prodi = $_POST['id_prodi'];
        $nama = $_POST['nama'];



        $sql = "update kelas set id_tahun_ajar=$id_tahun_ajar, id_unit_kerja=$id_unit_kerja, id_prodi=$id_prodi, nama='$nama',  diubah_pada=DEFAULT where id_kelas=$id_kelas";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'TAMBAH';
        }
        //echo $sql;
        $link = 'location:../index.php?p=kelas&id_tahun_ajar=' . $id_tahun_ajar . '&id_unit_kerja=' . $id_unit_kerja . '&id_prodi=' . $id_prodi;
        header($link);
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_kelas = $_GET['id'];

        $sql = "update kelas set dihapus_pada=(select now()) where id_kelas=$id_kelas";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'HAPUS';
        }
        //echo $sql;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else if ($_GET['aksi'] == 'tambah-anggota-individual') {
        $id_kelas = $_GET['id_kelas'];
        $id_siswa = $_GET['id_siswa'];

        $sql_cek = "select * from kelas_anggota where id_siswa=$id_siswa and id_kelas=$id_kelas and dihapus_pada IS NULL";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $ketemu = mysqli_num_rows($query_cek);
        if ($ketemu <= 0) {
            $sql = "insert into kelas_anggota (id_kelas, id_siswa, dibuat_pada ,diubah_pada, dihapus_pada) values($id_kelas,$id_siswa,DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi, $sql);

            // Trigger Popup Sweet Alert
            $sukses = mysqli_affected_rows($koneksi);
            if ($sukses >= 1) {
                $_SESSION['status_proses'] = 'TAMBAH';
            }
        }
        hitung_jumlah_anggota($koneksi,$id_kelas);


        //echo $sql;
        $link = 'location:../index.php?p=kelas-anggota&id=' . $id_kelas;
        header($link);
    } else if ($_GET['aksi'] == 'hapus-anggota-individual') {
        $id_kelas_anggota = $_GET['id_kelas_anggota'];
        $id_kelas = $_GET['id_kelas'];


        $sql = "update kelas_anggota set dihapus_pada=(select now()) where id_kelas_anggota=$id_kelas_anggota";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses = mysqli_affected_rows($koneksi);
        if ($sukses >= 1) {
            $_SESSION['status_proses'] = 'HAPUS';
        }
        hitung_jumlah_anggota($koneksi,$id_kelas);
        //echo $sql;
        $link = 'location:../index.php?p=kelas-anggota&id=' . $id_kelas;
        header($link);
    }
}
