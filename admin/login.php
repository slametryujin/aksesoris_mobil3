<?php require_once __DIR__ . '/../config.php';
if(isset($_POST['username'])){
  if(!isset($_POST['csrf_token']) || !verify_csrf($_POST['csrf_token'])){ $err = 'Invalid request'; }
  else {
    $u = esc($_POST['username']);
    $p = $_POST['password'];
    $r = $conn->query("SELECT * FROM admins WHERE username='$u' LIMIT 1");
    if($r->num_rows){ $adm = $r->fetch_assoc(); if(password_verify($p,$adm['password'])){ $_SESSION['admin'] = $adm; header('Location: dashboard.php'); exit; }}
    $err = 'Login gagal';
  }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Login</title><link rel="stylesheet" href="/aksesoris_mobil2/assets/css/style.css"></head><body>
<div class="admin-login container">
  <h2>Login Admin</h2>
  <?php if(isset($err)) echo '<p class="error">'.$err.'</p>'; ?>
  <form method="post">
    <?php csrf_input(); ?>
    <label>Username<input type="text" name="username" required></label>
    <label>Password<input type="password" name="password" required></label>
    <button class="btn">Login</button>
  </form>
</div>
</body></html> 