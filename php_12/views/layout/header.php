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
        /* [Copy CSS Anda di sini - Mulai dari :root sampai .menu-btn] */
        :root { --bg-body: #f1f5f9; --sidebar-bg: #ffffff; --card-bg: rgba(255, 255, 255, 0.9); --text-primary: #0f172a; --text-muted: #64748b; --border-color: rgba(226, 232, 240, 0.8); --accent: #6366f1; --shadow-premium: 0 10px 15px -3px rgba(0,0,0,0.05); }
        body.dark { --bg-body: #020617; --sidebar-bg: #0f172a; --card-bg: rgba(30, 41, 59, 0.8); --text-primary: #f8fafc; --text-muted: #94a3b8; --border-color: rgba(51, 65, 85, 0.5); }
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background 0.3s, color 0.3s; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: var(--text-primary); overflow-x: hidden; }
        .app-container { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--sidebar-bg); border-right: 1px solid var(--border-color); padding: 2rem 1.5rem; display: flex; flex-direction: column; gap: 2rem; position: fixed; height: 100vh; z-index: 1000; transition: transform 0.3s ease; }
        .sidebar.active { transform: translateX(0); }
        .content { flex: 1; padding: 2rem; margin-left: 280px; width: 100%; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 20px; }
        .stats-wrapper { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem; }
        .stat-card { background: var(--card-bg); backdrop-filter: blur(10px); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: 24px; box-shadow: var(--shadow-premium); }
        .grid-charts { display: grid; grid-template-columns: 1.6fr 1fr; gap: 1.5rem; }
        .chart-container { background: var(--card-bg); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: 30px; min-height: 350px; }
        .mobile-header { display: none; }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .content { margin-left: 0; } .mobile-header { display: flex !important; align-items: center; gap: 15px; margin-bottom: 20px; } .grid-charts { grid-template-columns: 1fr; } }
        .nav-link { padding: 12px 16px; border-radius: 12px; text-decoration: none; color: var(--text-muted); font-weight: 600; display: flex; align-items: center; gap: 12px; }
        .nav-link.active { background: rgba(99, 102, 241, 0.1); color: var(--accent); }
        .btn-premium { background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; padding: 14px 24px; border-radius: 14px; border: none; font-weight: 700; cursor: pointer; }
        .theme-switch { width: 45px; height: 45px; border-radius: 50%; background: var(--card-bg); border: 1px solid var(--border-color); cursor: pointer; display: grid; place-items: center; }
    </style>
</head>
<body>
<div class="app-container">