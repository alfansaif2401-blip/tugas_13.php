<?php
session_start();
require_once '../config.php';

if (!is_logged_in() || !is_admin()) {
    redirect('../index.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data event
$query = "SELECT e.*, u.nama as creator FROM events e 
          LEFT JOIN users u ON e.created_by = u.id 
          WHERE e.id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    redirect('dashboard.php');
}

$event = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - Event Sekolah</title>
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
            max-width: 900px;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
        }
        
        .card-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .detail-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
        }
        
        .detail-value {
            color: #333;
            font-size: 14px;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .badge-upcoming {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-ongoing {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-completed {
            background: #d1fae5;
            color: #065f46;
        }
        
        .description-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .description-box h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 16px;
        }
        
        .description-box p {
            color: #555;
            line-height: 1.6;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e0e0e0;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
                <h2><?php echo htmlspecialchars($event['nama_event']); ?></h2>
                <?php
                $badge_class = 'badge-' . $event['status'];
                $status_text = [
                    'upcoming' => 'Mendatang',
                    'ongoing' => 'Berlangsung',
                    'completed' => 'Selesai'
                ];
                ?>
                <span class="badge <?php echo $badge_class; ?>">
                    <?php echo $status_text[$event['status']]; ?>
                </span>
            </div>
            <div class="card-body">
                <div class="detail-grid">
                    <div class="detail-label">📅 Tanggal</div>
                    <div class="detail-value"><?php echo date('d F Y', strtotime($event['tanggal'])); ?></div>
                    
                    <div class="detail-label">🕐 Waktu</div>
                    <div class="detail-value"><?php echo date('H:i', strtotime($event['waktu'])); ?> WIB</div>
                    
                    <div class="detail-label">📍 Lokasi</div>
                    <div class="detail-value"><?php echo htmlspecialchars($event['lokasi']); ?></div>
                    
                    <div class="detail-label">👥 Penyelenggara</div>
                    <div class="detail-value"><?php echo htmlspecialchars($event['penyelenggara']); ?></div>
                    
                    <div class="detail-label">✍️ Dibuat oleh</div>
                    <div class="detail-value"><?php echo htmlspecialchars($event['creator']); ?></div>
                    
                    <div class="detail-label">🗓️ Dibuat pada</div>
                    <div class="detail-value"><?php echo date('d F Y, H:i', strtotime($event['created_at'])); ?></div>
                </div>
                
                <?php if ($event['deskripsi']): ?>
                <div class="description-box">
                    <h3>📝 Deskripsi Event</h3>
                    <p><?php echo nl2br(htmlspecialchars($event['deskripsi'])); ?></p>
                </div>
                <?php endif; ?>
                
                <div class="action-buttons">
                    <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning">Edit Event</a>
                    <a href="delete_event.php?id=<?php echo $event['id']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus event ini?')" 
                       class="btn btn-danger">Hapus Event</a>
                    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
