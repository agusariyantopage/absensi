<?php
session_start();
include "../koneksi.php";
$id_karyawan=$_POST['id'];
$sql="select * from karyawan where id_karyawan=$id_karyawan";
$query=mysqli_query($koneksi,$sql);
$data=mysqli_fetch_array($query);
?>
<form action="aksi/karyawan.php" method="POST">
    <input type="hidden" name="aksi" value="ubah-akun">
    <input type="hidden" name="id_karyawan" value="<?= $id_karyawan; ?>">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="<?= $data['email']; ?>" required>
    <label for="password">Password</label>
    <input value="<?= $data['password']; ?>" id="sandi" name="sandi" type="password" class="form-control" required>
    <button type="button" class="btn btn-info mt-2" id="myCheck"> Tampilkan Password</button>
    <button type="submit" class="btn btn-success mt-2">Update</button></form>

