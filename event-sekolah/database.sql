-- Database: event_sekolah

CREATE DATABASE IF NOT EXISTS event_sekolah;
USE event_sekolah;

-- Tabel Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_event VARCHAR(200) NOT NULL,
    tanggal DATE NOT NULL,
    waktu TIME NOT NULL,
    lokasi VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    penyelenggara VARCHAR(100),
    status ENUM('upcoming', 'ongoing', 'completed') DEFAULT 'upcoming',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Insert default users
INSERT INTO users (username, password, nama, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'User Biasa', 'user');

-- Password untuk kedua user adalah: password

-- Insert sample events
INSERT INTO events (nama_event, tanggal, waktu, lokasi, deskripsi, penyelenggara, status, created_by) VALUES
('Penerimaan Siswa Baru 2026', '2026-06-15', '08:00:00', 'Aula Utama', 'Acara penerimaan siswa baru tahun ajaran 2026/2027', 'Panitia PSB', 'upcoming', 1),
('Lomba Karya Ilmiah', '2026-02-20', '09:00:00', 'Lab Komputer', 'Lomba karya ilmiah tingkat sekolah', 'OSIS', 'upcoming', 1),
('Perayaan HUT RI ke-81', '2026-08-17', '07:00:00', 'Lapangan Sekolah', 'Upacara dan lomba memperingati HUT RI', 'Tim HUT RI', 'upcoming', 1);
