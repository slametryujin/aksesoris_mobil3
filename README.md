# Toko Aksesoris Mobil (HTML/CSS/PHP + MySQL)

Sebuah contoh aplikasi toko online sederhana (assets, oli, busi, aki, dll) menggunakan HTML, CSS, dan PHP native dengan MySQL.

## Struktur Folder

- assets/
  - css/style.css
  - js/main.js
  - img/ (letakkan gambar produk di sini)
- inc/
  - header.php
  - footer.php
- admin/
  - login.php
  - dashboard.php
  - products.php
  - product_form.php
  - orders.php
  - view_order.php
  - create_admin.php
  - logout.php
- db/
  - schema.sql
- config.php
- home.php, products.php, product.php, cart.php, checkout.php, contact.php, about.php
- index.php

## Database

1. Import `db/schema.sql` ke MySQL (phpMyAdmin atau CLI):
   - Pastikan create database dijalankan: `CREATE DATABASE IF NOT EXISTS aksesoris_db;` atau biarkan file SQL mengurusnya.
2. Setelah import, jalankan `admin/create_admin.php` pada browser dan buat akun admin (username + password). Ini menyimpan password yang sudah di-hash.

## Konfigurasi

- Buka `config.php` dan sesuaikan parameter DB (`$DB_HOST`, `$DB_USER`, `$DB_PASS`, `$DB_NAME`).

## Menjalankan Lokally

- Gunakan XAMPP (Windows). Letakkan folder `aksesoris_mobil2` di `htdocs`.
- Buka `http://localhost/aksesoris_mobil2/` pada browser.

## Catatan Deploy

- GitHub Pages tidak mendukung PHP; gunakan Git untuk version control saja.
- Untuk menjalankan secara online, pilih hosting yang mendukung PHP & MySQL (mis. 000webhost, Hostinger, shared host lain).

## Fitur Singkat

- User: Home (banner), List Produk, Detail Produk, Keranjang, Checkout sederhana, Kontak, Tentang
- Admin: Login, Dashboard, CRUD Produk, Manajemen Pesanan

## Desain

- Sistem warna: hitam, abu-abu, merah (modern otomotif)
- Font: Inter (Google Fonts)

## Penjelasan singkat tiap halaman

- `home.php`: Banner promo, featured products
- `products.php`: Menampilkan semua produk, form tambah ke keranjang
- `product.php`: Detail produk, deskripsi, stok, tombol tambah ke keranjang
- `cart.php`: Melihat isi keranjang, update qty, clear, checkout
- `checkout.php`: Form data pelanggan dan penyimpanan pesanan (orders + order_items)
- `contact.php` / `about.php`: Informasi toko
- `admin/*`: Halaman administrasi (login, manage produk, lihat pesanan)

---

Perubahan & fitur tambahan yang sudah diterapkan:
- Validasi stok server-side saat tambah ke keranjang dan saat checkout
- Checkout dibungkus dalam transaksi DB untuk konsistensi
- CSRF token sederhana untuk form admin (create/edit/delete)
- Flash messages (sukses/error) untuk aksi admin
- Pencarian produk dan pagination di `products.php`
- Sanitasi output (`htmlspecialchars`) untuk mencegah XSS
- Desain UI ditingkatkan: gaya premium automotive, tombol estetis, badge stok, responsive nav, glassmorphism, dan perbaikan visual (lihat `assets/css/theme.css`).
- Ditambahkan gambar produk vektor (SVG) di `assets/img/` (oli.svg, busi.svg, filter.svg, aki.svg, karpet.svg), hero banner (`assets/img/hero-banner.svg`), dan hero car (`assets/img/hero-car.svg`).
- Design mockup & preview: `design/mockup.html` (component preview) and `DESIGN.md` with design tokens and guidance. Also see the live style guide: `design/style-guide.html` (uses `assets/css/styles.min.css`).
- QA checklist (`QA_CHECKLIST.md`) dan placeholder screenshot ada di `assets/img/screenshots/`.
- Ditambahkan folder untuk upload gambar: `assets/img/uploads/` dan perbaikan upload pada `admin/product_form.php` (penamaan aman, size/type checks, simpan ke `uploads/`).

Tips untuk menambahkan gambar produk nyata:
1. Login ke `admin/login.php` → buka `Admin / Produk` → `Tambah / Edit Produk`.
2. Gunakan form `Gambar` untuk upload file JPG/PNG/SVG (maks 3MB). File akan disimpan di `assets/img/uploads/`.
3. Jika ingin menukar semua placeholder dengan foto asli, unggah foto dengan nama yang mudah dikenali lalu edit produk untuk menunjuk ke file tersebut.

Rekomendasi berikutnya: integrasi upload yang lebih lengkap (thumbnailing via GD/Imagick), CSRF lebih lengkap, pagination UI, integrasi pembayaran dummy.

Jika Anda ingin saya lanjutkan dengan pengujian manual penuh, penambahan fitur (filter/kategori), atau polishing UI, beri tahu pilihan Anda.

Smoke test & screenshots:
- Jalankan smoke test (CLI): `php tools/smoke_test.php http://localhost/aksesoris_mobil2` untuk memeriksa endpoint dasar.
- Ambil screenshot manual dengan Chrome DevTools (Desktop & Mobile) dan simpan ke `assets/img/screenshots/` menggantikan placeholder.

Pilihan selanjutnya (pilih salah satu):
1. Saya jalankan Smoke Test & kirim hasilnya (Anda perlu menjalankan perintah lokal dan paste output di sini). ✅
2. Anda upload foto produk yang ingin dipakai (saya integrasikan dan periksa ukuran/penamaan). 🖼️
3. Saya tambahkan sample JPG/PNG foto produk demo untuk Anda lihat langsung. 📸

Tuliskan pilihan Anda.