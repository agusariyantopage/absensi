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
          <h1 class="m-0">Mahasiswa / Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
            <li class="breadcrumb-item active">Mahasiswa - Siswa</li>
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
            <input type="hidden" name="p" value="siswa">
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
            <h3>Data Mahasiswa / Siswa</h3>
          </div>
          <div class="card-body">
            <?php
            if (!empty($_GET['id_prodi'])) {
            ?>
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah</button>
            <?php
            }
            ?>
            <table id="example1" class="table table-bordered table-striped table-sm">
              <!-- Kepala Tabel -->
              <thead>
                <tr>
                  <td>NIS/NIM</td>
                  <td>Nama Lengkap</td>
                  <td>Email</td>
                  <td>Kelas</td>
                  <td>Perubahan Terakhir</td>
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
                  <td><?= $kolom['email']; ?></td>
                  <td><?= $kolom['email']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_siswa']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/siswa.php?aksi=hapus&id=<?= $kolom['id_siswa']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $kolom['id_siswa']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Siswa / Mahasiswa</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/siswa.php" method='post'>
                          <input type="hidden" name="aksi" value="ubah">
                          <input type="hidden" name="id_siswa" value="<?= $kolom['id_siswa']; ?>">

                          <label for="id_tahun_ajar">Tahun Ajar</label>
                          <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required readonly>
                            <option value="<?= $id_tahun_ajar; ?>"><?= $isi_tahun_ajar; ?></option>
                          </select>

                          <label for="id_unit_kerja">Unit Pendidikan</label>
                          <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required readonly>
                            <option value="<?= $id_unit_kerja; ?>"><?= $isi_unit_kerja; ?></option>
                          </select>

                          <label for="id_prodi">Program Studi / Jurusan</label>
                          <select name="id_prodi" id="id_prodi" class="form-control" required readonly>
                            <option value="<?= $id_prodi; ?>"><?= $isi_prodi; ?></option>
                          </select>

                          <label for="nis">NIS/NIM</label>
                          <input type="text" required class="form-control" name="nis" value="<?= $kolom['nis']; ?>">

                          <label for="nama">Nama Lengkap</label>
                          <input type="text" required class="form-control" name="nama" value="<?= $kolom['nama']; ?>">

                          <label for="email">Email</label>
                          <input type="text" required class="form-control" name="email" value="<?= $kolom['email']; ?>">
                          
                          <label for="password">Password Akun</label>
                          <input type="text" required class="form-control" name="password" value="<?= $kolom['password']; ?>">

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

<!-- Modal Untuk Tambah Mata Pelajaran / Kuliah -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa / Mahasiswa Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/siswa.php" method="post">
          <input type="hidden" name="aksi" value="tambah">

          <label for="id_tahun_ajar">Tahun Ajar</label>
          <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required readonly>
            <option value="<?= $id_tahun_ajar; ?>"><?= $isi_tahun_ajar; ?></option>
          </select>

          <label for="id_unit_kerja">Unit Pendidikan</label>
          <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required readonly>
            <option value="<?= $id_unit_kerja; ?>"><?= $isi_unit_kerja; ?></option>
          </select>

          <label for="id_prodi">Program Studi / Jurusan</label>
          <select name="id_prodi" id="id_prodi" class="form-control" required readonly>
            <option value="<?= $id_prodi; ?>"><?= $isi_prodi; ?></option>
          </select>

          <label for="nis">NIS/NIM</label>
          <input type="text" required class="form-control" name="nis">

          <label for="nama">Nama Lengkap</label>
          <input type="text" required class="form-control" name="nama">

          <label for="email">Email</label>
          <input type="text" required class="form-control" name="email">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>