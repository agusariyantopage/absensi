<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $id_prodi=$_POST['id_prodi'];
            $nis=$_POST['nis'];
            $nama=$_POST['nama'];
            $email=$_POST['email'];
            

            $sql="insert into siswa (id_tahun_ajar, id_unit_kerja, id_prodi, nis, nama, email, password, dibuat_pada, diubah_pada, dihapus_pada) values($id_tahun_ajar,$id_unit_kerja,$id_prodi,'$nis', '$nama','$email',DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            $link='location:../index.php?p=siswa&id_tahun_ajar='.$id_tahun_ajar.'&id_unit_kerja='.$id_unit_kerja.'&id_prodi='.$id_prodi;
            header($link);
        }
        else if($_POST['aksi']=='ubah'){
            $id_siswa=$_POST['id_siswa'];
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $id_prodi=$_POST['id_prodi'];
            $nis=$_POST['nis'];
            $nama=$_POST['nama'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            

            $sql="update siswa set id_tahun_ajar=$id_tahun_ajar, id_unit_kerja=$id_unit_kerja, id_prodi=$id_prodi, nis='$nis', nama='$nama', email='$email', password='$password', diubah_pada=DEFAULT where id_siswa=$id_siswa";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            $link='location:../index.php?p=siswa&id_tahun_ajar='.$id_tahun_ajar.'&id_unit_kerja='.$id_unit_kerja.'&id_prodi='.$id_prodi;
            header($link);
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_siswa=$_GET['id'];
            
            $sql="update siswa set dihapus_pada=(select now()) where id_siswa=$id_siswa";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }    
    }
?>