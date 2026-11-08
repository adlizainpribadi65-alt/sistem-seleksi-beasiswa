<?php
$conn = mysqli_connect("localhost", "root", "", "db_beasiswa");

// Cek koneksi
if (mysqli_connect_errno()){
    // Harus dimatikan agar aplikasi tidak terlihat jalan normal bila database mati (Anti-dummy).
    die("<h1>Koneksi database gagal: " . mysqli_connect_error() . "</h1><p>Pastikan Apache dan MySQL berjalan di XAMPP anda dan database 'db_beasiswa' telah diimport.</p>");
}
?>
