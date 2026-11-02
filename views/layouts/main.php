<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'My Store') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php require __DIR__ . '/../components/header.php'; ?>
    <?php require __DIR__ . '/../components/navbar.php'; ?>
    <main class="container">
        <?= $content ?>
    </main>
    <?php require __DIR__ . '/../components/footer.php'; ?>
    <script src="/js/app.js"></script>
</body>
</html>
