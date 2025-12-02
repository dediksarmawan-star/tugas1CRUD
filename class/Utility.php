<?php
class Utility {
    public static function tampilMenu($pages = NAV_PAGES) {
        echo '<nav><ul>';
        foreach ($pages as $p) {
            $title = htmlspecialchars($p['title'], ENT_QUOTES, 'UTF-8');
            $url   = htmlspecialchars($p['url'], ENT_QUOTES, 'UTF-8');
            echo "<li><a href=\"$url\">$title</a></li>";
        }
        echo '</ul></nav>';
    }

    public static function esc($val) {
        return htmlspecialchars((string)$val, ENT_QUOTES, 'UTF-8');
    }

    public static function opsiSelect($opsi, $selected = null) {
        foreach ($opsi as $o) {
            $sel = ($o === $selected) ? ' selected' : '';
            echo "<option value=\"" . self::esc($o) . "\"$sel>" . self::esc($o) . "</option>";
        }
    }

    public static function validPilihan($val, $allowed) {
        return in_array($val, $allowed, true);
    }

    public static function uploadDir() {
        $dir = __DIR__ . '/../uploads';
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        return $dir;
    }

    public static function uploadFoto($field = 'foto') {
        if (empty($_FILES[$field]['name'])) return null;

        $file = $_FILES[$field];
        $mime = $file['type'];
        $size = $file['size'];

        if (!in_array($mime, ['image/jpeg','image/png'])) {
            throw new RuntimeException('File harus JPG/PNG.');
        }
        if ($size > 2*1024*1024) {
            throw new RuntimeException('Ukuran file maksimal 2MB.');
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = time() . '_' . uniqid() . '.' . strtolower($ext);
        $dest = self::uploadDir() . '/' . $newName;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            throw new RuntimeException('Upload gagal.');
        }
        return 'uploads/' . $newName;
    }
}
