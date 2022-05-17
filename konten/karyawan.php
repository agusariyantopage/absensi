<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Guru dan Dosen</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
            <li class="breadcrumb-item active">Guru dan Dosen</li>
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
              <h3>Data Guru dan Dosen</h3>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-download"></i> Tarik Data</button>

              <table id="example1" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Nama</td>
                    <td>Jabatan</td>
                    <td>Golongan</td>
                    <td>Lembaga</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
                <?php
                $sql = "select * from karyawan where mengajar=1";
                $query = mysqli_query($koneksi, $sql);
                while ($kolom = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $kolom['nama']; ?></td>
                    <td><?= $kolom['jabatan']; ?></td>
                    <td><?= $kolom['golongan']; ?></td>
                    <td><?= $kolom['lembaga']; ?></td>
                    <td>
                    <button type="button" data-id="<?= $kolom['id_karyawan']; ?>" class="btn btn-link info_karyawan_user" data-toggle="modal" data-target="#modalKaryawanUser"><i class="fas fa-user"></i></button>
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

<!-- Modal Untuk Tambah Guru dan Dosen -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Impor Data Dari Payroll</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/karyawan.php" method="post">
          <input type="hidden" name="aksi" value="tambah">

          <label for="ip_server">IP / Domain Server</label>
          <input type="text" required class="form-control" name="ip_server" placeholder="127.0.0.1" required>
          <label for="dbname">Nama Database</label>
          <input type="text" required class="form-control" name="dbname" placeholder="payroll" required>
          <label for="dbuser">Username Database</label>
          <input type="text" required class="form-control" name="dbuser" placeholder="root" required>
          <label for="dbpassword">Password Database</label>
          <input type="text" required class="form-control" name="dbpassword" placeholder="1234" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Impor Sekarang</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Untuk Informasi Absensi -->
<div class="modal fade" id="modalKaryawanUser" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Informasi Username & Password</h5>
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