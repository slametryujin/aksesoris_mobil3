<?php require 'inc/header.php'; ?>
<h2>Semua Produk</h2>
<form method="get" class="form" style="margin-bottom:12px">
  <input type="text" name="q" placeholder="Cari produk..." value="<?php echo isset($_GET['q'])?htmlspecialchars($_GET['q']):''; ?>">
  <button class="btn">Cari</button>
</form>
<?php
$q = isset($_GET['q']) ? esc($_GET['q']) : '';
$page = max(1,(int)($_GET['page'] ?? 1));
$perPage = 12; $offset = ($page-1)*$perPage;
if($q){
  $like = "%$q%";
  $stmt = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM products WHERE name LIKE ? OR description LIKE ? LIMIT ?,?");
  $stmt->bind_param('ssii',$like,$like,$offset,$perPage);
  $stmt->execute(); $res = $stmt->get_result();
  $total = $conn->query("SELECT FOUND_ROWS() as cnt")->fetch_assoc()['cnt'];
} else {
  $stmt = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM products LIMIT ?,?");
  $stmt->bind_param('ii',$offset,$perPage);
  $stmt->execute(); $res = $stmt->get_result();
  $total = $conn->query("SELECT FOUND_ROWS() as cnt")->fetch_assoc()['cnt'];
}
$pages = max(1,ceil($total/$perPage));
?>
<div class="products-grid">
  <?php while($p = $res->fetch_assoc()): ?>
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
<?php if($pages>1): ?>
  <div class="pagination">
    <?php for($i=1;$i<=$pages;$i++): ?>
      <a class="btn light" href="products.php?q=<?php echo urlencode($q); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
<?php endif; ?>
<?php require 'inc/footer.php'; ?>