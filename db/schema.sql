-- Database schema for Aksesoris Mobil
CREATE DATABASE IF NOT EXISTS aksesoris_db; USE aksesoris_db;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  description TEXT,
  image VARCHAR(255) DEFAULT 'placeholder.png'
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer VARCHAR(255),
  phone VARCHAR(50),
  address TEXT,
  total INT,
  created_at DATETIME
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT NULL,
  price INT,
  qty INT,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

-- Sample products
INSERT INTO products (name,price,stock,description,image) VALUES
('Oli Mesin 1L',70000,50,'Oli mesin berkualitas untuk performa optimal.','oli.svg'),
('Busi NGK',50000,100,'Busi premium untuk pembakaran lebih baik.','busi.svg'),
('Filter Oli',45000,60,'Filter oli berkualitas untuk mesin bersih.','filter.svg'),
('Aki Kering 45Ah',550000,20,'Aki kering bebas perawatan, cocok untuk mobil kecil.','aki.svg'),
('Karpet Mobil',120000,40,'Karpet tahan lama dan mudah dibersihkan.','karpet.svg');

-- NOTE: Create an admin account using the provided PHP helper `admin/create_admin.php` (it will insert a hashed password). Do NOT store plaintext passwords.
