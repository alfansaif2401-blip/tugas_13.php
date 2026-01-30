<?php
session_start();
require_once '../config.php';

if (!is_logged_in()) {
    redirect('../index.php');
}

if (is_admin()) {
    redirect('../admin/dashboard.php');
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px;
        }
        
        .card-header h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 40px;
        }
        
        .detail-grid {
            display: grid;
            gap: 25px;
        }
        
        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        
        .detail-icon {
            font-size: 24px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0fdf4;
            border-radius: 8px;
            flex-shrink: 0;
        }
        
        .detail-content {
            flex: 1;
        }
        
        .detail-label {
            font-weight: 600;
            color: #666;
            font-size: 13px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .detail-value {
            color: #333;
            font-size: 16px;
        }
        
        .badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 12px;
            font-size: 14px;
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
        
        .description-section {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e0e0e0;
        }
        
        .description-section h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }
        
        .description-section p {
            color: #555;
            line-height: 1.8;
            font-size: 15px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
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
        
        .btn-primary {
            background: #10b981;
            color: white;
        }
        
        .btn-primary:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }
        
        .event-meta {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 13px;
            color: #666;
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
                    <div class="detail-item">
                        <div class="detail-icon">📅</div>
                        <div class="detail-content">
                            <div class="detail-label">Tanggal</div>
                            <div class="detail-value"><?php echo date('l, d F Y', strtotime($event['tanggal'])); ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">🕐</div>
                        <div class="detail-content">
                            <div class="detail-label">Waktu</div>
                            <div class="detail-value"><?php echo date('H:i', strtotime($event['waktu'])); ?> WIB</div>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">📍</div>
                        <div class="detail-content">
                            <div class="detail-label">Lokasi</div>
                            <div class="detail-value"><?php echo htmlspecialchars($event['lokasi']); ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">👥</div>
                        <div class="detail-content">
                            <div class="detail-label">Penyelenggara</div>
                            <div class="detail-value"><?php echo htmlspecialchars($event['penyelenggara']); ?></div>
                        </div>
                    </div>
                </div>
                
                <?php if ($event['deskripsi']): ?>
                <div class="description-section">
                    <h3>📝 Tentang Event</h3>
                    <p><?php echo nl2br(htmlspecialchars($event['deskripsi'])); ?></p>
                </div>
                <?php endif; ?>
                
                <div class="event-meta">
                    <strong>Informasi:</strong> Event ini dibuat oleh <?php echo htmlspecialchars($event['creator']); ?> 
                    pada tanggal <?php echo date('d F Y, H:i', strtotime($event['created_at'])); ?>
                </div>
                
                <div class="action-buttons">
                    <a href="dashboard.php" class="btn btn-primary">← Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
