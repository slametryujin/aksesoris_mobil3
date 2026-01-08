<?php require 'inc/header.php'; ?>
<section class="hero">
  <div class="hero-inner">
    <h1>Promo Bulan Ini: Oli & Busi Diskon 20%</h1>
    <p>Perawatan terbaik untuk mobil Anda — kualitas dan harga bersaing.</p>
    <a href="products.php" class="btn">Lihat Produk</a>
  </div>
</section>

<section class="featured">
  <h2>Produk Unggulan</h2>
  <div class="grid">
    <?php
    $res = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
    while($p = $res->fetch_assoc()): ?>
      <div class="card">
        <div class="badge-wrap">
          <?php if($p['stock'] <= 0): ?><span class="badge out">Habis</span><?php elseif($p['stock'] > 0 && $p['stock'] < 5): ?><span class="badge low">Stok terbatas</span><?php endif; ?>
          <a href="product.php?id=<?php echo $p['id']; ?>">
            <img src="assets/img/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
          </a>
        </div>
        <p class="price">Rp <?php echo number_format($p['price']); ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php require 'inc/footer.php'; ?>