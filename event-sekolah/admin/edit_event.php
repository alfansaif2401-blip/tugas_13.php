<?php
session_start();
require_once '../config.php';

if (!is_logged_in() || !is_admin()) {
    redirect('../index.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$success = '';
$error = '';

// Ambil data event
$query = "SELECT * FROM events WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    redirect('dashboard.php');
}

$event = mysqli_fetch_assoc($result);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_event = clean_input($_POST['nama_event']);
    $tanggal = clean_input($_POST['tanggal']);
    $waktu = clean_input($_POST['waktu']);
    $lokasi = clean_input($_POST['lokasi']);
    $deskripsi = clean_input($_POST['deskripsi']);
    $penyelenggara = clean_input($_POST['penyelenggara']);
    $status = clean_input($_POST['status']);
    
    $query = "UPDATE events SET 
              nama_event = '$nama_event',
              tanggal = '$tanggal',
              waktu = '$waktu',
              lokasi = '$lokasi',
              deskripsi = '$deskripsi',
              penyelenggara = '$penyelenggara',
              status = '$status'
              WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $success = 'Event berhasil diupdate!';
        // Refresh data
        $result = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
        $event = mysqli_fetch_assoc($result);
    } else {
        $error = 'Gagal mengupdate event: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Event Sekolah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar h1 {
            font-size: 24px;
        }
        
        .navbar a {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }
        
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .card-header {
            padding: 25px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .card-header h2 {
            font-size: 24px;
            color: #333;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-error {
            background: #fee;
            color: #c33;
            border-left: 4px solid #ef4444;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🎓 Sistem Manajemen Event Sekolah</h1>
        <a href="dashboard.php">← Kembali ke Dashboard</a>
    </nav>
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Edit Event</h2>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama_event">Nama Event *</label>
                        <input type="text" id="nama_event" name="nama_event" value="<?php echo htmlspecialchars($event['nama_event']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal">Tanggal *</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo $event['tanggal']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="waktu">Waktu *</label>
                        <input type="time" id="waktu" name="waktu" value="<?php echo $event['waktu']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="lokasi">Lokasi *</label>
                        <input type="text" id="lokasi" name="lokasi" value="<?php echo htmlspecialchars($event['lokasi']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="penyelenggara">Penyelenggara *</label>
                        <input type="text" id="penyelenggara" name="penyelenggara" value="<?php echo htmlspecialchars($event['penyelenggara']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="upcoming" <?php echo $event['status'] === 'upcoming' ? 'selected' : ''; ?>>Mendatang</option>
                            <option value="ongoing" <?php echo $event['status'] === 'ongoing' ? 'selected' : ''; ?>>Berlangsung</option>
                            <option value="completed" <?php echo $event['status'] === 'completed' ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($event['deskripsi']); ?></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Event</button>
                        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
