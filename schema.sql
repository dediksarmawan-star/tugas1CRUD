CREATE DATABASE mahasiswa_crud;
USE mahasiswa_crud;

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) UNIQUE NOT NULL,
  nama VARCHAR(100) NOT NULL,
  prodi VARCHAR(50) NOT NULL,
  angkatan INT NOT NULL,
  foto VARCHAR(255),
  status ENUM('aktif','nonaktif') DEFAULT 'aktif'
);
