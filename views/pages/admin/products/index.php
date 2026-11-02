<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h3 class="mb-0">Kelola Produk</h3>
    <a href="/admin/products/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
</div>

<form method="GET" action="/admin/products" class="row g-2 mb-3">
    <div class="col-8 col-md-4">
        <input type="text" name="q" class="form-control" value="<?= e($search) ?>" placeholder="Cari nama / kategori...">
    </div>
    <div class="col-4 col-md-auto">
        <button class="btn btn-outline-secondary">Cari</button>
        <?php if ($search !== ''): ?><a href="/admin/products" class="btn btn-link">Reset</a><?php endif; ?>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th><th>Nama</th><th>Kategori</th>
                    <th class="text-end">Harga</th><th class="text-end">Stok</th><th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= (int) $p['id'] ?></td>
                    <td><?= e($p['name']) ?></td>
                    <td><?= e($p['category_name'] ?? '-') ?></td>
                    <td class="text-end"><?= rupiah($p['price']) ?></td>
                    <td class="text-end">
                        <span class="badge <?= $p['stock'] < 5 ? 'text-bg-warning' : 'text-bg-success' ?>"><?= (int) $p['stock'] ?></span>
                    </td>
                    <td class="text-center text-nowrap">
                        <a href="/admin/products/edit?id=<?= (int) $p['id'] ?>" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form method="POST" action="/admin/products/delete" class="d-inline"
                              data-confirm="Hapus produk &quot;<?= e($p['name']) ?>&quot;? Tindakan ini tidak bisa dibatalkan.">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$products): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada produk.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">Total: <?= count($products) ?> produk</div>
</div>
