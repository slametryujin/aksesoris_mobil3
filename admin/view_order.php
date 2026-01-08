<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }
$id = (int)$_GET['id'];
$oR = $conn->query("SELECT * FROM orders WHERE id=$id"); $o = $oR->fetch_assoc();
$items = $conn->query("SELECT oi.*, p.name FROM order_items oi JOIN products p ON p.id=oi.product_id WHERE oi.order_id=$id");
include __DIR__ . '/../inc/header.php'; ?>
<h2>Detail Pesanan #<?php echo $id; ?></h2>
<p>Pelanggan: <?php echo htmlspecialchars($o['customer']); ?> | Telp: <?php echo htmlspecialchars($o['phone']); ?></p>
<p>Alamat: <?php echo nl2br(htmlspecialchars($o['address'])); ?></p>
<table class="admin-table"><thead><tr><th>Produk</th><th>Harga</th><th>Qty</th></tr></thead><tbody>
<?php while($it = $items->fetch_assoc()): ?>
  <tr><td><?php echo $it['name']; ?></td><td>Rp <?php echo number_format($it['price']); ?></td><td><?php echo $it['qty']; ?></td></tr>
<?php endwhile; ?>
</tbody></table>
<p>Total: Rp <?php echo number_format($o['total']); ?></p>
<?php include __DIR__ . '/../inc/footer.php'; ?>