<?php
class Mahasiswa {
    public $nim;
    public $nama;
    public $prodi;
    public $angkatan;
    public $foto;
    public $status;

    protected $id;
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function semuaData() {
        $sql = "SELECT * FROM mahasiswa ORDER BY id ASC";
        $stmt = $this->db->runQuery($sql);
        return $stmt ? $stmt->fetchAll() : [];
    }

    public function cariById($id) {
        $sql = "SELECT * FROM mahasiswa WHERE id = :id LIMIT 1";
        $stmt = $this->db->runQuery($sql, ['id' => $id]);
        return $stmt ? $stmt->fetch() : null;
    }

    public function tambah($nim, $nama, $prodi, $angkatan, $foto, $status) {
        $sql = "INSERT INTO mahasiswa (nim, nama, prodi, angkatan, foto, status)
                VALUES (:nim, :nama, :prodi, :angkatan, :foto, :status)";
        return $this->db->runQuery($sql, compact('nim','nama','prodi','angkatan','foto','status'));
    }

    public function ubah($id, $nama, $prodi, $angkatan, $foto, $status) {
        $sql = "UPDATE mahasiswa SET nama=:nama, prodi=:prodi, angkatan=:angkatan,
                foto=:foto, status=:status WHERE id=:id";
        return $this->db->runQuery($sql, compact('id','nama','prodi','angkatan','foto','status'));
    }

    public function hapus($id) {
        $sql = "DELETE FROM mahasiswa WHERE id=:id";
        return $this->db->runQuery($sql, ['id' => $id]);
    }
}
