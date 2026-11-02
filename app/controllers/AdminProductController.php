<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class AdminProductController
{
    private Product $products;
    private Category $categories;

    public function __construct()
    {
        $this->products   = new Product(db());
        $this->categories = new Category(db());
    }

    // READ: daftar produk
    public function index(): void
    {
        $search = trim($_GET['q'] ?? '');
        render('admin/products/index', [
            'title'    => 'Kelola Produk - Admin',
            'products' => $this->products->all($search),
            'search'   => $search,
        ], 'admin');
    }

    // CREATE: form
    public function create(): void
    {
        $this->form('Tambah Produk Baru', '/admin/products/store',
            ['id' => '', 'name' => '', 'category_id' => '', 'price' => '', 'stock' => '', 'description' => ''], []);
    }

    // CREATE: simpan
    public function store(): void
    {
        csrf_verify();
        [$data, $errors] = $this->validated();

        if ($errors) {
            $this->form('Tambah Produk Baru', '/admin/products/store', $data, $errors);
            return;
        }

        $this->products->create($data);
        flash('success', 'Produk "' . $data['name'] . '" berhasil ditambahkan.');
        redirect('/admin/products');
    }

    // UPDATE: form
    public function edit(): void
    {
        $product = $this->findOr404((int) ($_GET['id'] ?? 0));
        $this->form('Edit Produk', '/admin/products/update', $product, []);
    }

    // UPDATE: simpan
    public function update(): void
    {
        csrf_verify();
        $existing = $this->findOr404((int) ($_POST['id'] ?? 0));
        [$data, $errors] = $this->validated();
        $data['id'] = $existing['id'];

        if ($errors) {
            $this->form('Edit Produk', '/admin/products/update', $data, $errors);
            return;
        }

        $this->products->update((int) $existing['id'], $data);
        flash('success', 'Produk "' . $data['name'] . '" berhasil diperbarui.');
        redirect('/admin/products');
    }

    // DELETE
    public function destroy(): void
    {
        csrf_verify();
        $product = $this->findOr404((int) ($_POST['id'] ?? 0));
        $this->products->delete((int) $product['id']);
        flash('success', 'Produk "' . $product['name'] . '" berhasil dihapus.');
        redirect('/admin/products');
    }

    private function form(string $heading, string $action, array $product, array $errors): void
    {
        render('admin/products/form', [
            'title'      => $heading . ' - Admin',
            'heading'    => $heading,
            'action'     => $action,
            'product'    => $product,
            'errors'     => $errors,
            'categories' => $this->categories->all(),
        ], 'admin');
    }

    private function findOr404(int $id): array
    {
        $product = $id > 0 ? $this->products->find($id) : false;
        if (!$product) {
            http_response_code(404);
            render('errors/404', ['title' => '404 - Tidak ditemukan'], 'admin');
            exit;
        }
        return $product;
    }

    // Validasi input form -> [data bersih, daftar error]
    private function validated(): array
    {
        $name  = trim($_POST['name'] ?? '');
        $cat   = trim($_POST['category_id'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $stock = trim($_POST['stock'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Nama produk wajib diisi.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'Nama produk maksimal 100 karakter.';
        }

        if ($price === '' || !is_numeric($price) || (float) $price < 0) {
            $errors['price'] = 'Harga harus berupa angka 0 atau lebih.';
        }

        if ($stock === '' || filter_var($stock, FILTER_VALIDATE_INT) === false || (int) $stock < 0) {
            $errors['stock'] = 'Stok harus berupa bilangan bulat 0 atau lebih.';
        }

        $categoryId = null;
        if ($cat !== '') {
            if (ctype_digit($cat) && $this->categories->exists((int) $cat)) {
                $categoryId = (int) $cat;
            } else {
                $errors['category_id'] = 'Kategori tidak valid.';
            }
        }

        if ($errors) {
            // kembalikan input mentah supaya form terisi ulang
            return [[
                'name' => $name, 'category_id' => $cat, 'price' => $price,
                'stock' => $stock, 'description' => $desc,
            ], $errors];
        }

        return [[
            'name' => $name, 'category_id' => $categoryId, 'price' => $price,
            'stock' => (int) $stock, 'description' => $desc,
        ], []];
    }
}
