<?php $path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Admin') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
<div class="admin-wrapper">
    <aside class="sidebar">
        <div class="sidebar-brand"><i class="bi bi-shop"></i> My Store</div>
        <nav class="nav flex-column">
            <a class="nav-link <?= $path === '/admin' ? 'active' : '' ?>" href="/admin">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link <?= str_starts_with($path, '/admin/products') ? 'active' : '' ?>" href="/admin/products">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <a class="nav-link" href="/" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Toko
            </a>
        </nav>
    </aside>

    <div class="content-area">
        <div class="topbar">
            <span class="text-muted">Halo, <strong><?= e($_SESSION['username'] ?? 'admin') ?></strong></span>
            <form method="POST" action="/logout" class="m-0">
                <?= csrf_field() ?>
                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>
        <main class="p-3 p-md-4">
            <?php require __DIR__ . '/../components/flash.php'; ?>
            <?= $content ?>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
