<?php
session_start();

// Cek apakah pengguna sudah login
$loggedIn = isset($_SESSION['admin_id']);

// Fungsi untuk mengambil tampilan header berdasarkan status login
function getHeader() {
    global $loggedIn;
    if ($loggedIn) {
        include 'header_logged_in.php'; // Include header untuk pengguna yang sudah login
    } else {
        include 'header_not_logged_in.php'; // Include header untuk pengguna yang belum login
    }
}
?>