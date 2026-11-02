<?php
require_once __DIR__ . '/../models/Product.php';

// Halaman publik: daftar produk untuk pengunjung.
class ProductController
{
    public function index(): void
    {
        $search = trim($_GET['q'] ?? '');
        $products = (new Product(db()))->all($search);
        render('products/index', [
            'title' => 'Produk - My Store',
            'products' => $products,
            'search' => $search,
        ]);
    }
}
