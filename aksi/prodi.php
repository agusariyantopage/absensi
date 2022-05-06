<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $kode=$_POST['kode'];
            $prodi=$_POST['prodi'];

            $sql="insert into prodi (id_unit_kerja, kode, prodi, dibuat_pada, diubah_pada, dihapus_pada) values($id_unit_kerja, '$kode', '$prodi',DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            header('location:../index.php?p=prodi');
        }
        else if($_POST['aksi']=='ubah'){
            $id_prodi=$_POST['id_prodi'];
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $kode=$_POST['kode'];
            $prodi=$_POST['prodi'];

            $sql="update prodi set id_unit_kerja=$id_unit_kerja, kode='$kode',prodi='$prodi', diubah_pada=DEFAULT where id_prodi=$id_prodi";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            header('location:../index.php?p=prodi');
        }
        
    }

    if(!empty($_GET['aksi'])){
        if($_GET['aksi']=='hapus'){
            $id_prodi=$_GET['id'];
            
            $sql="update prodi set dihapus_pada=(select now()) where id_prodi=$id_prodi";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='HAPUS';                    
            }
            //echo $sql;
            header('location:../index.php?p=prodi');
        }    
    }
?>