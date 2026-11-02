<?php $oldUser = $_SESSION['old_username'] ?? ''; unset($_SESSION['old_username']); ?>
<div class="login-card card shadow">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <div class="login-icon"><i class="bi bi-shop"></i></div>
            <h4 class="mb-0">My Store</h4>
            <small class="text-muted">Login Admin</small>
        </div>

        <?php if ($m = flash('error')): ?>
            <div class="alert alert-danger py-2"><?= e($m) ?></div>
        <?php endif; ?>
        <?php if ($m = flash('success')): ?>
            <div class="alert alert-success py-2"><?= e($m) ?></div>
        <?php endif; ?>

        <form method="POST" action="/login" autocomplete="off">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                       value="<?= e($oldUser) ?>" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3"><a href="/" class="small">&larr; Kembali ke toko</a></div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
