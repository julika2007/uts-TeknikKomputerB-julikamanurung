<h3 class="mb-3"><?= e($heading) ?></h3>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= e($action) ?>" novalidate>
            <?= csrf_field() ?>
            <?php if (!empty($product['id'])): ?>
                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label" for="name">Nama Produk</label>
                <input type="text" id="name" name="name" maxlength="100"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= e($product['name']) ?>">
                <div class="invalid-feedback"><?= e($errors['name'] ?? '') ?></div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="category_id">Kategori</label>
                <select id="category_id" name="category_id"
                        class="form-select <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>">
                    <option value="">-- Tanpa kategori --</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= (int) $c['id'] ?>" <?= (string) $product['category_id'] === (string) $c['id'] ? 'selected' : '' ?>>
                            <?= e($c['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= e($errors['category_id'] ?? '') ?></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" min="0" step="1"
                           class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                           value="<?= e($product['price']) ?>">
                    <div class="invalid-feedback"><?= e($errors['price'] ?? '') ?></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" min="0" step="1"
                           class="form-control <?= isset($errors['stock']) ? 'is-invalid' : '' ?>"
                           value="<?= e($product['stock']) ?>">
                    <div class="invalid-feedback"><?= e($errors['stock'] ?? '') ?></div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Deskripsi (opsional)</label>
                <textarea id="description" name="description" rows="3" class="form-control"><?= e($product['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
            <a href="/admin/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
