<?php
session_start();
include 'config.php'; // Pastikan file config.php disertakan dengan benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $pihak_terduga = $_POST['pihak_terduga'];
    $masalah = $_POST['masalah'];

    // Handling file upload
    $target_dir = "../uploads/"; // Sesuaikan dengan direktori tempat menyimpan file
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi ukuran file
    if ($_FILES["file"]["size"] > 15000000) { // 15 MB (dalam bytes)
        $_SESSION['error'] = "Maaf, ukuran file terlalu besar.";
        header('Location: ../pengaduan.html');
        exit();
    }

    // Hanya izinkan format tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['error'] = "Maaf, hanya format JPG, JPEG, PNG yang diperbolehkan.";
        header('Location: ../pengaduan.html');
        exit();
    }

    // Cek jika file sudah terupload dengan benar
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $foto = $target_file;

        // Siapkan query SQL untuk memasukkan data ke database
        $sql = "INSERT INTO pengaduan (nama, no_hp, email, pihak_terduga, masalah, foto, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";

        // Persiapkan statement SQL
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $_SESSION['error'] = "Prepare statement failed: " . $conn->error;
            header('Location: ../pengaduan.html');
            exit();
        }

        // Bind parameter untuk menghindari SQL injection
        $stmt->bind_param('ssssss', $nama, $no_hp, $email, $pihak_terduga, $masalah, $foto);

        // Eksekusi statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Pengaduan berhasil dikirim!";
            header('Location: ../pengaduan.html');
            exit();
        } else {
            $_SESSION['error'] = "Error dalam eksekusi query: " . $stmt->error;
            header('Location: ../pengaduan.html');
            exit();
        }

        // Tutup statement
        $stmt->close();
    } else {
        $_SESSION['error'] = "Maaf, terjadi kesalahan saat mengupload file Anda.";
        header('Location: ../pengaduan.html');
        exit();
    }
} else {
    $_SESSION['error'] = "Metode tidak diizinkan!";
    header('Location: ../pengaduan.html');
    exit();
}
$conn->close();

?>
