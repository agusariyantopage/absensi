<?php

$lembaga = $_SESSION['user_lembaga'];
$id_karyawan = $_SESSION['user_id'];
$sql0 = "select * from unit_kerja where kode='$lembaga' order by unit_kerja asc";
$query0 = mysqli_query($koneksi, $sql0);
$data0 = mysqli_fetch_array($query0);
$id_unit_kerja = $data0['id_unit_kerja'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekapitulasi Mengajar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                        <li class="breadcrumb-item"><a href="index.php?p=jadwal-summary">Rekapitulasi Mengajar</a></li>
                        <li class="breadcrumb-item active">Input</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="aksi/absensi.php" method="post">
                <input type="hidden" name="aksi" value="tambah-individual">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id_tahun_ajar">Tahun Ajar</label>
                        <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required readonly>
                            <?php
                            $sql1 = "select * from tahun_ajar where dihapus_pada IS NULL order by tahun_ajar desc";
                            $query1 = mysqli_query($koneksi, $sql1);
                            while ($data1 = mysqli_fetch_array($query1)) {
                                echo "<option value='$data1[id_tahun_ajar]'>$data1[tahun_ajar]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="id_unit_kerja">Unit Pendidikan</label>
                        <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required readonly>
                            <?php

                            $sql1 = "select * from unit_kerja where kode='$lembaga' order by unit_kerja asc";
                            $query1 = mysqli_query($koneksi, $sql1);
                            while ($data1 = mysqli_fetch_array($query1)) {
                                echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="id_prodi">Program Studi / Jurusan</label>
                        <select name="id_prodi" id="id_prodi" class="form-control select2bs4" required>
                            <option value="">-- Pilih Program Studi / Jurusan --</option>
                            <?php
                            $sql1 = "select * from prodi where id_unit_kerja=$id_unit_kerja order by prodi";
                            $query1 = mysqli_query($koneksi, $sql1);
                            while ($data1 = mysqli_fetch_array($query1)) {
                                echo "<option value='$data1[id_prodi]'>$data1[prodi]</option>";
                            }
                            ?>
                        </select>
                    </div>


                </div>

                <label for="id_mata_pelajaran">Mata Pelajaran</label>
                <select name="id_mata_pelajaran" id="id_mata_pelajaran_cari" class="form-control select2bs4" required>
                    
                </select>

                <label for="id_karyawan">Nama Guru / Dosen</label>
                <select name="id_karyawan" class="form-control" required readonly>

                    <?php
                    $sql1 = "select * from karyawan where id_karyawan=$id_karyawan";
                    $query1 = mysqli_query($koneksi, $sql1);
                    while ($data1 = mysqli_fetch_array($query1)) {
                        echo "<option value='$data1[id_karyawan]'>$data1[nama]</option>";
                    }
                    ?>

                </select>

                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" name="kelas" required>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= $_GET['date']; ?>" readonly required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="jam_awal">Jam Awal</label>
                        <input type="time" class="form-control" name="jam_awal" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="jam_akhir">Jam Akhir</label>
                        <input type="time" class="form-control" name="jam_akhir" required>
                    </div>
                </div>

                <label for="jumlah_jam">Jumlah Jam/SKS</label>
                <input type="number" class="form-control" name="jumlah_jam" required>

                <label for="pertemuan_ke">Pertemuan Ke</label>
                <input type="number" class="form-control" name="pertemuan_ke" required>

                <label for="target_materi">Target Materi</label>
                <textarea name="target_materi" class="form-control" rows="3" required></textarea>

                <label for="realisasi_materi">Pencapaian Materi</label>
                <textarea name="realisasi_materi" class="form-control" rows="3" required></textarea>

                <label for="catatan">Catatan</label>
                <textarea name="catatan" class="form-control" rows="3" required></textarea>

                <label for="jumlah_siswa">Jumlah Siswa</label>
                <input type="number" class="form-control" name="jumlah_siswa" value="0">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="jumlah_hadir">Jumlah Siswa Hadir</label>
                        <input type="number" class="form-control" name="jumlah_hadir" value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jumlah_sakit">Jumlah Siswa Sakit</label>
                        <input type="number" class="form-control" name="jumlah_sakit" value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jumlah_izin">Jumlah Siswa Izin</label>
                        <input type="number" class="form-control" name="jumlah_izin" value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jumlah_alpha">Jumlah Siswa Alpha</label>
                        <input type="number" class="form-control" name="jumlah_alpha" value="0">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        </div>

        </form>

</div><!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->