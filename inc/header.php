<?php require_once __DIR__ . '/../config.php'; ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Toko Aksesoris Mobil</title>
  <link rel="stylesheet" href="/aksesoris_mobil2/assets/css/style.css">
  <link rel="stylesheet" href="/aksesoris_mobil2/assets/css/theme.css">
  <link rel="stylesheet" href="/aksesoris_mobil2/assets/css/premium-theme.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="theme-premium">
<header class="site-header">
  <div class="navbar container">
    <div class="brand"><a href="/aksesoris_mobil2/" class="logo">Aks<span class="accent">Mobil</span></a></div>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">☰</button>
    <nav class="mobile-nav" id="mainNav">
      <a href="/aksesoris_mobil2/">Home</a>
      <a href="/aksesoris_mobil2/products.php">Produk</a>
      <a href="/aksesoris_mobil2/about.php">Tentang</a>
      <a href="/aksesoris_mobil2/contact.php">Kontak</a>
    </nav>
    <div class="search">
      <form method="get" action="/aksesoris_mobil2/products.php" style="display:flex;align-items:center;width:100%">
        <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/><circle cx="11.5" cy="11.5" r="5.5" stroke="currentColor" stroke-width="1.5"/></svg>
        <input name="q" type="text" placeholder="Cari oli, busi, aksesori..." value="<?php echo isset($_GET['q'])?htmlspecialchars($_GET['q']):''; ?>" />
      </form>
    </div>
    <div class="icons" style="display:flex;align-items:center;gap:12px">
      <?php if(isset($_SESSION['admin'])): ?>
        <a href="/aksesoris_mobil2/admin/dashboard.php" class="btn admin" title="Dashboard Admin">Admin: <?php echo htmlspecialchars($_SESSION['admin']['username']); ?></a>
        <a href="/aksesoris_mobil2/admin/logout.php" class="btn">Logout Admin</a>
      <?php else: ?>
        <a href="/aksesoris_mobil2/admin/login.php" class="btn admin">Admin Login</a>
      <?php endif; ?>

      <?php if(isset($_SESSION['user'])): ?>
        <a href="/aksesoris_mobil2/account.php" class="btn">Akun</a>
      <?php else: ?>
        <a href="/aksesoris_mobil2/login.php" class="btn">Masuk</a>
      <?php endif; ?>

      <a href="/aksesoris_mobil2/cart.php" class="cart" aria-label="Keranjang">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M6 6h14l-1.5 9h-11z"/><circle cx="10" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
        <span class="cart-badge"><?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0; ?></span>
      </a>
    </div>
  </div>
</header>
<?php if(isset($_SESSION['msg'])){ echo '<p class="error">'.$_SESSION['msg'].'</p>'; unset($_SESSION['msg']); } if(function_exists('get_flash')){ $f = get_flash(); if($f) echo '<p class="success">'.htmlspecialchars($f).'</p>'; } ?>
<main class="container">