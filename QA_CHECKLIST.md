# QA Checklist — Toko Aksesoris Mobil

Tujuan: memastikan fungsionalitas inti dan tampilan bekerja di staging/local sebelum deploy.

1. Instalasi & konfigurasi
   - Import `db/schema.sql` ke MySQL
   - Sesuaikan `config.php` (DB params)
   - Buat admin lewat `admin/create_admin.php`

2. Halaman Publik
   - [x] Home: hero banner ditampilkan, produk unggulan muncul (4 item) — (static check OK)
   - [x] Produk: daftar produk, badge stok (Habis / Stok terbatas) — (static check OK)
   - [x] Detail Produk: gambar, deskripsi, stok, tombol tambah ke keranjang — (static check OK)
   - [ ] Responsiveness: cek di mobile (≤ 768px) dan desktop — (manual)

3. Keranjang & Checkout
   - [ ] Tambah item ke keranjang, update qty, hapus, kosongkan — (manual)
   - [x] Validation: tidak menambahkan lebih dari stok — (server-side checks implemented)
   - [x] Checkout: buat pesanan, cek `orders` dan `order_items`, pastikan stok berkurang — (transaction & stock checks implemented, manual verify recommended)

4. Admin
   - [x] Login admin — (static check OK)
   - [x] CRUD produk (tambah/edit/hapus) dengan CSRF token — (CSRF + flash implemented, manual verify recommended)
   - [x] Lihat pesanan dan detail pesanan — (static: pages present)

5. Keamanan & Validasi
   - [x] CSRF token pada form admin — (implemented)
   - [x] Sanitasi output (XSS) — (htmlspecialchars used across views)
   - [x] Batas ukuran dan tipe file saat upload — (upload checks implemented, max 3MB)

6. Visual / UI
   - [x] Hero banner (desktop + mobile) — (hero banner updated, manual verify required on device)
   - [x] Produk menampilkan gambar yang benar — (sample SVG images provided)
   - [x] Typografi responsif (h1/h2 scaling) — (clamp() used)

7. Screenshots (ambil saat semua OK)
   - `assets/img/screenshots/screenshot_home.svg` (placeholder dibuat)
   - `assets/img/screenshots/screenshot_products.svg`
   - `assets/img/screenshots/screenshot_cart.svg`
   - `assets/img/screenshots/screenshot_admin_dashboard.svg`

Run automated smoke test (CLI):
- `php tools/smoke_test.php http://localhost/aksesoris_mobil2`
- Review output and fix HTTP errors if any.

Manual verification steps (recommended):
- Follow QA items marked (manual) and capture screenshots at desktop and mobile sizes (Chrome DevTools device toolbar). Save to `assets/img/screenshots/` and replace placeholders.


---

Tips: gunakan Chrome device toolbar untuk memeriksa responsivitas dan Lighthouse untuk audit perf/accessibility.