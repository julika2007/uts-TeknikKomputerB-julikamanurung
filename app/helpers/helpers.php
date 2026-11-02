<?php
define('BASE_PATH', dirname(__DIR__, 2));
define('VIEW_PATH', BASE_PATH . '/views');

function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $c = require BASE_PATH . '/config/database.php';
        $dsn = "mysql:host={$c['host']};dbname={$c['dbname']};charset={$c['charset']}";
        $pdo = new PDO($dsn, $c['user'], $c['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

function rupiah($n): string
{
    return 'Rp ' . number_format((float) $n, 0, ',', '.');
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): void
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        exit('Token keamanan (CSRF) tidak valid. Silakan kembali dan muat ulang halaman.');
    }
}

// Flash message: flash('success', 'teks') untuk set, flash('success') untuk ambil sekali.
function flash(string $key, ?string $msg = null)
{
    if ($msg !== null) {
        $_SESSION['flash'][$key] = $msg;
        return null;
    }
    $m = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $m;
}

// Render halaman: view dibungkus layout (pola ob_start dari modul praktikum).
function render(string $page, array $data = [], string $layout = 'main'): void
{
    extract($data);
    ob_start();
    require VIEW_PATH . "/pages/$page.php";
    $content = ob_get_clean();
    require VIEW_PATH . "/layouts/$layout.php";
}
