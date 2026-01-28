<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController {
    public function index() {

        $db = (new Database())->connect();
        $model = new Dashboard($db);

        $data = [
            'mahasantri'     => $model->totalMahasantri(),
            'dosen_it'       => $model->totalDosenIT(),
            'dosen_diniyah'  => $model->totalDosenDiniyah(),
            'mata_kuliah'    => $model->totalMataKuliah()
        ];

        // Panggil VIEW + LAYOUT
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/layout/sidebar.php';
        require_once __DIR__ . '/../views/dashboard.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }
}
