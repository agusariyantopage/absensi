<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $tahun=$_POST['tahun'];          
            $bulan=$_POST['bulan'];          
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            
            $sql="insert into periode_absensi (tahun, bulan, tanggal_awal, tanggal_akhir, dibuat_pada, diubah_pada, dihapus_pada,aktif) values($tahun,'$bulan','$tanggal_awal','$tanggal_akhir',DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            header('location:../index.php?p=periode-absensi');
        }
        else if($_POST['aksi']=='ubah'){
            $id_periode_absensi=$_POST['id_periode_absensi'];
            $tahun=$_POST['tahun'];          
            $bulan=$_POST['bulan'];          
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            $aktif=$_POST['aktif'];          

            if($aktif==1){
                $sql0="update periode_absensi set aktif=0";
                mysqli_query($koneksi,$sql0);
            }

            $sql="update periode_absensi set tahun=$tahun,bulan='$bulan', tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', diubah_pada=DEFAULT, aktif=$aktif where id_periode_absensi=$id_periode_absensi";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=periode-absensi');
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
            header('location:../index.php?p=periode-absensi');
        }    
    }
?>