<?php
//Include file koneksi ke database
include "config.php";

//menerima nilai dari kiriman form pendaftaran
$username=$_POST["username"];
$email=$_POST["email"];
$password=md5($_POST["password"]); //untuk password digunakan enskripsi md5


//Query input menginput data kedalam tabel pengguna
  $sql="insert into pengguna (username,email,password) values
		('$username','$email','$password')";

//Mengeksekusi/menjalankan query diatas	
  $hasil=mysqli_query($connection,$sql);

//Kondisi apakah berhasil atau tidak
  if ($hasil) {
	echo '<script language="javascript">
    alert ("Registrasi Berhasil Di Lakukan!");
    window.location="login.php";
    </script>';
	exit;
  }
else {
	echo '<script language="javascript">
    alert ("Registrasi Gagal Di Lakukan!");
    window.location="registrasi.php";
    </script>';
	exit;
}  

?>