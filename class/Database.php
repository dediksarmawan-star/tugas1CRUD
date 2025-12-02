<?php
class Database {
    public $connection;

    public function __construct() {
        $this->openConnection();
    }

    private function openConnection() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $this->connection = new PDO($dsn, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Gagal koneksi: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        $this->connection = null;
    }

    public function runQuery($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params) ? $stmt : false;
    }
}
