<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program Studi / Jurusan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
                        <li class="breadcrumb-item active">Program Studi / Jurusan</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Program Studi / Jurusan</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus"></i> Tambah</button>

                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <!-- Kepala Tabel -->
                                <thead>
                                    <tr>
                                        <td>Unit Kerja</td>
                                        <td>Kode</td>
                                        <td>Program Studi / Jurusan</td>
                                        <td>Perubahan Terakhir</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <!-- Isi Tabel -->
                                <?php
                                $sql = "select prodi.*,unit_kerja from prodi,unit_kerja where prodi.id_unit_kerja=unit_kerja.id_unit_kerja and prodi.dihapus_pada IS NULL";
                                $query = mysqli_query($koneksi, $sql);
                                while ($kolom = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?= $kolom['unit_kerja']; ?></td>
                                        <td><?= $kolom['kode']; ?></td>
                                        <td><?= $kolom['prodi']; ?></td>
                                        <td><?= $kolom['diubah_pada']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_prodi']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/prodi.php?aksi=hapus&id=<?= $kolom['id_prodi']; ?>"><i class="fas fa-trash"></i></a></button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $kolom['id_prodi']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Ubah Program Studi / Jurusan</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="aksi/prodi.php" method='post'>
                                                        <input type="hidden" name="aksi" value="ubah">
                                                        <input type="hidden" name="id_prodi" value="<?= $kolom['id_prodi']; ?>">

                                                        <label for="id_unit_kerja">Unit Pendidikan</label>
                                                        <select name="id_unit_kerja" id="id_unit_kerjax" class="form-control" required>
                                                            <option value="<?= $kolom['id_unit_kerja']; ?>"><?= $kolom['unit_kerja']; ?></option>
                                                            <?php
                                                            $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja asc";
                                                            $query1 = mysqli_query($koneksi, $sql1);
                                                            while ($data1 = mysqli_fetch_array($query1)) {
                                                                echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
                                                            }
                                                            ?>
                                                        </select>

                                                        <label for="kode">Kode Program Studi / Jurusan</label>
                                                        <input type="text" required class="form-control" value="<?= $kolom['kode']; ?>" name="kode">

                                                        <label for="prodi">Nama Program Studi / Jurusan</label>
                                                        <input type="text" required class="form-control" value="<?= $kolom['prodi']; ?>" name="prodi">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<!-- Modal Untuk Tambah Program Studi / Jurusan -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Program Studi / Jurusan Baru</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="aksi/prodi.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <label for="id_unit_kerja">Unit Pendidikan</label>
                    <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required>
                        <option value="">-- Pilih Unit Pendidikan --</option>
                        <?php
                        $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja asc";
                        $query1 = mysqli_query($koneksi, $sql1);
                        while ($data1 = mysqli_fetch_array($query1)) {
                            echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
                        }
                        ?>
                    </select>
                    <label for="kode">Kode Program Studi / Jurusan</label>
                    <input type="text" required class="form-control" name="kode">

                    <label for="prodi">Nama Program Studi / Jurusan</label>
                    <input type="text" required class="form-control" name="prodi">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>