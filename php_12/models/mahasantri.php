<?php
class Mahasantri {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAll() {
        $sql = "
            SELECT 
                m.nis,
                m.nama,
                j.nama_jurusan,
                m.tempat_lahir,
                m.tanggal_lahir
            FROM mahasantri m
            JOIN jurusan j ON m.id_jurusan = j.id_jurusan
            ORDER BY m.nama ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
