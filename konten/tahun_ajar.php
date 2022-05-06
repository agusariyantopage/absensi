
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tahun Ajar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
              <li class="breadcrumb-item active">Tahun Ajar</li>
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
              <h3>Data Tahun Ajar</h3>
            </div> 
            <div class="card-body">
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah</button>
              
              <table id="example1" class="table table-bordered table-striped table-sm">
                <!-- Kepala Tabel -->
                <thead>
                  <tr>
                    <td>Tahun Ajar</td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Berakhir</td>                    
                    <td>Perubahan Terakhir</td>
                    <td>Aksi</td>
                  </tr>
                </thead>
                <!-- Isi Tabel -->
<?php
   $sql="select * from tahun_ajar where dihapus_pada IS NULL";
   $query=mysqli_query($koneksi,$sql);
   while($kolom=mysqli_fetch_array($query)){
?>                 
                <tr>
                  <td><?= $kolom['tahun_ajar']; ?></td>
                  <td><?= $kolom['tanggal_awal']; ?></td>
                  <td><?= $kolom['tanggal_akhir']; ?></td>                  
                  <td><?= $kolom['diubah_pada']; ?></td>
                  <td>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#editModal<?= $kolom['id_tahun_ajar']; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-link"><a onclick="return confirm('Apakah Yakin Data Ini Dihapus??')" href="aksi/tahun_ajar.php?aksi=hapus&id=<?= $kolom['id_tahun_ajar']; ?>"><i class="fas fa-trash"></i></a></button>
                  </td>
                </tr>
<!-- Modal Edit -->
<div class="modal fade" id="editModal<?= $kolom['id_tahun_ajar']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Ubah Tahun Ajar</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/tahun_ajar.php" method='post'>
            <input type="hidden" name="aksi" value="ubah">
            <input type="hidden" name="id_tahun_ajar" value="<?= $kolom['id_tahun_ajar']; ?>">

            <label for="tahun_ajar">Nama Tahun Ajar</label>
            <input type="text" required class="form-control" value="<?= $kolom['tahun_ajar']; ?>" name="tahun_ajar">            

            <label for="tanggal_awal">Tanggal Awal Tahun Ajar</label>
            <input type="date" class="form-control" name="tanggal_awal" value="<?= $kolom['tanggal_awal']; ?>" required>    

            <label for="tanggal_akhir">Tanggal Akhir Tahun Ajar</label>
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

  <!-- Modal Untuk Tambah Tahun Ajar -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajar Baru</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/tahun_ajar.php" method="post">
            <input type="hidden" name="aksi" value="tambah">
            <label for="tahun_ajar">Nama Tahun Ajar</label>
            <input type="text" required class="form-control" name="tahun_ajar">            

            <label for="tanggal_awal">Tanggal Awal Tahun Ajar</label>
            <input type="date" class="form-control" name="tanggal_awal" required>    

            <label for="tanggal_akhir">Tanggal Akhir Tahun Ajar</label>
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
