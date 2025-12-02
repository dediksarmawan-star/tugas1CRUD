<?php require __DIR__ . '/inc/config.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Daftar Mahasiswa</title></head>
<body>
<header><h1>Data Mahasiswa</h1></header>
<?php Utility::tampilMenu(); ?>
<main>
<?php
$m = new Mahasiswa();
$list = $m->semuaData();
?>
<table border="1">
<tr>
  <th>ID</th><th>NIM</th><th>Nama</th><th>Prodi</th><th>Angkatan</th><th>Status</th><th>Foto</th><th>Aksi</th>
</tr>
<?php foreach ($list as $row): ?>
<tr>
  <td><?= Utility::esc($row['id']) ?></td>
  <td><?= Utility::esc($row['nim']) ?></td>
  <td><?= Utility::esc($row['nama']) ?></td>
  <td><?= Utility::esc($row['prodi']) ?></td>
  <td><?= Utility::esc($row['angkatan']) ?></td>
  <td><?= Utility::esc($row['status']) ?></td>
  <td><?= $row['foto'] ? "<a href='".Utility::esc($row['foto'])."' target='_blank'>Lihat</a>" : '-' ?></td>
  <td>
    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Delete</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
</main>
</body>
</html>
