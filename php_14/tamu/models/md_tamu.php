<?php
require_once BASE_PATH . '/config/database.php';

class Md_tamu
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM tamu ORDER BY id DESC");
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tamu WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function store($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO tamu (nama, alamat) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $data['nama'], $data['alamat']);
        return $stmt->execute();
    }

    public function update($data)
    {
        $stmt = $this->db->prepare(
            "UPDATE tamu SET nama=?, alamat=? WHERE id=?"
        );
        $stmt->bind_param("ssi", $data['nama'], $data['alamat'], $data['id']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tamu WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}