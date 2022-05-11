<?php
include '../koneksi.php';
$id_unit_kerja = $_POST['id_unit_kerja_cari'];


echo '<option value="">-- Pilih Program Studi/Jurusan --</option>';

$sql1 = "select * from prodi where id_unit_kerja=$id_unit_kerja order by prodi";
$query1 = mysqli_query($koneksi, $sql1);
while ($data1 = mysqli_fetch_array($query1)) {
	echo "<option value='$data1[id_prodi]'>$data1[prodi]</option>";
}

