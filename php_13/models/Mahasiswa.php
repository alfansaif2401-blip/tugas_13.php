<?php
/**
 * Model Mahasiswa
 * Mengelola semua operasi data mahasiswa
 */

require_once 'config/database.php';

class Mahasiswa {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Ambil semua data mahasiswa dengan informasi jurusan
     */
    public function getAllMahasiswa() {
        $query = "SELECT 
                    m.id_mahasiswa,
                    m.nim,
                    m.nama_lengkap,
                    m.jenis_kelamin,
                    m.tempat_lahir,
                    m.tanggal_lahir,
                    m.alamat,
                    m.no_telepon,
                    m.email,
                    m.angkatan,
                    m.status,
                    m.tanggal_masuk,
                    j.kode_jurusan,
                    j.nama_jurusan
                  FROM mahasiswa m
                  LEFT JOIN jurusan j ON m.id_jurusan = j.id_jurusan
                  ORDER BY m.nim ASC";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return [];
        }
    }
    
    /**
     * Ambil data mahasiswa berdasarkan ID
     */
    public function getMahasiswaById($id) {
        $query = "SELECT 
                    m.*,
                    j.kode_jurusan,
                    j.nama_jurusan,
                    j.ketua_jurusan
                  FROM mahasiswa m
                  LEFT JOIN jurusan j ON m.id_jurusan = j.id_jurusan
                  WHERE m.id_mahasiswa = :id";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            return null;
        }
    }
    
    /**
     * Ambil data mahasiswa dengan pagination
     */
    public function getMahasiswaPagination($start, $limit, $search = '', $jurusan = '') {
        $query = "SELECT 
                    m.id_mahasiswa,
                    m.nim,
                    m.nama_lengkap,
                    m.jenis_kelamin,
                    m.email,
                    m.no_telepon,
                    m.angkatan,
                    m.status,
                    j.kode_jurusan,
                    j.nama_jurusan
                  FROM mahasiswa m
                  LEFT JOIN jurusan j ON m.id_jurusan = j.id_jurusan
                  WHERE 1=1";
        
        // Filter search
        if (!empty($search)) {
            $query .= " AND (m.nim LIKE :search OR m.nama_lengkap LIKE :search)";
        }
        
        // Filter jurusan
        if (!empty($jurusan)) {
            $query .= " AND m.id_jurusan = :jurusan";
        }
        
        $query .= " ORDER BY m.nim ASC LIMIT :start, :limit";
        
        try {
            $stmt = $this->db->prepare($query);
            
            if (!empty($search)) {
                $searchParam = "%{$search}%";
                $stmt->bindParam(':search', $searchParam);
            }
            
            if (!empty($jurusan)) {
                $stmt->bindParam(':jurusan', $jurusan, PDO::PARAM_INT);
            }
            
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return [];
        }
    }
    
    /**
     * Hitung total mahasiswa
     */
    public function countMahasiswa($search = '', $jurusan = '') {
        $query = "SELECT COUNT(*) as total 
                  FROM mahasiswa m
                  WHERE 1=1";
        
        if (!empty($search)) {
            $query .= " AND (m.nim LIKE :search OR m.nama_lengkap LIKE :search)";
        }
        
        if (!empty($jurusan)) {
            $query .= " AND m.id_jurusan = :jurusan";
        }
        
        try {
            $stmt = $this->db->prepare($query);
            
            if (!empty($search)) {
                $searchParam = "%{$search}%";
                $stmt->bindParam(':search', $searchParam);
            }
            
            if (!empty($jurusan)) {
                $stmt->bindParam(':jurusan', $jurusan, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['total'];
        } catch(PDOException $e) {
            return 0;
        }
    }
    
    /**
     * Ambil statistik mahasiswa
     */
    public function getStatistik() {
        $query = "SELECT 
                    COUNT(*) as total_mahasiswa,
                    SUM(CASE WHEN status = 'Aktif' THEN 1 ELSE 0 END) as mahasiswa_aktif,
                    SUM(CASE WHEN j.kode_jurusan = 'PPL' THEN 1 ELSE 0 END) as mahasiswa_ppl,
                    SUM(CASE WHEN j.kode_jurusan = 'DM' THEN 1 ELSE 0 END) as mahasiswa_dm
                  FROM mahasiswa m
                  LEFT JOIN jurusan j ON m.id_jurusan = j.id_jurusan";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            return [
                'total_mahasiswa' => 0,
                'mahasiswa_aktif' => 0,
                'mahasiswa_ppl' => 0,
                'mahasiswa_dm' => 0
            ];
        }
    }
    
    /**
     * Ambil semua jurusan untuk dropdown filter
     */
    public function getAllJurusan() {
        $query = "SELECT id_jurusan, kode_jurusan, nama_jurusan 
                  FROM jurusan 
                  ORDER BY nama_jurusan ASC";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return [];
        }
    }
}