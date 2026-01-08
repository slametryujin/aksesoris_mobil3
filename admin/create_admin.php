<?php require_once __DIR__ . '/../config.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!isset($_POST['csrf_token']) || !verify_csrf($_POST['csrf_token'])){ die('Invalid CSRF token'); }
  $username = esc($_POST['username']);
  $password = $_POST['password'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO admins (username,password) VALUES (?,?)");
  $stmt->bind_param('ss',$username,$hash);
  if($stmt->execute()){ set_flash('Admin berhasil dibuat'); header('Location: login.php'); exit; } else $msg = 'Gagal: '.$conn->error;
}
?>
<?php include __DIR__ . '/../inc/header.php'; ?>
<h2>Buat Admin</h2>
<?php if(isset($msg)) echo '<p>'.$msg.'</p>'; ?>
<form method="post" class="form">
  <?php csrf_input(); ?>
  <label>Username<input type="text" name="username" required></label>
  <label>Password<input type="password" name="password" required></label>
  <button class="btn">Buat Admin</button>
</form>
<?php include __DIR__ . '/../inc/footer.php'; ?>