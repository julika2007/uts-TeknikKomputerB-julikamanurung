<h2>Daftar Produk</h2>

<form method="GET" action="/products" class="search">
    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari produk atau kategori...">
    <button type="submit">Cari</button>
</form>

<table class="table-plain">
    <tr>
        <th>No</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th>
    </tr>
    <?php foreach ($products as $i => $p): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= e($p['name']) ?></td>
            <td><?= e($p['category_name'] ?? '-') ?></td>
            <td><?= rupiah($p['price']) ?></td>
            <td><?= (int) $p['stock'] ?></td>
        </tr>
    <?php endforeach; ?>
    <?php if (!$products): ?>
        <tr><td colspan="5">Produk tidak ditemukan.</td></tr>
    <?php endif; ?>
</table>
