 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <form action="aksi/jadwal.php" method="post">
                 <input type="hidden" name="aksi" value="tambah">
                 <div class="form-row">
                     <div class="form-group col-md-4">
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
                     </div>

                     <div class="form-group col-md-4">
                         <label for="id_unit_kerja">Unit Pendidikan</label>
                         <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required>
                             <option value="">-- Pilih Unit Pendidikan --</option>
                             <?php
                                $sql1 = "select * from unit_kerja where dihapus_pada IS NULL order by unit_kerja asc";
                                $query1 = mysqli_query($koneksi, $sql1);
                                while ($data1 = mysqli_fetch_array($query1)) {
                                    echo "<option value='$data1[unit_kerja]'>$data1[unit_kerja]</option>";
                                }
                                ?>
                         </select>
                     </div>

                     <div class="form-group col-md-4">
                         <label for="id_mata_pelajaran">Mata Pelajaran</label>
                         <select name="id_mata_pelajaran" id="id_mata_pelajaran" class="form-control" required>
                             <option value="">-- Pilih Mata Pelajaran --</option>
                             <?php
                                $sql1 = "select * from mata_pelajaran where dihapus_pada IS NULL order by mata_pelajaran asc";
                                $query1 = mysqli_query($koneksi, $sql1);
                                while ($data1 = mysqli_fetch_array($query1)) {
                                    echo "<option value='$data1[id_mata_pelajaran]'>$data1[mata_pelajaran]</option>";
                                }
                                ?>
                         </select>
                     </div>


                 </div>

                 <label for="id_karyawan">Nama Guru / Dosen</label>
                 <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                     <option value="">-- Pilih Guru / Dosen --</option>
                     <?php
                        $sql1 = "select * from karyawan where mengajar=1 order by nama asc";
                        $query1 = mysqli_query($koneksi, $sql1);
                        while ($data1 = mysqli_fetch_array($query1)) {
                            echo "<option  value='$data1[id_karyawan]'>$data1[nama]($data1[lembaga])</option>";
                        }
                        ?>
                 </select>

                 <label for="kelas">Kelas</label>
                 <input type="text" class="form-control" name="kelas" required>
                 <div class="form-row">
                     <div class="form-group col-md-4">
                         <label for="tanggal">Tanggal</label>
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

         </div>

         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         <button type="submit" class="btn btn-primary">Simpan</button>
         </form>


     </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->