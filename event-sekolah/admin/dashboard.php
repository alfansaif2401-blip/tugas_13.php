<?php
session_start();
require_once '../config.php';

// Cek login dan role
if (!is_logged_in() || !is_admin()) {
    redirect('../index.php');
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
    <title>Dashboard Admin - Event Sekolah</title>
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
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h2 {
            font-size: 20px;
            color: #333;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f8f9fa;
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #555;
        }
        
        tbody tr:hover {
            background: #f8f9fa;
        }
        
        .badge {
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
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🎓 Sistem Manajemen Event Sekolah</h1>
        <div class="user-info">
            <span>Halo, <strong><?php echo $_SESSION['nama']; ?></strong> (Admin)</span>
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>
    
    <div class="container">
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
        
        <div class="card">
            <div class="card-header">
                <h2>Daftar Event</h2>
                <a href="add_event.php" class="btn btn-primary">+ Tambah Event</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Penyelenggara</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    mysqli_data_seek($events, 0);
                    while ($event = mysqli_fetch_assoc($events)): 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo $event['nama_event']; ?></strong></td>
                        <td><?php echo date('d/m/Y', strtotime($event['tanggal'])); ?></td>
                        <td><?php echo date('H:i', strtotime($event['waktu'])); ?></td>
                        <td><?php echo $event['lokasi']; ?></td>
                        <td><?php echo $event['penyelenggara']; ?></td>
                        <td>
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
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="view_event.php?id=<?php echo $event['id']; ?>" class="btn btn-success btn-sm">Lihat</a>
                                <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_event.php?id=<?php echo $event['id']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus event ini?')" 
                                   class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
