<nav class="site-nav">
    <a href="/">Home</a>
    <a href="/products">Produk</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/admin">Dashboard Admin</a>
        <a href="/logout">Logout</a>
    <?php else: ?>
        <a href="/login">Login Admin</a>
    <?php endif; ?>
</nav>
