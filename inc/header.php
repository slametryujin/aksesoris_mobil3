<?php require_once __DIR__ . '/../config.php'; ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Toko Aksesoris Mobil</title>
  <link rel="stylesheet" href="/aksesoris_mobil2/assets/css/style.css">
  <link rel="stylesheet" href="/aksesoris_mobil2/assets/css/theme.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="theme-premium">
<header class="site-header">
  <div class="container header-inner">
    <a href="/aksesoris_mobil2/" class="logo">Aksesoris<span>Mobil</span></a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">☰</button>
    <nav class="main-nav" id="mainNav">
      <a href="/aksesoris_mobil2/">Home</a>
      <a href="/aksesoris_mobil2/products.php">Produk</a>
      <a href="/aksesoris_mobil2/about.php">Tentang</a>
      <a href="/aksesoris_mobil2/contact.php">Kontak</a>
      <a href="/aksesoris_mobil2/cart.php" class="cart-link">Keranjang (<?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0; ?>)</a>
      <div style="margin-top:8px;padding-top:8px;border-top:1px dashed rgba(0,0,0,0.04);">
        <form method="get" action="/aksesoris_mobil2/products.php" style="display:flex;gap:8px;align-items:center">
          <input name="q" type="text" placeholder="Cari produk..." value="<?php echo isset($_GET['q'])?htmlspecialchars($_GET['q']):''; ?>" style="padding:8px 12px;border-radius:999px;border:1px solid #eee">
          <button class="btn light">Cari</button>
        </form>
      </div>
    </nav>
  </div>
</header>
<?php if(isset($_SESSION['msg'])){ echo '<p class="error">'.$_SESSION['msg'].'</p>'; unset($_SESSION['msg']); } if(function_exists('get_flash')){ $f = get_flash(); if($f) echo '<p class="success">'.htmlspecialchars($f).'</p>'; } ?>
<main class="container">