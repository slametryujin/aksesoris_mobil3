<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }
$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>
<?php include __DIR__ . '/../inc/header.php'; ?>
<h2>Pesanan</h2>
<table class="admin-table"><thead><tr><th>ID</th><th>Pelanggan</th><th>Total</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
<?php while($o = $orders->fetch_assoc()): ?>
  <tr>
    <td><?php echo $o['id']; ?></td>
    <td><?php echo htmlspecialchars($o['customer']); ?></td>
    <td>Rp <?php echo number_format($o['total']); ?></td>
    <td><?php echo $o['created_at']; ?></td>
    <td><a href="view_order.php?id=<?php echo $o['id']; ?>">Lihat</a></td>
  </tr>
<?php endwhile; ?>
</tbody></table>
<?php include __DIR__ . '/../inc/footer.php'; ?>