<?php
if (!empty($_GET['id_prodi'])) {
  $id_tahun_ajar = $_GET['id_tahun_ajar'];
  $id_unit_kerja = $_GET['id_unit_kerja'];
  $id_prodi = $_GET['id_prodi'];

  $sql_get1 = "select * from tahun_ajar where id_tahun_ajar=$id_tahun_ajar";
  $query_get1 = mysqli_query($koneksi, $sql_get1);
  $get1 = mysqli_fetch_array($query_get1);
  $isi_tahun_ajar = $get1['tahun_ajar'];

  $sql_get2 = "select * from unit_kerja where id_unit_kerja=$id_unit_kerja";
  $query_get2 = mysqli_query($koneksi, $sql_get2);
  $get2 = mysqli_fetch_array($query_get2);
  $isi_unit_kerja = $get2['unit_kerja'];

  $sql_get3 = "select * from prodi where id_prodi=$id_prodi";
  $query_get3 = mysqli_query($koneksi, $sql_get3);
  $get3 = mysqli_fetch_array($query_get3);
  $isi_prodi = $get3['prodi'];
} else {
  $id_tahun_ajar = '';
  $isi_tahun_ajar = "-- Pilih Tahun Ajar --";
  $id_unit_kerja = '';
  $isi_unit_kerja = "-- Pilih Unit Pendidikan --";
  $id_prodi = '';
  $isi_prodi = "-- Pilih Program Studi/Jurusan --";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Jadwal Ajar </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
            <li class="breadcrumb-item active">Jadwal Ajar</li>
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
            <input type="hidden" name="p" value="jadwal">
            <div class="row mb-2">

              <div class="col-3">
                <label for="id_tahun_ajar">Tahun Ajar</label>
                <select name="id_tahun_ajar" class="form-control" required>
                  <option value="<?= $id_tahun_ajar; ?>"><?= $isi_tahun_ajar; ?></option>
                  <?php
                  $sql1 = "select * from tahun_ajar where dihapus_pada IS NULL order by tahun_ajar desc";
                  $query1 = mysqli_query($koneksi, $sql1);
                  while ($data1 = mysqli_fetch_array($query1)) {
                    echo "<option value='$data1[id_tahun_ajar]'>$data1[tahun_ajar]</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="col-3">
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

              <div class="col-3">
                <label for="id_prodi">Prodi / Jurusan</label>
                <select name="id_prodi" id="id_prodi_cari" class="form-control select2bs4" required>
                  <option value="<?= $id_prodi; ?>"><?= $isi_prodi; ?></option>
                </select>
              </div>

              <div class="col-3 align-self-end">
                <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i> Cari</button>
              </div>
          </form>
        </div>

        <div class="card">
          <div class="card-header">
            <h3>Data Jadwal Ajar</h3>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#jadwalModal">
              <i class="fas fa-plus"></i> Tambah</button>

            <table id="example1" class="table table-bordered table-striped table-sm">
              <!-- Kepala Tabel -->
              <thead>
                <tr>
                  <td>Tanggal (Hari)</td>
                  <td>Mata Pelajaran</td>
                  <td>Nama Guru / Dosen</td>
                  <td>Kelas</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <!-- Isi Tabel -->
              <?php
              $sql = "select jadwal.*,mata_pelajaran,tahun_ajar,karyawan.nama,unit_kerja from jadwal,mata_pelajaran,tahun_ajar,karyawan,unit_kerja where jadwal.id_mata_pelajaran=mata_pelajaran.id_mata_pelajaran and jadwal.id_tahun_ajar=tahun_ajar.id_tahun_ajar and jadwal.id_karyawan=karyawan.id_karyawan and karyawan.lembaga=unit_kerja.kode and jadwal.dihapus_pada IS NULL and mata_pelajaran.id_tahun_ajar='$id_tahun_ajar' and mata_pelajaran.id_prodi='$id_prodi'";
              $query = mysqli_query($koneksi, $sql);
              while ($kolom = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?= $kolom['tanggal']; ?> (<?= $kolom['hari']; ?>)</td>
                  <td><?= $kolom['mata_pelajaran']; ?></td>
                  <td><?= $kolom['nama']; ?></td>
                  <td><?= $kolom['kelas']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_jadwal']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/jadwal.php?aksi=hapus&id=<?= $kolom['id_jadwal']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $kolom['id_jadwal']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Jadwal Ajar</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/jadwal.php" method='post'>
                          <input type="hidden" name="aksi" value="ubah">
                          <input type="hidden" name="id_jadwal" value="<?= $kolom['id_jadwal']; ?>">

                          <div class="form-row">
                            <div class="form-group col-md-2">
                              <label for="id_tahun_ajar">Tahun Ajar</label>
                              <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required>
                                <option value="<?= $kolom['id_tahun_ajar']; ?>"><?= $kolom['tahun_ajar']; ?></option>
                              </select>
                            </div>

                            <div class="form-group col-md-5">
                              <label for="id_unit_kerja">Unit Pendidikan</label>
                              <select name="id_unit_kerja" id="id_unit_kerjax" class="form-control" required>
                                <option value="<?= $kolom['id_unit_kerja']; ?>"><?= $kolom['unit_kerja']; ?></option>
                              </select>
                            </div>

                            <div class="form-group col-md-5">
                              <label for="id_mata_pelajaran">Mata Pelajaran</label>
                              <select name="id_mata_pelajaran" id="id_mata_pelajaran_edit" class="form-control" required>
                                <option value="<?= $kolom['id_mata_pelajaran']; ?>"><?= $kolom['mata_pelajaran']; ?></option>
                              </select>
                            </div>


                          </div>

                          <label for="id_karyawan">Nama Guru / Dosen</label>
                          <select name="id_karyawan" id="id_karyawan_edit" class="form-control" required>
                            <option value="<?= $kolom['id_karyawan']; ?>"><?= $kolom['nama']; ?></option>
                            <?php
                            $idunit = $_GET['id_unit_kerja'];
                            $sql3 = "select * from unit_kerja where id_unit_kerja=$idunit";
                            $query3 = mysqli_query($koneksi, $sql3);
                            $data3 = mysqli_fetch_array($query3);
                            $kode_lembaga = $data3['kode'];


                            $sql2 = "select * from karyawan where lembaga='$kode_lembaga' order by nama";
                            $query2 = mysqli_query($koneksi, $sql2);
                            while ($data2 = mysqli_fetch_array($query2)) {
                              echo "<option value='$data2[id_karyawan]'>$data2[nama]</option>";
                            }
                            ?>
                          </select>

                          <label for="kelas">Kelas</label>
                          <input type="text" class="form-control" name="kelas" value="<?= $kolom['kelas']; ?>" required>

                          <label for="hari">Hari Pertemuan</label>
                          <select class="form-control" name="hari" required>
                            <option><?= $kolom['hari']; ?></option>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabo</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                            <option>Minggu</option>
                          </select>

                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="tanggal">Tanggal</label>
                              <input type="date" class="form-control" value="<?= $kolom['tanggal']; ?>" name="tanggal" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="jam_awal">Jam Awal</label>
                              <input type="time" class="form-control" name="jam_awal" value="<?= $kolom['jam_awal']; ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="jam_akhir">Jam Akhir</label>
                              <input type="time" class="form-control" name="jam_akhir" value="<?= $kolom['jam_akhir']; ?>" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Pertemuan Terakhir</label>
                            <input type="date" class="form-control" value="<?= $kolom['tanggal_akhir']; ?>" name="tanggal_akhir" required>
                          </div>

                          <label for="jumlah_jam">Jumlah Jam / SKS</label>
                          <input type="number" class="form-control" name="jumlah_jam" value="<?= $kolom['jumlah_jam']; ?>" required>



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

      </row>


    </div><!-- /.container-fluid -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Untuk Tambah Jadwal Ajar -->
<!-- Modal -->
<div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Ajar Baru (<?= $_GET['id_unit_kerja']; ?>)</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/jadwal.php" method="post">
          <input type="hidden" name="aksi" value="tambah">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="id_tahun_ajar">Tahun Ajar</label>
              <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required readonly>
                <option value="<?= $id_tahun_ajar; ?>"><?= $isi_tahun_ajar; ?></option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="id_unit_kerja">Unit Pendidikan</label>
              <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required readonly>
                <option value="<?= $id_unit_kerja; ?>"><?= $isi_unit_kerja; ?></option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="id_prodi">Program Studi / Jurusan</label>
              <select name="id_prodi" id="id_prodi" class="form-control" required readonly>
                <option value="<?= $id_prodi; ?>"><?= $isi_prodi; ?></option>
              </select>
            </div>


          </div>
          <label for="id_mata_pelajaran">Mata Pelajaran</label>
          <select name="id_mata_pelajaran" id="id_mata_pelajaran" class="form-control" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            <?php
            $sql1 = "select * from mata_pelajaran where dihapus_pada IS NULL and id_prodi=$id_prodi and id_tahun_ajar=$id_tahun_ajar order by mata_pelajaran asc";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1 = mysqli_fetch_array($query1)) {
              echo "<option value='$data1[id_mata_pelajaran]'>$data1[mata_pelajaran]</option>";
            }
            ?>
          </select>

          <label for="id_karyawan">Nama Guru / Dosen</label>
          <select name="id_karyawan" id="id_karyawan" class="form-control " required>
            <option value="">-- Pilih Guru / Dosen / Instruktur --</option>
            <?php
            $idunit = $_GET['id_unit_kerja'];
            $sql3 = "select * from unit_kerja where id_unit_kerja=$idunit";
            $query3 = mysqli_query($koneksi, $sql3);
            $data3 = mysqli_fetch_array($query3);
            $kode_lembaga = $data3['kode'];


            $sql2 = "select * from karyawan where lembaga='$kode_lembaga' order by nama";
            $query2 = mysqli_query($koneksi, $sql2);
            while ($data2 = mysqli_fetch_array($query2)) {
              echo "<option value='$data2[id_karyawan]'>$data2[nama]</option>";
            }
            ?>

          </select>

          <label for="kelas">Kelas</label>
          <input type="text" class="form-control" name="kelas" required>

          <label for="hari">Hari Pertemuan</label>
          <select class="form-control" name="hari" required>
            <option value="">-- Pilih Hari --</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabo</option>
            <option>Kamis</option>
            <option>Jumat</option>
            <option>Sabtu</option>
            <option>Minggu</option>
          </select>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="tanggal">Tanggal Pertemuan Pertama</label>
              <input type="date" class="form-control" name="tanggal" required>
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

          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Pertemuan Terakhir</label>
            <input type="date" class="form-control" name="tanggal_akhir" required>
          </div>

          <label for="jumlah_jam">Jumlah Jam / SKS</label>
          <input type="number" class="form-control" name="jumlah_jam" required>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

</script>