<?php
if (!empty($_GET['id_prodi'])) {
  $id_tahun_ajar = $_GET['id_tahun_ajar'];
  $id_unit_kerja = $_GET['id_unit_kerja'];
  $id_prodi = $_GET['id_prodi'];

  $sql_get1="select * from tahun_ajar where id_tahun_ajar=$id_tahun_ajar";
  $query_get1=mysqli_query($koneksi,$sql_get1);
  $get1=mysqli_fetch_array($query_get1);
  $isi_tahun_ajar=$get1['tahun_ajar'];

  $sql_get2="select * from unit_kerja where id_unit_kerja=$id_unit_kerja";
  $query_get2=mysqli_query($koneksi,$sql_get2);
  $get2=mysqli_fetch_array($query_get2);
  $isi_unit_kerja=$get2['unit_kerja'];

  $sql_get3="select * from prodi where id_prodi=$id_prodi";
  $query_get3=mysqli_query($koneksi,$sql_get3);
  $get3=mysqli_fetch_array($query_get3);
  $isi_prodi=$get3['prodi'];

} else {
  $id_tahun_ajar = 0;
  $isi_tahun_ajar="-- Pilih Tahun Ajar --";
  $id_unit_kerja = 0;
  $isi_unit_kerja="-- Pilih Unit Pendidikan --";
  $id_prodi = 0;
  $isi_prodi="-- Pilih Prodi / Jurusan --";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Mata Pelajaran / Kuliah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
            <li class="breadcrumb-item active">Mata Pelajaran - Kuliah</li>
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
            <input type="hidden" name="p" value="mata_pelajaran">
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
                <select name="id_prodi" id="id_prodi_cari" class="form-control" required>
                <option value="<?= $id_prodi; ?>"><?= $isi_prodi; ?></option>
                  <?php
                  $sql1 = "select * from prodi where dihapus_pada IS NULL order by prodi asc";
                  $query1 = mysqli_query($koneksi, $sql1);
                  while ($data1 = mysqli_fetch_array($query1)) {
                    echo "<option value='$data1[id_prodi]'>$data1[prodi]</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="col-3 align-self-end">
                <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i> Cari</button>
              </div>
          </form>
        </div>

        <div class="card">
          <div class="card-header">
            <h3>Data Mata Pelajaran / Kuliah</h3>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>

            <table id="example1" class="table table-bordered table-striped table-sm">
              <!-- Kepala Tabel -->
              <thead>
                <tr>
                  <td>Kode</td>
                  <td>Mata Pelajaran / Kuliah</td>
                  <td>Semester</td>
                  <td>Jumlah Jam / SKS</td>
                  <td>Perubahan Terakhir</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <!-- Isi Tabel -->
              <?php

              $sql = "select mata_pelajaran.*,unit_kerja,tahun_ajar from mata_pelajaran,unit_kerja,tahun_ajar where mata_pelajaran.id_unit_kerja=unit_kerja.id_unit_kerja and mata_pelajaran.id_tahun_ajar=tahun_ajar.id_tahun_ajar and mata_pelajaran.dihapus_pada IS NULL and mata_pelajaran.id_tahun_ajar=$id_tahun_ajar and mata_pelajaran.id_prodi=$id_prodi";
              //echo $sql;
              $query = mysqli_query($koneksi, $sql);
              while ($kolom = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?= $kolom['kode']; ?></td>
                  <td><?= $kolom['mata_pelajaran']; ?></td>
                  <td><?= $kolom['semester']; ?></td>
                  <td><?= $kolom['jumlah_jam']; ?></td>
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_mata_pelajaran']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/mata_pelajaran.php?aksi=hapus&id=<?= $kolom['id_mata_pelajaran']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $kolom['id_mata_pelajaran']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Mata Pelajaran / Kuliah</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/mata_pelajaran.php" method='post'>
                          <input type="hidden" name="aksi" value="ubah">
                          <input type="hidden" name="id_mata_pelajaran" value="<?= $kolom['id_mata_pelajaran']; ?>">

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

                          <label for="id_unit_kerja">Unit Pendidikan</label>
                          <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required>
                            <option value="<?= $kolom['id_unit_kerja']; ?>"><?= $kolom['unit_kerja']; ?></option>
                            <?php
                            $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja desc";
                            $query1 = mysqli_query($koneksi, $sql1);
                            while ($data1 = mysqli_fetch_array($query1)) {
                              echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
                            }
                            ?>
                          </select>

                          <label for="kode">Kode Mata Pelajaran / Kuliah</label>
                          <input type="text" required class="form-control" value="<?= $kolom['kode']; ?>" name="kode">

                          <label for="mata_pelajaran">Nama Mata Pelajaran / Kuliah</label>
                          <input type="text" required class="form-control" value="<?= $kolom['mata_pelajaran']; ?>" name="mata_pelajaran">

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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran / Kuliah Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/mata_pelajaran.php" method="post">
          <input type="hidden" name="aksi" value="tambah">

          <label for="id_tahun_ajar">Tahun Ajar</label>
          <select name="id_tahun_ajar" id="id_tahun_ajar" class="form-control" required>
            <option value="">-- Pilih Tahun Ajar --</option>
            <?php
            $sql1 = "select * from tahun_ajar where dihapus_pada IS NULL order by tahun_ajar desc";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1 = mysqli_fetch_array($query1)) {
              echo "<option value='$data1[id_tahun_ajar]'>$data1[tahun_ajar]</option>";
            }
            ?>
          </select>

          <label for="id_unit_kerja">Unit Pendidikan</label>
          <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required>
            <option value="">-- Pilih Unit Pendidikan --</option>
            <?php
            $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja desc";
            $query1 = mysqli_query($koneksi, $sql1);
            while ($data1 = mysqli_fetch_array($query1)) {
              echo "<option value='$data1[id_unit_kerja]'>$data1[unit_kerja]</option>";
            }
            ?>
          </select>

          <label for="kode">Kode Mata Pelajaran / Kuliah</label>
          <input type="text" required class="form-control" name="kode">

          <label for="mata_pelajaran">Nama Mata Pelajaran / Kuliah</label>
          <input type="text" required class="form-control" name="mata_pelajaran">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>