<?php
if (!empty($_GET['id_unit_kerja'])) {
    $id_periode_absensi = $_GET['id_periode_absensi'];
    $id_unit_kerja = $_GET['id_unit_kerja'];


    $sql_get1 = "select * from periode_absensi where id_periode_absensi=$id_periode_absensi";
    $query_get1 = mysqli_query($koneksi, $sql_get1);
    $get1 = mysqli_fetch_array($query_get1);
    $isi_periode_absensi = $get1['tahun'] . "-" . $get1['bulan'];
    $tanggal_awal = $get1['tanggal_awal'];
    $tanggal_akhir = $get1['tanggal_akhir'];

    $sql_get2 = "select * from unit_kerja where id_unit_kerja=$id_unit_kerja";
    $query_get2 = mysqli_query($koneksi, $sql_get2);
    $get2 = mysqli_fetch_array($query_get2);
    $isi_unit_kerja = $get2['unit_kerja'];
    $lembaga = $get2['kode'];
} else {
    $id_periode_absensi = '';
    $isi_periode_absensi = "-- Pilih Periode Absensi --";
    $tanggal_awal = '';
    $tanggal_akhir = '';
    $id_unit_kerja = '';
    $isi_unit_kerja = "-- Pilih Unit Pendidikan --";
    $lembaga = '';
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Validasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                        <li class="breadcrumb-item active">Validasi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <row>
                <div class="col-12">
                    <form action="index.php">
                        <input type="hidden" name="p" value="validasi-absensi">
                        <div class="row mb-2">

                            <div class="col-4">
                                <label for="id_periode_absensi">Periode Absensi</label>
                                <select name="id_periode_absensi" class="form-control" required>
                                    <option value="<?= $id_periode_absensi; ?>"><?= $isi_periode_absensi; ?></option>
                                    <?php
                                    $sql1 = "select * from periode_absensi where dihapus_pada IS NULL";
                                    $query1 = mysqli_query($koneksi, $sql1);
                                    while ($data1 = mysqli_fetch_array($query1)) {
                                        echo "<option value='$data1[id_periode_absensi]'>$data1[tahun]-$data1[bulan]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <label for="id_unit_kerja">Unit Pendidikan</label>
                                <select name="id_unit_kerja" id="id_unit_kerja_cari" class="form-control" required>
                                    <option value="<?= $id_unit_kerja; ?>"><?= $isi_unit_kerja; ?></option>
                                    <?php
                                    $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja asc";
                                    $query1 = mysqli_query($koneksi, $sql1);
                                    while ($data1 = mysqli_fetch_array($query1)) {
                                        echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="col-4 align-self-end">
                                <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i> Cari</button>
                            </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Data Guru/Dosen</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <!-- Kepala Tabel -->
                            <thead>
                                <tr>
                                    <td>Nama</td>
                                    <td>Jabatan</td>
                                    <td>Golongan</td>
                                    <td>Lembaga</td>
                                    <td>Validasi</td>
                                </tr>
                            </thead>
                            <!-- Isi Tabel -->
                            <?php
                            $sql = "select karyawan.*,id_jadwal from karyawan,jadwal where mengajar=1 and lembaga='$lembaga' and (tanggal>='$tanggal_awal' and tanggal<='$tanggal_akhir') and jadwal.id_karyawan=karyawan.id_karyawan group by nama";
                            $query = mysqli_query($koneksi, $sql);
                            while ($kolom = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= $kolom['nama']; ?></td>
                                    <td><?= $kolom['jabatan']; ?></td>
                                    <td><?= $kolom['golongan']; ?></td>
                                    <td><?= $kolom['lembaga']; ?></td>
                                    <td>
                                        <button type="button" data-id="<?= $kolom['id_karyawan']; ?>" data-awal="<?= $tanggal_awal; ?>" data-akhir="<?= $tanggal_akhir; ?>" data-periode="<?= $id_periode_absensi; ?>" data-unit="<?= $id_unit_kerja; ?>" class="btn btn-link info_validasi_sum" data-toggle="modal" data-target="#exampleModal9"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </table>

                    </div>
                </div>
        </div>
        </row>


</div><!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Untuk Informasi Absensi -->
<div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Informasi Jam Mengajar</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>