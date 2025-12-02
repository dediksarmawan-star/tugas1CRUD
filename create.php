<?php require __DIR__ . '/inc/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <h1>Form Tambah Mahasiswa</h1>
</header>
<?php Utility::tampilMenu(); ?>
<main>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nim      = trim($_POST['nim'] ?? '');
    $nama     = trim($_POST['nama'] ?? '');
    $prodi    = $_POST['prodi'] ?? '';
    $angkatan = (int)($_POST['angkatan'] ?? 0);
    $status   = $_POST['status'] ?? '';

    $allowedProdi  = ['TI','SI','MI','TE'];
    $allowedStatus = ['aktif','nonaktif'];

    $errors = [];

    // Validasi dasar
    if ($nim === '' || strlen($nim) > 20) {
        $errors[] = "NIM wajib diisi dan maksimal 20 karakter.";
    }
    if ($nama === '' || strlen($nama) > 100) {
        $errors[] = "Nama wajib diisi dan maksimal 100 karakter.";
    }
    if (!Utility::validPilihan($prodi, $allowedProdi)) {
        $errors[] = "Prodi tidak sesuai.";
    }
    if ($angkatan < 2000) {
        $errors[] = "Angkatan minimal tahun 2000.";
    }
    if (!Utility::validPilihan($status, $allowedStatus)) {
        $errors[] = "Status tidak sesuai.";
    }

    // Upload foto (opsional)
    $fotoPath = null;
    if (!empty($_FILES['foto']['name'])) {
        try {
            $fotoPath = Utility::uploadFoto('foto');
        } catch (RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }

    // Jika tidak ada error, simpan ke DB
    if (empty($errors)) {
        $m = new Mahasiswa();
        $sukses = $m->tambah($nim, $nama, $prodi, $angkatan, $fotoPath, $status);
        if ($sukses) {
            echo "<p>Data berhasil ditambahkan. <a href='members.php'>Lihat daftar</a></p>";
        } else {
            echo "<p>Terjadi kesalahan saat menyimpan data.</p>";
        }
    } else {
        echo "<ul>";
        foreach ($errors as $err) {
            echo "<li>" . Utility::esc($err) . "</li>";
        }
        echo "</ul>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
  <div class="row">
    <label for="nim">NIM</label>
    <input type="text" id="nim" name="nim" maxlength="20" required>
  </div>
  <div class="row">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" maxlength="100" required>
  </div>
  <div class="row">
    <label for="prodi">Prodi</label>
    <select id="prodi" name="prodi" required>
      <?php Utility::opsiSelect(['TI','SI','MI','TE']); ?>
    </select>
  </div>
  <div class="row">
    <label for="angkatan">Angkatan</label>
    <input type="number" id="angkatan" name="angkatan" min="2000" required>
  </div>
  <div class="row">
    <label for="foto">Foto (JPG/PNG, maks 2MB)</label>
    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png">
  </div>
  <div class="row">
    <label for="status">Status</label>
    <select id="status" name="status" required>
      <?php Utility::opsiSelect(['aktif','nonaktif']); ?>
    </select>
  </div>
  <div class="row">
    <button type="submit">Simpan</button>
  </div>
</form>
</main>
</body>
</html>
