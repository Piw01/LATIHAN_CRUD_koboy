<?php
namespace src\model;

require_once __DIR__ . '/../config/Connection.php';

use src\config\Connection;
use PDO;

class MahasiswaModel {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByNim($nim) {
        $query = "SELECT * FROM mahasiswa WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertData($data) {
        $query = "INSERT INTO mahasiswa (nim, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, telepon, alamat) 
                  VALUES (:nim, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :telepon, :alamat)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function updateData($data) {
        $query = "UPDATE mahasiswa SET 
                  nama = :nama, 
                  tempat_lahir = :tempat_lahir, 
                  tanggal_lahir = :tanggal_lahir, 
                  jenis_kelamin = :jenis_kelamin, 
                  telepon = :telepon, 
                  alamat = :alamat 
                  WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteData($nim) {
        $query = "DELETE FROM mahasiswa WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);
        return $stmt->execute();
    }
}