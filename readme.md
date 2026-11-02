# My Store — UTS Praktek Pemrograman Web 2

Aplikasi toko sederhana berbasis **PHP Native + MySQL/MariaDB (tanpa framework)** dengan pola **MVC**.
Project ini melanjutkan praktikum "MVC Dasar" dan menambahkan **Login Admin** serta **CRUD Produk** di dashboard admin.

| | |
|---|---|
| Nama | _isi nama kamu_ |
| NIM | _isi NIM kamu_ |
| Prodi / Kelas | Teknik Komputer — Semester III (Group B) |
| Dosen | Primatua Sitompul, M.Kom |

## Fitur

- **Halaman publik**: Home (8 produk terbaru) dan daftar produk dengan pencarian.
- **Login Admin** berbasis UI (Bootstrap 5), password diverifikasi dengan `password_verify()`.
- **Dashboard Admin** (setelah login berhasil diarahkan ke `/admin`): statistik total produk, total stok, stok menipis (< 5), jumlah kategori, dan 5 produk terbaru.
- **CRUD Produk**:
  - **Create** — tambah produk baru (`/admin/products/create`)
  - **Update** — edit produk yang sudah ada (`/admin/products/edit?id=..`)
  - **Delete** — hapus produk discontinued, dengan konfirmasi sebelum menghapus
  - **Read** — daftar produk + pencarian nama/kategori
- **30 data dummy produk** (laptop, mouse, keyboard, monitor, aksesoris) dan 5 kategori.
- **Keamanan dasar**: prepared statement PDO (anti SQL injection), `htmlspecialchars` (anti XSS), token CSRF pada semua form POST, `session_regenerate_id()` saat login, middleware autentikasi untuk semua URL `/admin*`, validasi input di server.

## Teknologi

PHP 8.0+ (memakai `str_starts_with`), MySQL/MariaDB, PDO, Bootstrap 5 + Bootstrap Icons (via CDN, butuh internet saat menjalankan), custom CSS.

## Struktur Folder

```
uts-<prodi>-<namakamu>/
├── app/
│   ├── controllers/   HomeController, ProductController, AuthController,
│   │                  AdminController, AdminProductController
│   ├── models/        Product, Category, User
│   ├── middleware/    AuthMiddleware
│   └── helpers/       helpers.php (db, render, csrf, flash, rupiah)
├── config/            database.php
├── database/          database.sql, create_admin.php
├── views/
│   ├── layouts/       main.php, admin.php, auth.php
│   ├── components/    header, navbar, footer, flash
│   └── pages/         home, products, auth/login, admin/dashboard, admin/products/*
├── public/            index.php (entry point + router), css/, js/
├── screenshoot/       bukti screenshot hasil pekerjaan
└── storage/
```

## Alur Aplikasi

```
Browser → public/index.php (router) → Middleware (khusus /admin*) → Controller → Model → Database
                                                     ↓
                                     View (page) dibungkus Layout → Browser
```

## Daftar Route

| Method | URL | Keterangan |
|---|---|---|
| GET | `/` | Home |
| GET | `/products` | Daftar produk (publik) |
| GET/POST | `/login` | Form & proses login |
| GET/POST | `/logout` | Logout |
| GET | `/admin` | Dashboard admin 🔒 |
| GET | `/admin/products` | Daftar & cari produk 🔒 |
| GET | `/admin/products/create` | Form tambah 🔒 |
| POST | `/admin/products/store` | Simpan produk baru 🔒 |
| GET | `/admin/products/edit?id=` | Form edit 🔒 |
| POST | `/admin/products/update` | Simpan perubahan 🔒 |
| POST | `/admin/products/delete` | Hapus produk 🔒 |

🔒 = wajib login (dijaga `AuthMiddleware`).

## Struktur Database (`mvc_mystore`)

- `categories` (id, name)
- `products` (id, name, category_id → categories.id, price, stock, description, created_at)
- `users` (id, username, password[hash])

## Cara Menjalankan

1. Pastikan PHP 8+ dan MySQL/MariaDB (XAMPP/Laragon) aktif.
2. **Import database**: buka phpMyAdmin → tab *Import* → pilih `database/database.sql`
   (atau `mysql -u root < database/database.sql`).
3. Sesuaikan `config/database.php` bila user/password MySQL berbeda.
4. Jalankan server dari folder project:
   ```
   php -S localhost:8000 -t public
   ```
5. Buka <http://localhost:8000>, lalu login di <http://localhost:8000/login>.

**Akun admin:** username `admin` · password `admin123`

> Jika ingin mengganti/reset password admin: `php database/create_admin.php admin passwordBaru`

## Screenshot

Lihat folder [`screenshoot/`](screenshoot/): login, dashboard, daftar produk, create, update, delete, dan data di database.
