<h2>Selamat Datang di My Store</h2>
<p>Toko perangkat komputer dan aksesoris. Berikut produk terbaru kami.</p>

<section>
    <h3>Produk Terbaru</h3>
    <div class="grid">
        <?php foreach ($products as $p): ?>
            <div class="card">
                <small><?= e($p['category_name'] ?? 'Tanpa kategori') ?></small>
                <h4><?= e($p['name']) ?></h4>
                <p class="price"><?= rupiah($p['price']) ?></p>
                <p>Stok: <?= (int) $p['stock'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <p><a href="/products">Lihat semua produk &raquo;</a></p>
</section>
