<?php
include 'config.php';

$username = 'admin';
$password = password_hash('admin', PASSWORD_BCRYPT);
$nama_lengkap = 'Administrator';

$sql = "INSERT INTO pengguna (username, password, nama_lengkap) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $password, $nama_lengkap);

if ($stmt->execute()) {
    echo "Akun admin berhasil ditambahkan!";
} else {
    echo "Error: " . $stmt->error;
}
?>
