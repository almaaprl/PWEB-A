<?php
$localhost	= "localhost";
$username	= "root";
$password	= "";
$dbname		= "db_pegawai";

$conn = new mysqli($localhost, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
} 
