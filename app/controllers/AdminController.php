<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class AdminController
{
    public function dashboard(): void
    {
        $product = new Product(db());
        render('admin/dashboard', [
            'title'      => 'Dashboard Admin - My Store',
            'stats'      => $product->stats(),
            'categories' => (new Category(db()))->count(),
            'latest'     => $product->latest(5),
        ], 'admin');
    }
}
