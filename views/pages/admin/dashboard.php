<h3 class="mb-4">Dashboard Admin</h3>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-primary text-white">
            <i class="bi bi-box-seam"></i>
            <div><div class="stat-num"><?= (int) $stats['total'] ?></div>Total Produk</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-success text-white">
            <i class="bi bi-stack"></i>
            <div><div class="stat-num"><?= (int) $stats['total_stock'] ?></div>Total Stok</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-warning text-dark">
            <i class="bi bi-exclamation-triangle"></i>
            <div><div class="stat-num"><?= (int) $stats['low_stock'] ?></div>Stok &lt; 5</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-info text-dark">
            <i class="bi bi-tags"></i>
            <div><div class="stat-num"><?= (int) $categories ?></div>Kategori</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>5 Produk Terbaru</strong>
        <a href="/admin/products/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Nama</th><th>Kategori</th><th class="text-end">Harga</th><th class="text-end">Stok</th></tr>
            </thead>
            <tbody>
            <?php foreach ($latest as $p): ?>
                <tr>
                    <td><?= (int) $p['id'] ?></td>
                    <td><?= e($p['name']) ?></td>
                    <td><?= e($p['category_name'] ?? '-') ?></td>
                    <td class="text-end"><?= rupiah($p['price']) ?></td>
                    <td class="text-end"><?= (int) $p['stock'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
