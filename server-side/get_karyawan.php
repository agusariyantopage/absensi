<?php
include '../koneksi.php';
$id_unit_kerja = $_POST['id_unit_kerja'];
$sql="select * from unit_kerja where id_unit_kerja=$id_unit_kerja";
$query=mysqli_query($koneksi,$sql);
$data = mysqli_fetch_array($query);
$lembaga=$data['kode'];

echo '<option value="">-- Pilih Guru / Dosen --</option>';

$sql1 = "select * from karyawan where mengajar=1 and lembaga='$lembaga' order by nama asc";
$query1 = mysqli_query($koneksi, $sql1);
while ($data1 = mysqli_fetch_array($query1)) {
	echo "<option value='$data1[id_karyawan]'>$data1[nama]</option>";
}

