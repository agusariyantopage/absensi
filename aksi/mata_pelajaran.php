<?php
    session_start();
    include "../koneksi.php";

    if(!empty($_POST)){
        if($_POST['aksi']=='tambah'){       
            
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $id_prodi=$_POST['id_prodi'];
            $kode=$_POST['kode'];
            $mata_pelajaran=$_POST['mata_pelajaran'];
            $semester=$_POST['semester'];
            $jumlah_jam=$_POST['jumlah_jam'];

            $sql="insert into mata_pelajaran (id_tahun_ajar, id_unit_kerja, id_prodi, kode, mata_pelajaran, semester, jumlah_jam, dibuat_pada, diubah_pada, dihapus_pada) values($id_tahun_ajar,$id_unit_kerja,$id_prodi,'$kode', '$mata_pelajaran',$semester,$jumlah_jam,DEFAULT,DEFAULT,DEFAULT)";
            mysqli_query($koneksi,$sql);

            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='TAMBAH';                    
            }
            //echo $sql;
            $link='location:../index.php?p=mata_pelajaran&id_tahun_ajar='.$id_tahun_ajar.'&id_unit_kerja='.$id_unit_kerja.'&id_prodi='.$id_prodi;
            header($link);
        }
        else if($_POST['aksi']=='ubah'){
            $id_mata_pelajaran=$_POST['id_mata_pelajaran'];
            $id_unit_kerja=$_POST['id_unit_kerja'];
            $id_tahun_ajar=$_POST['id_tahun_ajar'];
            $id_prodi=$_POST['id_prodi'];
            $kode=$_POST['kode'];
            $mata_pelajaran=$_POST['mata_pelajaran'];
            $semester=$_POST['semester'];
            $jumlah_jam=$_POST['jumlah_jam'];

            $sql="update mata_pelajaran set id_tahun_ajar=$id_tahun_ajar,id_unit_kerja=$id_unit_kerja,kode='$kode',mata_pelajaran='$mata_pelajaran',semester=$semester, jumlah_jam=$jumlah_jam, diubah_pada=DEFAULT where id_mata_pelajaran=$id_mata_pelajaran";
            mysqli_query($koneksi,$sql);
            
            // Trigger Popup Sweet Alert
            $sukses=mysqli_affected_rows($koneksi);
            if($sukses>=1){
                $_SESSION['status_proses'] ='UBAH';                    
            }

            $link='location:../index.php?p=mata_pelajaran&id_tahun_ajar='.$id_tahun_ajar.'&id_unit_kerja='.$id_unit_kerja.'&id_prodi='.$id_prodi;
            header($link);
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