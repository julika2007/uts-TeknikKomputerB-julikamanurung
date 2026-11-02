<?php
// Opsional: buat/reset akun admin dengan password_hash() bawaan PHP.
// Pemakaian: php database/create_admin.php admin passwordBaru
require_once __DIR__ . '/../app/helpers/helpers.php';

$username = $argv[1] ?? 'admin';
$password = $argv[2] ?? 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = db()->prepare(
    "INSERT INTO users (username, password) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE password = VALUES(password)"
);
$stmt->execute([$username, $hash]);
echo "Admin '$username' berhasil dibuat/diperbarui.\n";
