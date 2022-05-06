<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $tahun_ajar=$_POST['tahun_ajar'];
            $timestamp_a = strtotime($_POST['tanggal_awal']); 
            $timestamp_b = strtotime($_POST['tanggal_akhir']); 
            $tahun_awal=date('Y',$timestamp_a);
            $tahun_akhir=date('Y',$timestamp_b);
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            
            $sql="insert into tahun_ajar (tahun_ajar, tahun_awal, tahun_akhir, tanggal_awal, tanggal_akhir, dibuat_pada, diubah_pada, dihapus_pada) values('$tahun_ajar',$tahun_awal,$tahun_akhir,'$tanggal_awal','$tanggal_akhir',DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            header('location:../index.php?p=tahun_ajar');
        }
        else if($_POST['aksi']=='ubah'){
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $tahun_ajar=$_POST['tahun_ajar'];
            $timestamp_a = strtotime($_POST['tanggal_awal']); 
            $timestamp_b = strtotime($_POST['tanggal_akhir']); 
            $tahun_awal=date('Y',$timestamp_a);
            $tahun_akhir=date('Y',$timestamp_b);
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];

            $sql="update tahun_ajar set tahun_ajar='$tahun_ajar', tahun_awal=$tahun_awal, tahun_akhir=$tahun_akhir, tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', diubah_pada=DEFAULT where id_tahun_ajar=$id_tahun_ajar";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=tahun_ajar');
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_tahun_ajar=$_GET['id'];
            
            $sql="update tahun_ajar set dihapus_pada=(select now()) where id_tahun_ajar=$id_tahun_ajar";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('location:../index.php?p=tahun_ajar');
        }    
    }
?>