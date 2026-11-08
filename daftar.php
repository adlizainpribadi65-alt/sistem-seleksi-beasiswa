<?php
// daftar.php
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa - BeasiswaKu</title>
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
                        <a class="nav-link active" href="daftar.php">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hasil.php">Hasil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white text-center py-4">
                        <h3 class="mb-0 fw-bold">Daftar Beasiswa</h3>
                        <p class="text-muted mb-0">Isi form di bawah ini dengan data yang benar.</p>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal_upload'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> Terjadi kesalahan saat mengunggah berkas atau format tidak sesuai (Hanya PDF/JPG/PNG).
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>

                        <!-- Form Start -->
                        <form action="simpan.php" method="POST" enctype="multipart/form-data">
                            
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Masukkan Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Masukkan Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="email@contoh.com">
                            </div>

                            <!-- Nomor HP -->
                            <div class="mb-3">
                                <label for="hp" class="form-label">Nomor HP</label>
                                <!-- JS limitation on form submit can be added, HTML5 type number also enforces -->
                                <input type="number" class="form-control" id="hp" name="hp" required placeholder="08...">
                            </div>

                            <!-- Semester -->
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester saat ini</label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="" selected disabled>Pilih Semester</option>
                                    <?php for($i=1; $i<=8; $i++): ?>
                                        <option value="<?= $i; ?>">Semester <?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <!-- IPK -->
                            <div class="mb-3">
                                <label for="ipk" class="form-label">IPK Terakhir</label>
                                <input type="number" class="form-control" id="ipk" name="ipk" min="0" max="4" step="0.01" required placeholder="Contoh: 3.50">
                                <small class="text-muted">Masukkan IPK Anda untuk mengecek kelayakan beasiswa (Min 3.00).</small>
                                <div id="ipk-warning" class="text-danger mt-1 d-none fw-bold">
                                    <i class="fas fa-exclamation-triangle"></i> Mohon maaf, IPK Anda tidak memenuhi syarat minimum (3.00).
                                </div>
                            </div>

                            <!-- Pilihan Beasiswa -->
                            <div class="mb-3">
                                <label for="beasiswa" class="form-label">Pilihan Beasiswa</label>
                                <select class="form-select" id="beasiswa" name="beasiswa" required>
                                    <option value="" selected disabled>Pilih Beasiswa</option>
                                    <option value="Akademik">Beasiswa Akademik</option>
                                    <option value="Non-Akademik">Beasiswa Non-Akademik</option>
                                </select>
                            </div>

                            <!-- Upload Berkas -->
                            <div class="mb-4">
                                <label for="berkas" class="form-label">Upload Berkas Syarat</label>
                                <input class="form-control" type="file" id="berkas" name="berkas" accept=".pdf, .jpg, .jpeg, .png" required>
                                <div class="form-text">Format yang didukung: PDF, JPG, PNG.</div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-secondary me-md-2">Batal</button>
                                <button type="submit" class="btn btn-primary" id="btn-daftar">Daftar Jabar Coding Camp</button>
                            </div>
                        </form>
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
    
    <!-- Custom JS untuk Validasi IPK -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ipkInput = document.getElementById('ipk');
            const beasiswaSelect = document.getElementById('beasiswa');
            const berkasInput = document.getElementById('berkas');
            const btnDaftar = document.getElementById('btn-daftar');
            const ipkWarning = document.getElementById('ipk-warning');

            // Fungsi untuk mengecek dan mengatur state input
            function checkIPK() {
                const ipkValue = parseFloat(ipkInput.value);
                
                if (isNaN(ipkValue)) {
                    // Jika belum diisi, biarkan default (ataupun disable)
                    // Lebih baik disable sampai IPK diisi dengan benar.
                    setInputsState(false);
                    ipkWarning.classList.add('d-none');
                } else if (ipkValue < 3.00) {
                    // Fitur disable
                    setInputsState(true);
                    // Reset value
                    beasiswaSelect.value = "";
                    berkasInput.value = "";
                    
                    ipkWarning.classList.remove('d-none');
                } else {
                    // Fitur enable
                    setInputsState(false);
                    ipkWarning.classList.add('d-none');
                }
            }

            function setInputsState(isDisabled) {
                beasiswaSelect.disabled = isDisabled;
                berkasInput.disabled = isDisabled;
                btnDaftar.disabled = isDisabled;
                
                if(isDisabled) {
                    btnDaftar.classList.add('btn-secondary');
                    btnDaftar.classList.remove('btn-primary');
                } else {
                    btnDaftar.classList.add('btn-primary');
                    btnDaftar.classList.remove('btn-secondary');
                }
            }

            // Inisialisasi awal
            checkIPK();

            // Event listener setiap kali nilai IPK berubah
            ipkInput.addEventListener('input', checkIPK);
        });
    </script>
</body>
</html>
