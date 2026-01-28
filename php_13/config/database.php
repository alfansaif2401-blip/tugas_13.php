<?php
/**
 * Database Configuration
 * Koneksi Database menggunakan PDO dengan Singleton Pattern
 */

class Database {
    private static $instance = null;
    private $connection;
    
    // Konfigurasi Database
    private $host = 'localhost';
    private $db_name = 'db_sistamik';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    
    // Private constructor untuk Singleton
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }
    
    // Method untuk mendapatkan instance (Singleton Pattern)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    // Method untuk mendapatkan koneksi
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevent cloning
    private function __clone() {}
    
    // Prevent unserializing
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}