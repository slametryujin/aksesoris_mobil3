<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }

// handle delete (via POST with CSRF)
if(isset($_POST['delete'])){
  if(!isset($_POST['csrf_token']) || !verify_csrf($_POST['csrf_token'])){ set_flash('Invalid request'); header('Location: products.php'); exit; }
  $id=(int)$_POST['delete']; $conn->query("DELETE FROM products WHERE id=$id"); set_flash('Produk dihapus'); header('Location: products.php'); exit;
}

$rows = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<?php include __DIR__ . '/../inc/header.php'; ?>
<h2>Produk</h2>
<p><a href="product_form.php" class="btn">Tambah Produk</a></p>
<table class="admin-table"><thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead><tbody>
<?php while($r = $rows->fetch_assoc()): ?>
  <tr>
    <td><?php echo $r['id']; ?></td>
    <td><?php echo $r['name']; ?></td>
    <td>Rp <?php echo number_format($r['price']); ?></td>
    <td><?php echo $r['stock']; ?></td>
    <td><a href="product_form.php?id=<?php echo $r['id']; ?>">Edit</a> | <form method="post" style="display:inline" onsubmit="return confirm('Hapus?')"><?php csrf_input(); ?><input type="hidden" name="delete" value="<?php echo $r['id']; ?>"><button class="btn light small" type="submit">Hapus</button></form></td>
  </tr>
<?php endwhile; ?>
</tbody></table>
<?php include __DIR__ . '/../inc/footer.php'; ?>