<?php
include '../koneksi.php';
$id_prodi = $_POST['id_prodi'];


echo '<option value="">-- Pilih Mata Pelajaran/Kuliah --</option>';

$sql1 = "select * from mata_pelajaran where dihapus_pada IS NULL and id_prodi=$id_prodi";
$query1 = mysqli_query($koneksi, $sql1);
while ($data1 = mysqli_fetch_array($query1)) {
	echo "<option value='$data1[id_mata_pelajaran]'>$data1[mata_pelajaran]</option>";
}

