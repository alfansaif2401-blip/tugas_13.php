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