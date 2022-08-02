<?php
session_start();
include "../koneksi.php";
$tgl = $_POST['tgl'];
$tgl1=new DateTime($tgl);
$lembaga = $_SESSION['user_lembaga'];
$id_karyawan = $_SESSION['user_id'];
$sql0 = "select * from unit_kerja where kode='$lembaga' order by unit_kerja asc";
$query0 = mysqli_query($koneksi, $sql0);
$data0 = mysqli_fetch_array($query0);
$id_unit_kerja = $data0['id_unit_kerja'];
$dow = $tgl1->format("w")+1;

echo '
<div class="row">
		<div class="col-md-2 col-sm-6">Pengajar</div>
		<div class="col-md-6 col-sm-6">: ' . $_SESSION['user_nama'] . ' </div>
		<div class="col-md-2 col-sm-6">Tanggal</div>
		<div class="col-md-2 col-sm-6">: ' . $tgl . '</div>
</div>
';
?>
<br>
<b>Jadwal</b>
<table class="table table-bordered table-striped" style="width:100%;">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Hari</th>
			<th scope="col">Mata Pelajaran/Kuliah</th>
			<th scope="col">Kelas</th>
			<th scope="col">Jumlah Jam/SKS</th>
		</tr>
	</thead>
	<?php
	$sql1 = "select jadwal.*,mata_pelajaran from jadwal,mata_pelajaran where jadwal.id_mata_pelajaran=mata_pelajaran.id_mata_pelajaran and dayofweek(tanggal)=$dow and id_karyawan=$id_karyawan";
	$query1 = mysqli_query($koneksi, $sql1);
	$no = 0;
	while ($kolom1 = mysqli_fetch_array($query1)) {
		$no++;
		echo "
			<tr>
				<td>$no</td>
				<td>$kolom1[hari]($kolom1[jam_awal] - $kolom1[jam_akhir])</td>
				<td>$kolom1[mata_pelajaran]</td>
				<td>$kolom1[kelas]</td>
				<td align=right>$kolom1[jumlah_jam]</td>
			</tr>				
			";
	}

	?>
</table>
<b>Realisasi</b>
<table class="table table-bordered table-striped" style="width:100%;">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">Mata Pelajaran/Kuliah</th>
			<th scope="col">Kelas</th>
			<th scope="col">Jumlah Jam/SKS</th>
			<th scope="col">Divalidasi Oleh</th>
			<th scope="col">Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php

		$sql2 = "select absensi.*,mata_pelajaran from absensi,mata_pelajaran where absensi.id_mata_pelajaran=mata_pelajaran.id_mata_pelajaran and id_karyawan=$id_karyawan and tanggal='$tgl' and absensi.dihapus_pada IS NULL";
		$query2 = mysqli_query($koneksi, $sql2);
		$no = 0;
		$grandtotal = 0;
		while ($kolom2 = mysqli_fetch_array($query2)) {
			$no++;
			$grandtotal = $grandtotal + $kolom2['jumlah_jam'];
			$msg = "Apakah Yakin Data Ini Dihapus??";

			echo "
		<tr>
			<td>$no</td>
			<td>$kolom2[id_absensi]</td>
			<td>$kolom2[mata_pelajaran]</td>
			<td>$kolom2[kelas]</td>
			<td align=right>$kolom2[jumlah_jam]</td>
			<td align=center>$kolom2[divalidasi_oleh]</td>
			<td align=center>
		";
			if ($kolom2['divalidasi_oleh'] == '-- Belum Validasi --') {
				echo "<a href=\"aksi/absensi.php?aksi=hapus-individual&id=$kolom2[id_absensi]\" OnClick=\"return confirm('Apakah Yakin Data Ini Dihapus??');\"><i class='fas fa-trash'></i></a>			
			</td>
		</tr>
		";
			} else {
				"</td>
		</tr>
		";
			}
		}
		?>

	</tbody>
	<tfoot>
		<td align='center' colspan="6">GRANDTOTAL</td>
		<td align='right'>
			<p><?= number_format($grandtotal); ?></p>
		</td>
	</tfoot>
</table>
<a href='index.php?p=jadwal-input&date=<?= $tgl; ?>'>
	<button type="button" class="btn btn-primary btn-block"><i class="fa fa-file"></i> Input Kelas Diluar Jadwal</button>
</a>