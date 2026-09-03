<?php

$hostname = "localhost";
$usrname = "root";
$pass = "";
$dbname = "toko_onlen";

$conn = mysqli_connect($hostname, $usrname, $pass, $dbname);

if(!$conn){

	die('Koneksi database gagal: ' . mysqli_connect_error());

}

?>