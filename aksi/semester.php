<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $id_tahun_ajar=$_POST['id_tahun_ajar'];          
            $semester=$_POST['semester'];          
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            
            $sql="insert into semester (id_tahun_ajar, semester, tanggal_awal, tanggal_akhir, dibuat_pada, diubah_pada, dihapus_pada) values($id_tahun_ajar,'$semester','$tanggal_awal','$tanggal_akhir',DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            echo $sql;
            header('location:../index.php?p=semester');
        }
        else if($_POST['aksi']=='ubah'){
            $id_semester=$_POST['id_semester'];
            $semester=$_POST['semester'];
            $id_tahun_ajar=$_POST['id_tahun_ajar']; 
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];

            $sql="update semester set semester='$semester',id_tahun_ajar=$id_tahun_ajar, tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', diubah_pada=DEFAULT where id_semester=$id_semester";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=semester');
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_semester=$_GET['id'];
            
            $sql="update semester set dihapus_pada=(select now()) where id_semester=$id_semester";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('location:../index.php?p=semester');
        }    
    }
?>