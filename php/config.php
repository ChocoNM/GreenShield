<?php
$host = 'localhost';
$db = 'id22325980_green_shield';
$user = 'root'; // sesuaikan dengan user MySQL Anda
$pass = ''; // sesuaikan dengan password MySQL Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil";
}
?>
