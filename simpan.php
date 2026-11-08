<?php
// simpan.php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $semester = (int)$_POST['semester'];
    $ipk = (float)$_POST['ipk'];
    $beasiswa = mysqli_real_escape_string($conn, $_POST['beasiswa']);
    
    // Server-side validation
    // 1. Validasi Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format email tidak valid.");
    }
    
    // 2. Validasi Nomor HP
    if (!is_numeric($hp)) {
        die("Nomor HP harus berupa angka.");
    }
    
    // 3. Validasi IPK >= 3.00 (Anti-dummy bypass)
    if ($ipk < 3.00) {
        die("IPK tidak memenuhi syarat. Minimal 3.00.");
    }

    // Penanganan Upload Berkas
    $target_dir = "assets/upload/";
    $file_name = basename($_FILES["berkas"]["name"]);
    
    // Tambah timestamp agar nama file unik (Penting agar file dengan nama sama tidak ter-overwrite)
    $unique_file_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
    $target_file = $target_dir . $unique_file_name;
    
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Validasi ekstensi
    $allowed_types = array("pdf", "jpg", "jpeg", "png");
    if (!in_array($file_type, $allowed_types)) {
        header("Location: daftar.php?pesan=gagal_upload");
        exit;
    }

    // Pastikan direktori upload ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Proses upload
    if (move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file)) {
        
        // Simpan ke database
        // Status default adalah 'Belum Diverifikasi' seperti yang di-set di DB
        $query = "INSERT INTO pendaftaran (nama, email, hp, semester, ipk, beasiswa, berkas) 
                  VALUES ('$nama', '$email', '$hp', $semester, $ipk, '$beasiswa', '$unique_file_name')";
                  
        if (mysqli_query($conn, $query)) {
            // Jika sukses
            header("Location: hasil.php?pesan=sukses");
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: daftar.php?pesan=gagal_upload");
        exit;
    }
} else {
    // Jika diakses langsung tanpa POST
    header("Location: daftar.php");
    exit;
}
?>
