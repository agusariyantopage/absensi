<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $kode=$_POST['kode'];
            $mata_pelajaran=$_POST['mata_pelajaran'];

            $sql="insert into mata_pelajaran (id_tahun_ajar, id_unit_kerja, kode, mata_pelajaran, dibuat_pada, diubah_pada, dihapus_pada) values($id_tahun_ajar,$id_unit_kerja,'$kode', '$mata_pelajaran',DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            header('location:../index.php?p=mata_pelajaran');
        }
        else if($_POST['aksi']=='ubah'){
            $id_mata_pelajaran=$_POST['id_mata_pelajaran'];
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $kode=$_POST['kode'];
            $mata_pelajaran=$_POST['mata_pelajaran'];

            $sql="update mata_pelajaran set id_tahun_ajar=$id_tahun_ajar,id_unit_kerja=$id_unit_kerja,kode='$kode',mata_pelajaran='$mata_pelajaran', diubah_pada=DEFAULT where id_mata_pelajaran=$id_mata_pelajaran";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=mata_pelajaran');
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_mata_pelajaran=$_GET['id'];
            
            $sql="update mata_pelajaran set dihapus_pada=(select now()) where id_mata_pelajaran=$id_mata_pelajaran";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('location:../index.php?p=mata_pelajaran');
        }    
    }
?>