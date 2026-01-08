<?php require 'inc/header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = $conn->query("SELECT * FROM products WHERE id=$id");
$p = $res->fetch_assoc();
if(!$p){ echo '<p>Produk tidak ditemukan.</p>'; require 'inc/footer.php'; exit; }
?>
<div class="product-detail">
  <div class="badge-wrap">
    <?php if($p['stock'] <= 0): ?><span class="badge out">Habis</span><?php elseif($p['stock'] > 0 && $p['stock'] < 5): ?><span class="badge low">Stok terbatas</span><?php endif; ?>
    <div class="img-wrap"><img src="assets/img/<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>"></div>
  </div>
  <div class="prod-info">
    <h2><?php echo htmlspecialchars($p['name']); ?></h2>
    <p class="price">Rp <?php echo number_format($p['price']); ?></p>
    <p class="meta">Stok: <?php echo $p['stock']; ?></p>
    <p><?php echo nl2br(htmlspecialchars($p['description'])); ?></p>
    <form method="post" action="cart.php">
      <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
      <input type="number" name="qty" value="1" min="1" max="<?php echo $p['stock']; ?>">
      <button class="btn btn-primary">Tambah ke Keranjang</button>
    </form>
  </div>
</div>
<?php require 'inc/footer.php'; ?>