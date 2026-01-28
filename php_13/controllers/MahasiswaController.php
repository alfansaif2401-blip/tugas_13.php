<?php
/**
 * Controller Mahasiswa
 * Menangani logika dan routing untuk data mahasiswa
 */

require_once 'models/Mahasiswa.php';

class MahasiswaController {
    private $model;
    
    public function __construct() {
        $this->model = new Mahasiswa();
    }
    
    /**
     * Tampilkan halaman list mahasiswa
     */
    public function index() {
        // Ambil parameter dari URL
        $page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $filterJurusan = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';
        
        // Hitung offset
        $start = ($page - 1) * $limit;
        
        // Ambil data mahasiswa
        $dataMahasiswa = $this->model->getMahasiswaPagination($start, $limit, $search, $filterJurusan);
        
        // Hitung total data
        $totalData = $this->model->countMahasiswa($search, $filterJurusan);
        $totalPages = ceil($totalData / $limit);
        
        // Ambil statistik
        $statistik = $this->model->getStatistik();
        
        // Ambil data jurusan untuk filter
        $dataJurusan = $this->model->getAllJurusan();
        
        // Data untuk view
        $data = [
            'mahasiswa' => $dataMahasiswa,
            'statistik' => $statistik,
            'jurusan' => $dataJurusan,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalData' => $totalData,
            'limit' => $limit,
            'search' => $search,
            'filterJurusan' => $filterJurusan
        ];
        
        // Load view
        include 'views/mahasiswa/list.php';
    }
    
    /**
     * Tampilkan detail mahasiswa
     */
    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            header('Location: index.php?page=mahasiswa');
            exit;
        }
        
        $mahasiswa = $this->model->getMahasiswaById($id);
        
        if (!$mahasiswa) {
            header('Location: index.php?page=mahasiswa');
            exit;
        }
        
        $data = [
            'mahasiswa' => $mahasiswa
        ];
        
        // Load view
        include 'views/mahasiswa/detail.php';
    }
    
    /**
     * Handle request routing
     */
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        switch($action) {
            case 'detail':
                $this->detail();
                break;
            case 'index':
            default:
                $this->index();
                break;
        }
    }
}

// Jalankan controller
$controller = new MahasiswaController();
$controller->handleRequest();