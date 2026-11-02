<?php
session_start();

require_once __DIR__ . '/../app/helpers/helpers.php';
require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/AdminProductController.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri    = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';

// Tabel routing: "METHOD /path" => [Controller, method]
$routes = [
    'GET /'                       => ['HomeController', 'index'],
    'GET /products'               => ['ProductController', 'index'],

    'GET /login'                  => ['AuthController', 'showLogin'],
    'POST /login'                 => ['AuthController', 'login'],
    'GET /logout'                 => ['AuthController', 'logout'],
    'POST /logout'                => ['AuthController', 'logout'],

    'GET /admin'                  => ['AdminController', 'dashboard'],
    'GET /admin/products'         => ['AdminProductController', 'index'],
    'GET /admin/products/create'  => ['AdminProductController', 'create'],
    'POST /admin/products/store'  => ['AdminProductController', 'store'],
    'GET /admin/products/edit'    => ['AdminProductController', 'edit'],
    'POST /admin/products/update' => ['AdminProductController', 'update'],
    'POST /admin/products/delete' => ['AdminProductController', 'destroy'],
];

$key = "$method $uri";

if (!isset($routes[$key])) {
    http_response_code(404);
    render('errors/404', ['title' => '404 - Tidak ditemukan']);
    exit;
}

// Middleware: semua URL /admin* wajib login.
if ($uri === '/admin' || str_starts_with($uri, '/admin/')) {
    AuthMiddleware::handle();
}

[$class, $action] = $routes[$key];
(new $class())->$action();
