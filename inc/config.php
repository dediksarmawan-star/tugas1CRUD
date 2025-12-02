<?php
// konfigurasi database
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'mahasiswa_crud';

// autoload class otomatis
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

// menu navigasi
const NAV_PAGES = [
    ['title' => 'Home',      'url' => 'index.php'],
    ['title' => 'Mahasiswa', 'url' => 'members.php'],
    ['title' => 'Tambah',    'url' => 'create.php']
];
