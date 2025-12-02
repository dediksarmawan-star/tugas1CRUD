<?php
class Database {
    public $conn;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function disconnect() {
        $this->conn = null;
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($params)) {
            return $stmt;
        }
        return false;
    }
}
