<?php
// index.php
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa BNSP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        .scholarship-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .scholarship-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
        }
    </style>
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
                        <a class="nav-link active" href="index.php">Pilihan Beasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hasil.php">Hasil</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="admin.php" class="btn btn-outline-light btn-sm"><i class="fas fa-lock me-1"></i> Admin Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center shadow">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Raih Masa Depan Gemilang</h1>
            <p class="lead mb-4">Daftarkan diri anda untuk mendapatkan beasiswa pendidikan dan raih prestasi tanpa hambatan finansial.</p>
            <a href="daftar.php" class="btn btn-light btn-lg btn-custom text-primary me-2"><i class="fas fa-paper-plane me-2"></i>Daftar Sekarang</a>
        </div>
    </div>

    <!-- Informasi Beasiswa -->
    <div class="container mb-5">
        <h2 class="text-center mb-5 fw-bold text-dark">Informasi Beasiswa</h2>
        <div class="row g-4 justify-content-center">
            <!-- Beasiswa Akademik -->
            <div class="col-md-5">
                <div class="card scholarship-card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex p-3">
                                <i class="fas fa-book-reader fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h4 class="card-title text-center fw-bold">Beasiswa Akademik</h4>
                        <p class="card-text text-muted text-center mb-4">Bagi mahasiswa yang memiliki prestasi akademik dengan nilai minimum IPK 3.00.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bantuan UKT / SPP</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Uang Saku Bulanan</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pelatihan Softskill</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Beasiswa Non-Akademik -->
            <div class="col-md-5">
                <div class="card scholarship-card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="rounded-circle bg-info bg-opacity-10 d-inline-flex p-3">
                                <i class="fas fa-trophy fa-3x text-info"></i>
                            </div>
                        </div>
                        <h4 class="card-title text-center fw-bold">Beasiswa Non-Akademik</h4>
                        <p class="card-text text-muted text-center mb-4">Bagi mahasiswa yang memiliki prestasi di bidang olahraga, seni, atau organisasi.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bantuan UKT / SPP</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Dana Pembinaan Prestasi</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Sertifikat Penghargaan</li>
                        </ul>
                    </div>
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
