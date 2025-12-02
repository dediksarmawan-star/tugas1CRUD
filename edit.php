<?php require __DIR__ . '/inc/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <h1>Form Edit Mahasiswa</h1>
</header>
<?php Utility::tampilMenu(); ?>
<main>
<?php
$id = (int)($_GET['id'] ?? 0);
$m  = new Mahasiswa();
$data = $m->cariById($id);

if (!$data) {
    echo "<p>Data tidak ditemukan. <a href='members.php'>Kembali</a></p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $prodi    = $_POST['prodi'] ?? '';
    $angkatan = (int)($_POST['angkatan'] ?? 0);
    $status   = $_POST['status'] ?? '';

    $errors = [];

    if ($nama === '' || strlen($nama) > 100) $errors[] = "Nama tidak valid.";
    if (!Utility::validPilihan($prodi, ['TI','SI','MI','TE'])) $errors[] = "Prodi salah.";
    if ($angkatan < 2000) $errors[] = "Angkatan minimal 2000.";
    if (!Utility::validPilihan($status, ['aktif','nonaktif'])) $errors[] = "Status salah.";

    $fotoPath = $data['foto'] ?? null;
    if (!empty($_FILES['foto']['name'])) {
        try {
            $fotoPath = Utility::uploadFoto('foto');
        } catch (RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }

    if (empty($errors)) {
        $ok = $m->ubah($id, $nama, $prodi, $angkatan, $fotoPath, $status);
        if ($ok) {
            echo "<p>Data berhasil diperbarui. <a href='members.php'>Kembali ke daftar</a></p>";
            $data = $m->cariById($id); // refresh data
        } else {
            echo "<p>Terjadi kesalahan saat update.</p>";
        }
    } else {
        echo "<ul>";
        foreach ($errors as $err) echo "<li>" . Utility::esc($err) . "</li>";
        echo "</ul>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
  <div class="row">
    <label>ID</label>
    <input type="text" value="<?= Utility::esc($data['id']) ?>" disabled>
  </div>
  <div class="row">
    <label>NIM</label>
    <input type="text" value="<?= Utility::esc($data['nim']) ?>" disabled>
  </div>
  <div class="row">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" value="<?= Utility::esc($data['nama']) ?>" required>
  </div>
  <div class="row">
    <label for="prodi">Prodi</label>
    <select id="prodi" name="prodi">
      <?php Utility::opsiSelect(['TI','SI','MI','TE'], $data['prodi']); ?>
    </select>
  </div>
  <div class="row">
    <label for="angkatan">Angkatan</label>
    <input type="number" id="angkatan" name="angkatan" min="2000" value="<?= Utility::esc($data['angkatan']) ?>" required>
  </div>
  <div class="row">
    <label for="foto">Foto</label>
    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png">
    <?php if ($data['foto']): ?>
      <p>File saat ini: <a href="<?= Utility::esc($data['foto']) ?>" target="_blank">Lihat</a></p>
    <?php endif; ?>
  </div>
  <div class="row">
    <label for="status">Status</label>
    <select id="status" name="status">
      <?php Utility::opsiSelect(['aktif','nonaktif'], $data['status']); ?>
    </select>
  </div>
  <div class="row">
    <button type="submit">Update</button>
  </div>
</form>
</main>
</body>
</html>
