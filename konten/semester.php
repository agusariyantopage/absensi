<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semester</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
                        <li class="breadcrumb-item active">Semester</li>
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
                            <h3>Data Semester</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-plus"></i> Tambah</button>

                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <!-- Kepala Tabel -->
                                <thead>
                                    <tr>
                                        <td>Tahun Ajar</td>
                                        <td>Semester</td>
                                        <td>Tanggal Mulai</td>
                                        <td>Tanggal Berakhir</td>
                                        <td>Perubahan Terakhir</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <!-- Isi Tabel -->
                                <?php
                                $sql = "select semester.*,tahun_ajar from semester,tahun_ajar where semester.id_tahun_ajar=tahun_ajar.id_tahun_ajar and semester.dihapus_pada IS NULL";
                                $query = mysqli_query($koneksi, $sql);
                                while ($kolom = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?= $kolom['tahun_ajar']; ?></td>
                                        <td><?= $kolom['semester']; ?></td>
                                        <td><?= $kolom['tanggal_awal']; ?></td>
                                        <td><?= $kolom['tanggal_akhir']; ?></td>
                                        <td><?= $kolom['diubah_pada']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_semester']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/semester.php?aksi=hapus&id=<?= $kolom['id_semester']; ?>"><i class="fas fa-trash"></i></a></button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $kolom['id_semester']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Ubah Semester</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="aksi/semester.php" method='post'>
                                                        <input type="hidden" name="aksi" value="ubah">
                                                        <input type="hidden" name="id_semester" value="<?= $kolom['id_semester']; ?>">



                                                        <label for="id_tahun_ajar">Tahun Ajar</label>
                                                        <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required>
                                                            <option value="<?= $kolom['id_tahun_ajar']; ?>"><?= $kolom['tahun_ajar']; ?></option>
                                                            <?php
                                                            $sql1 = "select * from tahun_ajar where dihapus_pada IS NULL order by tahun_ajar desc";
                                                            $query1 = mysqli_query($koneksi, $sql1);
                                                            while ($data1 = mysqli_fetch_array($query1)) {
                                                                echo "<option value='$data1[id_tahun_ajar]'>$data1[tahun_ajar]</option>";
                                                            }
                                                            ?>
                                                        </select>


                                                        <label for="semester">Nama Semester</label>
                                                        <input type="text" required class="form-control" value="<?= $kolom['semester']; ?>" name="semester">

                                                        <label for="tanggal_awal">Tanggal Awal Semester</label>
                                                        <input type="date" class="form-control" name="tanggal_awal" value="<?= $kolom['tanggal_awal']; ?>" required>

                                                        <label for="tanggal_akhir">Tanggal Akhir Semester</label>
                                                        <input type="date" class="form-control" name="tanggal_akhir" value="<?= $kolom['tanggal_akhir']; ?>" required>

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

<!-- Modal Untuk Tambah Semester -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Semester Baru</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="aksi/semester.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <label for="id_tahun_ajar">Tahun Ajar</label>
                    <select name="id_tahun_ajar" class="form-control" required>
                        <option value="">-- Pilih Tahun Ajar --</option>
                        <?php
                        $sql1 = "select * from tahun_ajar where dihapus_pada IS NULL order by tahun_ajar desc";
                        $query1 = mysqli_query($koneksi, $sql1);
                        while ($data1 = mysqli_fetch_array($query1)) {
                            echo "<option value='$data1[id_tahun_ajar]'>$data1[tahun_ajar]</option>";
                        }
                        ?>
                    </select>

                    <label for="semester">Nama Semester</label>
                    <input type="text" required class="form-control" name="semester">

                    <label for="tanggal_awal">Tanggal Awal Semester</label>
                    <input type="date" class="form-control" name="tanggal_awal" required>

                    <label for="tanggal_akhir">Tanggal Akhir Semester</label>
                    <input type="date" class="form-control" name="tanggal_akhir" required>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>