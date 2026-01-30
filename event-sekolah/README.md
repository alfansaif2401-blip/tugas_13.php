# Sistem Manajemen Event Sekolah

Sistem manajemen event sekolah sederhana dengan PHP menggunakan 2 role (Admin & User) dengan fitur CRUD lengkap.

## Fitur

### Admin
- Dashboard dengan statistik lengkap
- CRUD Event (Create, Read, Update, Delete)
- Kelola semua event sekolah
- Lihat detail event

### User
- Dashboard dengan tampilan card event
- Lihat daftar semua event
- Lihat detail event
- View-only (tidak bisa edit/hapus)

## Teknologi
- PHP (Native)
- MySQL
- HTML5 & CSS3

## Cara Install

### 1. Persiapan
- Install XAMPP/WAMP/LAMP
- Pastikan Apache dan MySQL sudah berjalan

### 2. Database
- Buka phpMyAdmin (http://localhost/phpmyadmin)
- Import file `database.sql` atau jalankan query di dalamnya
- Database akan otomatis membuat:
  - Database: event_sekolah
  - Tabel: users, events
  - User default: admin & user (password: password)

### 3. Instalasi File
- Copy folder `event-sekolah` ke direktori `htdocs` (untuk XAMPP) atau `www` (untuk WAMP)
- Contoh path: `C:\xampp\htdocs\event-sekolah\`

### 4. Konfigurasi Database (Opsional)
- Buka file `config.php`
- Sesuaikan setting database jika perlu:
  ```php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'event_sekolah');
  ```

### 5. Akses Aplikasi
- Buka browser
- Akses: `http://localhost/event-sekolah/`

## Akun Default

### Admin
- Username: `admin`
- Password: `password`
- Akses: Full CRUD

### User
- Username: `user`
- Password: `password`
- Akses: View Only

## Struktur Folder

```
event-sekolah/
│
├── admin/
│   ├── dashboard.php       # Dashboard admin dengan tabel event
│   ├── add_event.php        # Form tambah event (CREATE)
│   ├── edit_event.php       # Form edit event (UPDATE)
│   ├── view_event.php       # Detail event (READ)
│   └── delete_event.php     # Hapus event (DELETE)
│
├── user/
│   ├── dashboard.php        # Dashboard user dengan card event
│   └── view_event.php       # Detail event
│
├── config.php               # Konfigurasi database
├── index.php                # Halaman login
├── logout.php               # Proses logout
├── database.sql             # File SQL database
└── README.md                # Dokumentasi
```

## Fitur CRUD

### CREATE (Tambah Event)
- Admin dapat menambah event baru
- Form input: Nama Event, Tanggal, Waktu, Lokasi, Penyelenggara, Status, Deskripsi

### READ (Lihat Event)
- Admin: Lihat semua event dalam tabel
- User: Lihat semua event dalam bentuk card
- Kedua role bisa lihat detail lengkap event

### UPDATE (Edit Event)
- Hanya Admin yang bisa edit event
- Semua field dapat diubah

### DELETE (Hapus Event)
- Hanya Admin yang bisa hapus event
- Konfirmasi sebelum menghapus

## Status Event
- **Mendatang** (upcoming): Event yang akan datang
- **Berlangsung** (ongoing): Event yang sedang berlangsung
- **Selesai** (completed): Event yang sudah selesai

## Keamanan
- Session management untuk autentikasi
- Role-based access control (Admin/User)
- SQL injection prevention dengan mysqli_real_escape_string
- Password hashing dengan password_verify
- XSS protection dengan htmlspecialchars

## Catatan
- Password default untuk semua user adalah `password`
- Ubah password setelah instalasi untuk keamanan
- Pastikan folder memiliki permission yang tepat

## Support
Jika ada masalah atau pertanyaan, silakan hubungi developer.

---
Dibuat dengan ❤️ untuk manajemen event sekolah
