<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController {
    public function index() {

        $db = (new Database())->connect();
        $dashboard = new Dashboard($db);

        $data = [
            'mahasantri'    => $dashboard->totalMahasantri(),
            'dosen_it'      => $dashboard->totalDosenIT(),
            'dosen_diniyah' => $dashboard->totalDosenDiniyah(),
            'mata_kuliah'   => $dashboard->totalMataKuliah()
        ];

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/layout/sidebar.php';
        require_once __DIR__ . '/../views/dashboard.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}
