<?php require 'inc/header.php'; ?>
<section class="hero" data-animate>
  <div>
    <div class="eyebrow">PROMO BULAN INI</div>
    <h1>Performa & Perawatan Mobilmu, Lebih Premium</h1>
    <p class="muted">Diskon khusus untuk oli dan busi berkualitas — pas untuk penggemar otomotif.</p>
    <div class="hero-actions">
      <a class="cta" href="products.php">Jelajahi Promo</a>
      <a class="btn" href="products.php" style="margin-left:10px">Lihat Semua Produk</a>
    </div>
  </div>
  <div class="hero-visual"><img src="assets/img/demo/hero-car.svg" alt="hero car" class="car"></div>
</section>

<section class="featured">
  <h2>Produk Unggulan</h2>
  <div class="products-grid">
    <?php
    $res = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
    while($p = $res->fetch_assoc()): ?>
      <div class="card" data-glow tabindex="0" aria-label="Produk: <?php echo htmlspecialchars($p['name']); ?>">
        <div class="img-wrap">
          <?php if($p['stock'] <= 0): ?><span class="badge out">Habis</span><?php elseif($p['stock'] > 0 && $p['stock'] < 5): ?><span class="badge low">Stok terbatas</span><?php endif; ?>
          <a href="product.php?id=<?php echo $p['id']; ?>">
            <img src="assets/img/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
          </a>
          <div class="price-badge">Rp <?php echo number_format($p['price']); ?></div>
        </div>
        <div class="content">
          <h3 class="title"><?php echo htmlspecialchars($p['name']); ?></h3>
          <div class="price-meta" style="display:flex;justify-content:space-between;align-items:center">
            <div class="price">Rp <?php echo number_format($p['price']); ?></div>
            <div class="meta">Stok: <?php echo $p['stock']; ?></div>
          </div>
        </div>
        <div class="card-footer">
          <?php if($p['stock']>0): ?>
            <form method="post" action="cart.php" style="display:flex;gap:8px;align-items:center;width:100%">
              <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
              <input class="qty-input" type="number" name="qty" value="1" min="1" max="<?php echo $p['stock']; ?>">
              <button class="btn btn-primary">Tambah</button>
            </form>
          <?php else: ?>
            <button class="btn" disabled>Habis</button>
          <?php endif; ?>
          <a class="btn" href="product.php?id=<?php echo $p['id']; ?>">Detail</a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php require 'inc/footer.php'; ?>