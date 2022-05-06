<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $kode=$_POST['kode'];
            $unit_kerja=$_POST['unit_kerja'];

            $sql="insert into unit_kerja (kode, unit_kerja, dibuat_pada, diubah_pada, dihapus_pada) values('$kode', '$unit_kerja',DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            header('location:../index.php?p=unit_kerja');
        }
        else if($_POST['aksi']=='ubah'){
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $kode=$_POST['kode'];
            $unit_kerja=$_POST['unit_kerja'];

            $sql="update unit_kerja set kode='$kode',unit_kerja='$unit_kerja', diubah_pada=DEFAULT where id_unit_kerja=$id_unit_kerja";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=unit_kerja');
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_unit_kerja=$_GET['id'];
            
            $sql="update unit_kerja set dihapus_pada=(select now()) where id_unit_kerja=$id_unit_kerja";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('location:../index.php?p=unit_kerja');
        }    
    }
?>