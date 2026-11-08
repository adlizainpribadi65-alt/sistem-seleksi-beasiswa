<?php
// hasil.php
require_once 'koneksi.php';

// Ambil semua data pendaftaran
$query = "SELECT * FROM pendaftaran ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran - BeasiswaKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-graduation-cap me-2"></i>BeasiswaKu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Pilihan Beasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="hasil.php">Hasil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        
        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Pendaftaran beasiswa berhasil disubmit. Silakan tunggu proses verifikasi.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold">Data Pendaftar Beasiswa</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Jenis Beasiswa</th>
                                <th>Status Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(mysqli_num_rows($result) > 0) {
                                $no = 1;
                                while($row = mysqli_fetch_assoc($result)) {
                                    
                                    // Badge color for status
                                    $badge_class = 'bg-warning text-dark';
                                    if(strtolower($row['status']) == 'diterima' || strtolower($row['status']) == 'disetujui') {
                                        $badge_class = 'bg-success';
                                    } elseif(strtolower($row['status']) == 'ditolak') {
                                        $badge_class = 'bg-danger';
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td class='text-start'>" . htmlspecialchars($row['nama']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['hp']) . "</td>";
                                    echo "<td>" . $row['semester'] . "</td>";
                                    echo "<td><strong>" . number_format($row['ipk'], 2) . "</strong></td>";
                                    echo "<td><span class='badge bg-info text-dark'>" . htmlspecialchars($row['beasiswa']) . "</span></td>";
                                    echo "<td><span class='badge $badge_class'>" . htmlspecialchars($row['status']) . "</span></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center py-4 text-muted'>Belum ada data pendaftar.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> BeasiswaKu. BNSP Web Developer Assessment.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
