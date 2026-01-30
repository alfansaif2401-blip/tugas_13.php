<?php
class Database
{
    private static $conn;

    public static function connect()
    {
        if (!self::$conn) {
            self::$conn = new mysqli('localhost', 'root', '', 'db_tamu');
            if (self::$conn->connect_error) {
                die('Koneksi gagal');
            }
        }
        return self::$conn;
    }
}