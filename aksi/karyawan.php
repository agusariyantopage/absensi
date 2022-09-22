<?php
session_start();
include "../koneksi.php";

if (!empty($_POST)) {
    if ($_POST['aksi'] == 'tambah') {
        $id_kelas_karyawan = $_POST['id_kelas_karyawan'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $handphone = $_POST['handphone'];
        $username = $_POST['email'];
        $password = $_POST['password'];

        $sql = "insert into karyawan (id_karyawan, id_kelas_karyawan, nama, alamat, email, handphone, username, password, dibuat_pada, diubah_pada) values(DEFAULT, $id_kelas_karyawan,'$nama','$alamat','$email','$handphone','$username','$password',DEFAULT,DEFAULT)";
        mysqli_query($koneksi, $sql);
        // echo $sql;
        header('location:../index.php?p=karyawan');
    } else if ($_POST['aksi'] == 'ubah-akun') {
        $id_karyawan = $_POST['id_karyawan'];
        $email = $_POST['email'];
        $sandi = $_POST['sandi'];
        

        $sql = "update karyawan set email='$email',password='$sandi' where id_karyawan=$id_karyawan";
        mysqli_query($koneksi, $sql);

        // Trigger Popup Sweet Alert
        $sukses=mysqli_affected_rows($koneksi);
        if($sukses>=1){
            $_SESSION['status_proses'] ='UBAH';                    
        }
        //echo $sql;
        header('location:../index.php?p=karyawan');
    } else if ($_POST['aksi'] == 'login') {
        $akses = $_POST['akses'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        switch ($akses) {
            case 1:
                $sql = "select * from user where username='$username' and password='$password'";
                $query = mysqli_query($koneksi, $sql);                
                $sukses = mysqli_num_rows($query);

                if ($sukses >= 1) {
                    $user = mysqli_fetch_array($query);
                    $_SESSION['user_id']       = $user['id_user'];
                    $_SESSION['user_nama']     = $user['nama'];
                    $_SESSION['user_lembaga']    = 'ADMINISTRATOR';
                    $_SESSION['user_akses']    = 1;
                    $_SESSION['status_proses']         = '';

                    //mysqli_query($koneksi, $sql2);
                    header("location:../index.php");
                } else {
                    header("location:../login.php?msg=gagal-login");
                }
                break;
            case 2:
                echo "Akses Biro Akademik Masih Dalam Tahap Pengembangan";
                break;
            case 3:
                // echo "Akses Dosen";
                $sql = "select * from karyawan where email='$username' and password='$password'";
                $query = mysqli_query($koneksi, $sql);                
                $sukses = mysqli_num_rows($query);

                if ($sukses >= 1) {
                    $user = mysqli_fetch_array($query);
                    $_SESSION['user_id']       = $user['id_karyawan'];
                    $_SESSION['user_nama']     = $user['nama'];
                    $_SESSION['user_lembaga']    = $user['lembaga'];
                    $_SESSION['user_akses']    = 3;
                    $_SESSION['status_proses']         = '';

                    // mysqli_query($koneksi, $sql2);
                    header("location:../index.php");
                } else {
                    header("location:../login.php?msg=gagal-login");
                }
                break;
            case 4:
                echo "Akses Mahasiswa Masih Dalam Tahap Pengembangan";
                break;
            default:
                echo "Akses Ilegal";
        }
    }
}

if (!empty($_GET['aksi'])) {
    if ($_GET['aksi'] == 'logout') {
        $sql = "UPDATE karyawan SET terakhir_login=DEFAULT WHERE id_karyawan=$_SESSION[user_id]";
        mysqli_query($koneksi, $sql);
        session_destroy();
        header('location:../login.php');
    } else if ($_GET['aksi'] == 'hapus') {
        $x0 = $_GET['id'];
        $sql = "delete from karyawan where id_karyawan=$x0";
        mysqli_query($koneksi, $sql);
        header('location:../index.php?p=karyawan');
    }
}
