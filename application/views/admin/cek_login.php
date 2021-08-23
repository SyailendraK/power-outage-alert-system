<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi, "select * from admin where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
	$_SESSION['username'] = $username;
	echo '<script language="javascript">alert("Anda berhasil Login Admin!"); document.location="dashboard.php";</script>';
} else {
	echo '<script language="javascript">alert("Username atau Password salah"); document.location="index.php";</script>';
}
