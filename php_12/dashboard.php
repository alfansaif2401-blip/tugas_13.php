<?php
// Data Mockup Enterprise
$stats = [
    ['label' => 'Total Mahasiswa', 'value' => 1250, 'trend' => '+12%', 'color' => '#6366f1', 'icon' => '👥'],
    ['label' => 'Mahasiswa Aktif', 'value' => 1100, 'trend' => '+5%', 'color' => '#10b981', 'icon' => '✅'],
    ['label' => 'Lulus Tahun Ini', 'value' => 120, 'trend' => '+24%', 'color' => '#8b5cf6', 'icon' => '🎓'],
    ['label' => 'Pengajuan Cuti', 'value' => 30, 'trend' => '-2%', 'color' => '#f59e0b', 'icon' => '⏳'],
];

$fakultas = ["Teknik", "Ekonomi", "Hukum", "Kedokteran", "FISIP"];
$dataFakultas = [420, 300, 180, 220, 130];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UNIV-CORE | Enterprise Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --bg-body: #f1f5f9;
            --sidebar-bg: #ffffff;
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-primary: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            --accent: #6366f1;
            --shadow-premium: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -4px rgba(0,0,0,0.05);
        }

        body.dark {
            --bg-body: #020617;
            --sidebar-bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.8);
            --text-primary: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(51, 65, 85, 0.5);
            --shadow-premium: 0 20px 25px -5px rgba(0,0,0,0.4);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; transition: background 0.3s, color 0.3s, border 0.3s; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.4rem;
            background: linear-gradient(to right, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-group { display: flex; flex-direction: column; gap: 8px; }
        
        .nav-link {
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent);
        }

        /* MAIN CONTENT */
        .content { 
            flex: 1;
            padding: 2rem; 
            margin-left: 280px; /* Offset for desktop sidebar */
            width: 100%;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* STATS CARD */
        .stats-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 24px;
            box-shadow: var(--shadow-premium);
        }

        .stat-card:hover { transform: translateY(-5px); }

        .trend-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 20px;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            font-weight: 700;
        }

        /* CHARTS SECTION */
        .grid-charts {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 1.5rem;
        }

        .chart-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 30px;
            box-shadow: var(--shadow-premium);
            min-height: 350px;
        }

        .btn-premium {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .theme-switch {
            width: 45px; height: 45px;
            border-radius: 50%;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            cursor: pointer;
            display: grid; place-items: center;
        }

        /* MOBILE RESPONSIVE UPDATES */
        @media (max-width: 1024px) {
            .grid-charts { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); width: 250px; }
            .sidebar.active { transform: translateX(0); }
            .content { margin-left: 0; padding: 1.5rem; }
            .mobile-header { display: flex !important; align-items: center; gap: 15px; margin-bottom: 20px; }
            .stats-wrapper { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 480px) {
            .stats-wrapper { grid-template-columns: 1fr; }
            .top-bar { justify-content: center; text-align: center; }
        }

        .mobile-header { display: none; }
        .menu-btn { font-size: 1.5rem; cursor: pointer; background: none; border: none; color: var(--text-primary); }
    </style>
</head>
<body>

<div class="app-container">
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <svg width="35" height="35" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="8" fill="#6366F1"/>
                <path d="M20 10L30 15L20 20L10 15L20 10Z" fill="white"/>
                <path d="M10 20L20 25L30 20" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <path d="M10 25L20 30L30 25" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span>UNIV-CORE</span>
        </div>
        
        <nav class="nav-group">
            <small style="color: var(--text-muted); text-transform: uppercase; font-size: 0.65rem; letter-spacing: 1.2px; margin-bottom: 5px;">Navigation</small>
            <a href="#" class="nav-link active">📊 Dashboard</a>
            <a href="#" class="nav-link">👥 Mahasiswa</a>
            <a href="#" class="nav-link">🏢 Fakultas</a>
            <a href="#" class="nav-link">⚙️ Pengaturan</a>
        </nav>

        <div style="margin-top: auto;">
            <button class="btn-premium" style="width: 100%;" onclick="openModal()">+ Add New</button>
        </div>
    </aside>

    <main class="content">
        <div class="mobile-header">
            <button class="menu-btn" onclick="toggleSidebar()">☰</button>
            <span style="font-weight: 800;">UNIV-CORE</span>
        </div>

        <div class="top-bar">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px;">Analytics Overview</h1>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Monitoring data real-time universitas</p>
            </div>
            <div style="display: flex; gap: 15px; align-items: center;">
                <button class="theme-switch" onclick="toggleTheme()">🌓</button>
                <div style="text-align: right; display: block;">
                    <p style="font-weight: 700; font-size: 0.9rem;">Administrator</p>
                    <p style="font-size: 0.75rem; color: #10b981;">● Active Now</p>
                </div>
            </div>
        </div>

        <div class="stats-wrapper">
            <?php foreach($stats as $s): ?>
            <div class="stat-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span style="font-size: 1.2rem; background: rgba(0,0,0,0.05); padding: 8px; border-radius: 12px;"><?= $s['icon'] ?></span>
                    <span class="trend-badge"><?= $s['trend'] ?></span>
                </div>
                <p style="color: var(--text-muted); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;"><?= $s['label'] ?></p>
                <h2 style="font-size: 1.8rem; font-weight: 800; margin-top: 5px;"><?= number_format($s['value']) ?></h2>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="grid-charts">
            <div class="chart-container">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; align-items: center;">
                    <h3 style="font-size: 1.1rem; font-weight: 700;">Populasi per Fakultas</h3>
                    <select style="background: var(--bg-body); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 8px; padding: 6px 12px; font-size: 0.8rem;">
                        <option>2026</option>
                        <option>2025</option>
                    </select>
                </div>
                <div style="position: relative; height: 280px;">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
            
            <div class="chart-container" style="display: flex; flex-direction: column; align-items: center;">
                <h3 style="margin-bottom: 1.5rem; align-self: flex-start; font-size: 1.1rem; font-weight: 700;">Target Kelulusan</h3>
                <div style="position: relative; width: 100%; max-width: 220px;">
                    <canvas id="doughnutChart"></canvas>
                </div>
                <div style="margin-top: 1.5rem; text-align: center;">
                    <p style="font-weight: 800; font-size: 1.4rem; color: var(--accent);">85%</p>
                    <p style="color: var(--text-muted); font-size: 0.8rem; font-weight: 600;">On track to annual goal</p>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Sidebar Toggle for Mobile
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
    }

    // Theme Logic
    function toggleTheme() {
        document.body.classList.toggle('dark');
        localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    }

    if(localStorage.getItem('theme') === 'dark') document.body.classList.add('dark');

    // Chart Configuration
    const ctxBar = document.getElementById('mainChart').getContext('2d');
    const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');

    const gradient = ctxBar.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, '#6366f1');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.1)');

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: <?= json_encode($fakultas) ?>,
            datasets: [{
                data: <?= json_encode($dataFakultas) ?>,
                backgroundColor: gradient,
                borderRadius: 8,
                hoverBackgroundColor: '#a855f7'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { display: true, grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Cuti', 'Lulus'],
            datasets: [{
                data: [1100, 30, 120],
                backgroundColor: ['#6366f1', '#f59e0b', '#10b981'],
                borderWidth: 0,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15, font: { size: 11, family: 'Plus Jakarta Sans' } } } }
        }
    });

    function openModal() {
        Swal.fire({
            title: 'Input Data Baru',
            html: `
                <input id="swal-input1" class="swal2-input" placeholder="Nama Mahasiswa" style="font-family: 'Plus Jakarta Sans'">
                <select id="swal-input2" class="swal2-input" style="font-family: 'Plus Jakarta Sans'">
                    <option value="Teknik">Teknik</option>
                    <option value="Ekonomi">Ekonomi</option>
                </select>
            `,
            confirmButtonText: 'Simpan Data',
            background: document.body.classList.contains('dark') ? '#1e293b' : '#fff',
            color: document.body.classList.contains('dark') ? '#fff' : '#000',
            confirmButtonColor: '#6366f1'
        });
    }

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', (e) => {
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.querySelector('.menu-btn');
        if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });
</script>

</body>
</html>