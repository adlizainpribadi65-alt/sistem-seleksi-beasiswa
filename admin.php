<?php
// admin.php
session_start();
require_once 'koneksi.php';

$error = '';
$success = '';

// Handle Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admin.php");
            exit;
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'Username tidak ditemukan!';
    }
}

// Handle Update Status
if (isset($_POST['update_status']) && isset($_SESSION['admin_logged_in'])) {
    $id = (int)$_POST['id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $query_update = "UPDATE pendaftaran SET status = '$status' WHERE id = $id";
    if (mysqli_query($conn, $query_update)) {
        $success = "Status berhasil diupdate!";
    } else {
        $error = "Gagal mengupdate status!";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BeasiswaKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php if (!isset($_SESSION['admin_logged_in'])): ?>
    <!-- Login Form -->
    <div class="container py-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0"><i class="fas fa-lock me-2"></i>Admin Login</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <div class="alert alert-info py-2">
                            <small>Demo: Username <strong>admin</strong> | Password <strong>admin123</strong></small>
                        </div>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="index.php" class="text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- Admin Dashboard -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="admin.php"><i class="fas fa-user-shield me-2"></i>Admin Panel</a>
            <div class="d-flex">
                <span class="navbar-text me-3 text-white">
                    Halo, <?= htmlspecialchars($_SESSION['admin_username']) ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Kelola Pendaftaran Beasiswa</h3>
            <a href="index.php" class="btn btn-secondary btn-sm" target="_blank"><i class="fas fa-external-link-alt me-1"></i> Buka Website</a>
        </div>

        <?php if($success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $success ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email/HP</th>
                                <th>Semester & IPK</th>
                                <th>Berkas</th>
                                <th>Status Saat Ini</th>
                                <th>Aksi Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = "SELECT * FROM pendaftaran ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) > 0) {
                                $no = 1;
                                while($row = mysqli_fetch_assoc($result)) {
                                    $badge_class = 'bg-warning text-dark';
                                    if(strtolower($row['status']) == 'diterima' || strtolower($row['status']) == 'disetujui') {
                                        $badge_class = 'bg-success';
                                    } elseif(strtolower($row['status']) == 'ditolak') {
                                        $badge_class = 'bg-danger';
                                    }
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-start">
                                    <strong><?= htmlspecialchars($row['nama']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($row['beasiswa']) ?></small>
                                </td>
                                <td class="text-start">
                                    <small><i class="fas fa-envelope"></i> <?= htmlspecialchars($row['email']) ?></small><br>
                                    <small><i class="fas fa-phone"></i> <?= htmlspecialchars($row['hp']) ?></small>
                                </td>
                                <td>
                                    Smt <?= $row['semester'] ?> | IPK: <strong><?= number_format($row['ipk'], 2) ?></strong>
                                </td>
                                <td>
                                    <a href="assets/upload/<?= htmlspecialchars($row['berkas']) ?>" target="_blank" class="btn btn-sm btn-info text-white">Lihat Berkas</a>
                                </td>
                                <td><span class="badge <?= $badge_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                                <td>
                                    <form method="POST" action="" class="d-flex justify-content-center align-items-center">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <select name="status" class="form-select form-select-sm w-auto me-2">
                                            <option value="Belum Diverifikasi" <?= ($row['status'] == 'Belum Diverifikasi') ? 'selected' : '' ?>>Belum Diverifikasi</option>
                                            <option value="Diterima" <?= ($row['status'] == 'Diterima') ? 'selected' : '' ?>>Diterima</option>
                                            <option value="Ditolak" <?= ($row['status'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada data pendaftar.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
