<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }
?>
<?php include __DIR__ . '/../inc/header.php'; ?>
<h2>Dashboard Admin</h2>
<ul class="admin-menu">
  <li><a href="products.php">Manajemen Produk</a></li>
  <li><a href="orders.php">Lihat Pesanan</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<?php include __DIR__ . '/../inc/footer.php'; ?>