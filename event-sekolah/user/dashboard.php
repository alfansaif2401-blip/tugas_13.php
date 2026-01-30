<?php
session_start();
require_once '../config.php';

// Cek login dan role
if (!is_logged_in()) {
    redirect('../index.php');
}

if (is_admin()) {
    redirect('../admin/dashboard.php');
}

// Ambil data event
$query = "SELECT e.*, u.nama as creator FROM events e 
          LEFT JOIN users u ON e.created_by = u.id 
          ORDER BY e.tanggal DESC";
$events = mysqli_query($conn, $query);

// Hitung statistik
$total_events = mysqli_num_rows($events);
$upcoming = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE status='upcoming'"));
$ongoing = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE status='ongoing'"));
$completed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE status='completed'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Event Sekolah</title>
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
        
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .navbar .user-info span {
            font-size: 14px;
        }
        
        .navbar .btn-logout {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        .navbar .btn-logout:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(16, 185, 129, 0.3);
        }
        
        .welcome-banner h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .welcome-banner p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        
        .stat-info h3 {
            font-size: 32px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: #666;
            font-size: 14px;
        }
        
        .events-section {
            margin-top: 30px;
        }
        
        .section-header {
            margin-bottom: 20px;
        }
        
        .section-header h2 {
            font-size: 24px;
            color: #333;
        }
        
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        
        .event-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .event-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px;
        }
        
        .event-header h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .event-body {
            padding: 20px;
        }
        
        .event-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #555;
            font-size: 14px;
        }
        
        .event-description {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
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
        
        .btn-detail {
            display: inline-block;
            width: 100%;
            padding: 10px;
            background: #10b981;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .btn-detail:hover {
            background: #059669;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🎓 Sistem Manajemen Event Sekolah</h1>
        <div class="user-info">
            <span>Halo, <strong><?php echo $_SESSION['nama']; ?></strong></span>
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="welcome-banner">
            <h2>Selamat Datang! 👋</h2>
            <p>Temukan dan ikuti berbagai event menarik yang diselenggarakan oleh sekolah</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #dbeafe; color: #1e40af;">📅</div>
                <div class="stat-info">
                    <h3><?php echo $total_events; ?></h3>
                    <p>Total Event</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #fef3c7; color: #92400e;">⏰</div>
                <div class="stat-info">
                    <h3><?php echo $upcoming; ?></h3>
                    <p>Event Mendatang</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #fce7f3; color: #9f1239;">🎯</div>
                <div class="stat-info">
                    <h3><?php echo $ongoing; ?></h3>
                    <p>Event Berlangsung</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #d1fae5; color: #065f46;">✅</div>
                <div class="stat-info">
                    <h3><?php echo $completed; ?></h3>
                    <p>Event Selesai</p>
                </div>
            </div>
        </div>
        
        <div class="events-section">
            <div class="section-header">
                <h2>📋 Daftar Event</h2>
            </div>
            
            <div class="events-grid">
                <?php 
                mysqli_data_seek($events, 0);
                while ($event = mysqli_fetch_assoc($events)): 
                ?>
                <div class="event-card">
                    <div class="event-header">
                        <h3><?php echo htmlspecialchars($event['nama_event']); ?></h3>
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
                    <div class="event-body">
                        <div class="event-info">
                            <span>📅</span>
                            <span><?php echo date('d F Y', strtotime($event['tanggal'])); ?></span>
                        </div>
                        <div class="event-info">
                            <span>🕐</span>
                            <span><?php echo date('H:i', strtotime($event['waktu'])); ?> WIB</span>
                        </div>
                        <div class="event-info">
                            <span>📍</span>
                            <span><?php echo htmlspecialchars($event['lokasi']); ?></span>
                        </div>
                        <div class="event-info">
                            <span>👥</span>
                            <span><?php echo htmlspecialchars($event['penyelenggara']); ?></span>
                        </div>
                        
                        <?php if ($event['deskripsi']): ?>
                        <div class="event-description">
                            <?php 
                            $desc = htmlspecialchars($event['deskripsi']);
                            echo strlen($desc) > 100 ? substr($desc, 0, 100) . '...' : $desc;
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <a href="view_event.php?id=<?php echo $event['id']; ?>" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
