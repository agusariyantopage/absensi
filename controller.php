<?php
    $BASE_URL="http://localhost/goldyan/";

    if(empty($_GET['p'])){
        $title  =$APP_NAME." V ".$APP_VERSION; 
        $konten="konten/home.php";    
    }

    // (START) Menu Master Data
    else if($_GET['p']=='tahun_ajar'){
        $title  ="Data Tahun Ajar";
        $konten="konten/tahun_ajar.php";
    }
    else if($_GET['p']=='semester'){
        $title  ="Data Semester";
        $konten="konten/semester.php";
    }
    else if($_GET['p']=='unit_kerja'){
        $title  ="Data Unit Pendidikan";
        $konten="konten/unit_kerja.php";
    }
    else if($_GET['p']=='prodi'){
        $title  ="Data Program Studi / Jurusan";
        $konten="konten/prodi.php";
    }
    else if($_GET['p']=='mata_pelajaran'){
        $title  ="Data Mata Pelajaran";
        $konten="konten/mata_pelajaran.php";
    } 
    else if($_GET['p']=='karyawan'){
        $title  ="Data Karyawan";
        $konten="konten/karyawan.php";
    } 
    else if($_GET['p']=='jadwal-summary'){
        $title  ="Data Rekapitulasi Mengajar";
        $konten="konten/jadwal_summary.php";
    } 
    else if($_GET['p']=='jadwal-input'){
        $title  ="Input Absensi Mengajar";
        $konten="konten/jadwal_input.php";
    } 
    else if($_GET['p']=='jadwal'){
        $title  ="Data Jadwal";
        $konten="konten/jadwal.php";
    } 
    else if($_GET['p']=='chain'){
        $title  ="Data Jadwal";
        $konten="konten/chain.php";
    } 
   
    // Menu Transaksi
    else if($_GET['p']=='jadwal'){
        $title  ="Data Perencanaan";
        $konten="konten/jadwal.php";
    }
    else if($_GET['p']=='jadwal-detail'){
        $title  ="Data Detail Perencanaan";
        $konten="konten/jadwal-detail.php";
    }
    else if($_GET['p']=='realisasi'){
        $title  ="Data Realisasi Penjadwalan Collecting";
        $konten="konten/realisasi.php";
    }
    else if($_GET['p']=='jadwal-kolektor'){
        $title  ="Data Jadwal Collecting";
        $konten="konten/jadwal-kolektor.php";
    }

    // Menu Laporan
    else if($_GET['p']=='laporan'){
        $title  ="Laporan";
        $konten="konten/laporan.php";
    }
?>