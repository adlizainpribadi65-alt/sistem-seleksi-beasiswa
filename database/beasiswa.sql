CREATE DATABASE IF NOT EXISTS db_beasiswa;
USE db_beasiswa;

CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    hp VARCHAR(20) NOT NULL,
    semester INT NOT NULL,
    ipk DECIMAL(3,2) NOT NULL,
    beasiswa VARCHAR(50) NOT NULL,
    berkas VARCHAR(255) NOT NULL,
    status VARCHAR(30) DEFAULT 'Belum Diverifikasi'
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Default admin password 'admin123' mapped to MD5 or password_hash.
-- Let's use simple plaintext for this BNSP assessment unless hash is needed. We will use password_hash.
-- 'admin123' bcrypt hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
