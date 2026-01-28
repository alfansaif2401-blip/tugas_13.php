<?php
class Dashboard {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function totalMahasantri() {
        return $this->db->query(
            "SELECT COUNT(*) FROM mahasantri"
        )->fetchColumn();
    }

    public function totalDosenIT() {
        return $this->db->query(
            "SELECT COUNT(*) FROM dosen WHERE jenis_dosen='IT'"
        )->fetchColumn();
    }

    public function totalDosenDiniyah() {
        return $this->db->query(
            "SELECT COUNT(*) FROM dosen WHERE jenis_dosen='Diniyah'"
        )->fetchColumn();
    }

    public function totalMataKuliah() {
        return $this->db->query(
            "SELECT COUNT(*) FROM mata_kuliah"
        )->fetchColumn();
    }
}
