<?php
$id_kelas = $_GET['id'];
$sql1 = "select * from kelas where id_kelas=$id_kelas";
$query1 = mysqli_query($koneksi, $sql1);
$data1 = mysqli_fetch_array($query1);
$id_kelas = $data1['id_kelas'];
$id_unit_kerja = $data1['id_unit_kerja'];
$id_tahun_ajar = $data1['id_tahun_ajar'];
$id_prodi = $data1['id_prodi'];
$nama_kelas= $data1['nama'];


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Anggota Kelas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
                        <li class="breadcrumb-item"><a href="index.php?p=kelas&id_tahun_ajar=<?= $id_tahun_ajar; ?>&id_unit_kerja=<?= $id_unit_kerja; ?>&id_prodi=<?= $id_prodi; ?>">Kelas</a></li>
                        <li class="breadcrumb-item active">Anggota</li>
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


                <div class="card">
                    <div class="card-header">
                        <h3>Anggota Kelas (<?= $nama_kelas; ?>)</h3>
                    </div>
                    <div class="card-body">


                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i> Tambah Sesuai Jurusan</button>

                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <!-- Kepala Tabel -->
                            <thead>
                                <tr>
                                    <td>NIS/NIM</td>
                                    <td>Nama Lengkap</td>
                                    <td>Email</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <!-- Isi Tabel -->
                            <?php

                            $sql = "select kelas_anggota.*,nis,nama,email from kelas_anggota,siswa where kelas_anggota.id_siswa=siswa.id_siswa and id_kelas=$id_kelas and kelas_anggota.dihapus_pada IS NULL";
                            //echo $sql;
                            $query = mysqli_query($koneksi, $sql);
                            while ($kolom = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= $kolom['nis']; ?></td>
                                    <td><?= $kolom['nama']; ?></td>
                                    <td><?= $kolom['email']; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/kelas.php?aksi=hapus-anggota-individual&id_kelas=<?= $kolom['id_kelas']; ?>&id_kelas_anggota=<?= $kolom['id_kelas_anggota']; ?>"><i class="fas fa-trash"></i></a></button>

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

<!-- Modal Untuk Tambah Mata Pelajaran / Kuliah -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota Kelas Baru</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="finditem" class="table table-bordered table-striped table-sm"  style="width:100%;">
                    <!-- Kepala Tabel -->
                    <thead>
                        <tr>
                            <td>NIS/NIM</td>
                            <td>Nama Lengkap</td>                            
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <?php

                    $sql = "select siswa.* from siswa where siswa.dihapus_pada IS NULL and siswa.id_tahun_ajar='$id_tahun_ajar' and siswa.id_prodi='$id_prodi'";
                    //echo $sql;
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $kolom['nis']; ?></td>
                            <td><?= $kolom['nama']; ?></td>   
                            <td>

                                <button type="button" class="btn btn-link"><a href="aksi/kelas.php?aksi=tambah-anggota-individual&id_siswa=<?= $kolom['id_siswa']; ?>&id_kelas=<?= $id_kelas; ?>"><i class="fas fa-check"></i></a></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </form>
            </div>
        </div>
    </div>
</div>