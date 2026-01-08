<?php require 'inc/header.php';

// Handle add/update/remove actions
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $pid = (int)$_POST['product_id'];
  $qty = (int)$_POST['qty'];
  if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
  // fetch product
  $r = $conn->query("SELECT * FROM products WHERE id=$pid");
  $prod = $r->fetch_assoc();
  if($prod){
    if($qty <= 0) { unset($_SESSION['cart'][$pid]); }
    else {
      // server-side stock validation
      if($prod['stock'] <= 0){ $_SESSION['msg'] = 'Produk habis stok'; unset($_SESSION['cart'][$pid]); }
      else {
        if($qty > $prod['stock']){ $qty = $prod['stock']; $_SESSION['msg'] = 'Jumlah disesuaikan dengan stok yang tersedia'; }
        $_SESSION['cart'][$pid] = ['id'=>$pid,'name'=>$prod['name'],'price'=>$prod['price'],'qty'=>$qty];
      }
    }
  }
  header('Location: cart.php'); exit;
}

// Handle clear or checkout redirect
if(isset($_GET['clear'])){ unset($_SESSION['cart']); header('Location: cart.php'); exit; }

$items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotal = 0;
foreach($items as $it) $subtotal += $it['price'] * $it['qty'];
?>
<h2>Keranjang Belanja</h2>
<?php if(empty($items)): ?>
  <p>Keranjang kosong. <a href="products.php">Belanja sekarang</a></p>
<?php else: ?>
  <table class="cart-table">
    <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
    <tbody>
      <?php foreach($items as $it): ?>
        <tr>
          <td><?php echo htmlspecialchars($it['name']); ?></td>
          <td>Rp <?php echo number_format($it['price']); ?></td>
          <td>
            <form method="post" style="display:inline-block">
              <input type="hidden" name="product_id" value="<?php echo $it['id']; ?>">
              <input type="number" name="qty" value="<?php echo $it['qty']; ?>" min="0">
              <button class="btn small">Update</button>
            </form>
          </td>
          <td>Rp <?php echo number_format($it['price']*$it['qty']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p class="cart-total">Total: <strong>Rp <?php echo number_format($subtotal); ?></strong></p>
  <a href="checkout.php" class="btn">Checkout</a>
  <a href="?clear=1" class="btn light">Kosongkan</a>
<?php endif; ?>

<?php require 'inc/footer.php'; ?>