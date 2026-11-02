-- My Store - database UTS Praktek Pemrograman Web 2
-- Import file ini lewat phpMyAdmin (tab Import) atau: mysql -u root < database/database.sql

DROP DATABASE IF EXISTS mvc_mystore;
CREATE DATABASE mvc_mystore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mvc_mystore;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category_id INT NULL,
  price DECIMAL(15,2) NOT NULL DEFAULT 0,
  stock INT NOT NULL DEFAULT 0,
  description TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_products_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO categories (name) VALUES
('Laptop'),
('Mouse'),
('Keyboard'),
('Monitor'),
('Aksesoris');

INSERT INTO products (name, category_id, price, stock, description) VALUES
('Laptop Lenovo IdeaPad Slim 3', 1, 7500000, 8, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Laptop ASUS VivoBook 14', 1, 8250000, 6, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Laptop Acer Aspire 5', 1, 7900000, 5, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Laptop HP 14s', 1, 6950000, 4, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Laptop Dell Inspiron 15', 1, 9800000, 3, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Laptop MSI Modern 14', 1, 10500000, 2, 'Laptop untuk kebutuhan kuliah dan kerja harian.'),
('Mouse Logitech M170', 2, 120000, 40, 'Mouse nyaman dan responsif.'),
('Mouse Logitech G102', 2, 250000, 25, 'Mouse nyaman dan responsif.'),
('Mouse Rexus Xierra X9', 2, 175000, 18, 'Mouse nyaman dan responsif.'),
('Mouse Wireless Fantech WG10', 2, 135000, 22, 'Mouse nyaman dan responsif.'),
('Mouse Razer DeathAdder Essential', 2, 420000, 9, 'Mouse nyaman dan responsif.'),
('Keyboard Mechanical Rexus Daxa', 3, 850000, 12, 'Keyboard untuk mengetik dan gaming.'),
('Keyboard Logitech K120', 3, 150000, 30, 'Keyboard untuk mengetik dan gaming.'),
('Keyboard Wireless Logitech K380', 3, 520000, 14, 'Keyboard untuk mengetik dan gaming.'),
('Keyboard Gaming Fantech MK884', 3, 480000, 10, 'Keyboard untuk mengetik dan gaming.'),
('Keyboard Redragon Kumara K552', 3, 590000, 7, 'Keyboard untuk mengetik dan gaming.'),
('Monitor LG 24 inch IPS', 4, 1850000, 9, 'Monitor dengan warna tajam.'),
('Monitor Samsung 27 inch Curved', 4, 2650000, 5, 'Monitor dengan warna tajam.'),
('Monitor AOC 22 inch', 4, 1350000, 11, 'Monitor dengan warna tajam.'),
('Monitor Dell 24 inch P2422H', 4, 2950000, 3, 'Monitor dengan warna tajam.'),
('Flashdisk Sandisk 64GB', 5, 85000, 60, 'Aksesoris pendukung perangkat komputer.'),
('Headset Gaming Rexus HX1', 5, 320000, 16, 'Aksesoris pendukung perangkat komputer.'),
('Webcam Logitech C270', 5, 450000, 13, 'Aksesoris pendukung perangkat komputer.'),
('Hub USB 4 Port', 5, 65000, 35, 'Aksesoris pendukung perangkat komputer.'),
('Mousepad Gaming XL', 5, 75000, 45, 'Aksesoris pendukung perangkat komputer.'),
('Kabel HDMI 2 Meter', 5, 55000, 50, 'Aksesoris pendukung perangkat komputer.'),
('Laptop Stand Aluminium', 5, 185000, 20, 'Aksesoris pendukung perangkat komputer.'),
('Speaker Bluetooth JBL Go 3', 5, 550000, 8, 'Aksesoris pendukung perangkat komputer.'),
('SSD Kingston 480GB', 5, 520000, 4, 'Aksesoris pendukung perangkat komputer.'),
('Tas Laptop 14 inch', 5, 175000, 2, 'Aksesoris pendukung perangkat komputer.');

-- Akun admin. Username: admin | Password: admin123 (disimpan sebagai hash, bukan plaintext)
INSERT INTO users (username, password) VALUES
('admin', '$6$abcdefghijklmnop$3pm2jX0VbSznjYaMgtxsUnC/HOVhk6SBYQ5G5lJRcYuH9mZ4PCqZAZHKYlVXVZ57RreC7.8QH54XLEM9aIcdi0');
