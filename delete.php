<?php
require __DIR__ . '/inc/config.php';

$id = (int)($_GET['id'] ?? 0);
$m  = new Mahasiswa();
$data = $m->cariById($id);

if (!$data) {
    header('Location: members.php');
    exit;
}

// Jika ingin sekalian hapus file foto dari server (opsional):
// if (!empty($data['foto'])) {
//     $path = __DIR__ . '/' . $data['foto'];
//     if (is_file($path)) @unlink($path);
// }

$m->hapus($id);
header('Location: members.php');
exit;
