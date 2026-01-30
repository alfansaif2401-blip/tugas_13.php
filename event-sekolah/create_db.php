<?php
// Script to create the database and tables

// Connect to MySQL without specifying database
$conn = mysqli_connect('localhost', 'root', '');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS event_sekolah";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "\n";
}

// Select database
mysqli_select_db($conn, 'event_sekolah');

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo "Users table created successfully\n";
} else {
    echo "Error creating users table: " . mysqli_error($conn) . "\n";
}

// Create events table
$sql = "CREATE TABLE IF NOT EXISTS events (
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
)";
if (mysqli_query($conn, $sql)) {
    echo "Events table created successfully\n";
} else {
    echo "Error creating events table: " . mysqli_error($conn) . "\n";
}

// Insert default users
$sql = "INSERT INTO users (username, password, nama, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'User Biasa', 'user')
ON DUPLICATE KEY UPDATE username=username";
if (mysqli_query($conn, $sql)) {
    echo "Default users inserted successfully\n";
} else {
    echo "Error inserting users: " . mysqli_error($conn) . "\n";
}

// Insert sample events
$sql = "INSERT INTO events (nama_event, tanggal, waktu, lokasi, deskripsi, penyelenggara, status, created_by) VALUES
('Penerimaan Siswa Baru 2026', '2026-06-15', '08:00:00', 'Aula Utama', 'Acara penerimaan siswa baru tahun ajaran 2026/2027', 'Panitia PSB', 'upcoming', 1),
('Lomba Karya Ilmiah', '2026-02-20', '09:00:00', 'Lab Komputer', 'Lomba karya ilmiah tingkat sekolah', 'OSIS', 'upcoming', 1),
('Perayaan HUT RI ke-81', '2026-08-17', '07:00:00', 'Lapangan Sekolah', 'Upacara dan lomba memperingati HUT RI', 'Tim HUT RI', 'upcoming', 1)
ON DUPLICATE KEY UPDATE nama_event=nama_event";
if (mysqli_query($conn, $sql)) {
    echo "Sample events inserted successfully\n";
} else {
    echo "Error inserting events: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
echo "Database setup completed!\n";
?>
