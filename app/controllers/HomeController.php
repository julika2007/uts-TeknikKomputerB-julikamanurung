<?php
require_once __DIR__ . '/../models/Product.php';

class HomeController
{
    public function index(): void
    {
        $products = (new Product(db()))->latest(8);
        render('home', ['title' => 'Home - My Store', 'products' => $products]);
    }
}
