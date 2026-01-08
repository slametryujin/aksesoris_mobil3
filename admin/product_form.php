<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id){ $res = $conn->query("SELECT * FROM products WHERE id=$id"); $p = $res->fetch_assoc(); }

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!isset($_POST['csrf_token']) || !verify_csrf($_POST['csrf_token'])){ die('Invalid CSRF token'); }
  $name = esc($_POST['name']); $price = (int)$_POST['price']; $stock = (int)$_POST['stock']; $desc = esc($_POST['description']);
  $image = 'placeholder.png';
  if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
    // improved file checks + safe naming + upload dir
    $allowed = ['image/png','image/jpeg','image/svg+xml'];
    if(!in_array($_FILES['image']['type'],$allowed) || $_FILES['image']['size'] > 3*1024*1024){ die('Gambar tidak valid atau terlalu besar'); }
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $ext = in_array($ext,['png','jpg','jpeg','svg']) ? $ext : 'png';
    $newName = uniqid('img_').'.'.$ext;
    $target = __DIR__.'/../assets/img/uploads/'.$newName;
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
      $image = 'uploads/'.$newName;
      // delete old image if not a placeholder and exists
      if(isset($p['image']) && $p['image'] && $p['image'] !== 'placeholder.png' && file_exists(__DIR__.'/../assets/img/'.basename($p['image']))){ @unlink(__DIR__.'/../assets/img/'.basename($p['image'])); }
    }
  } else if(isset($p['image'])) $image = $p['image'];

  if($id){
    $stmt = $conn->prepare("UPDATE products SET name=?,price=?,stock=?,description=?,image=? WHERE id=?");
    $stmt->bind_param('siissi',$name,$price,$stock,$desc,$image,$id);
    $stmt->execute();
  } else {
    $stmt = $conn->prepare("INSERT INTO products (name,price,stock,description,image) VALUES (?,?,?,?,?)");
    $stmt->bind_param('siiss',$name,$price,$stock,$desc,$image);
    $stmt->execute();
  }
  set_flash('Produk berhasil disimpan');
  header('Location: products.php'); exit;
}
?>
<?php include __DIR__ . '/../inc/header.php'; ?>
<h2><?php echo $id ? 'Edit' : 'Tambah'; ?> Produk</h2>
<form method="post" enctype="multipart/form-data" class="form">
  <?php csrf_input(); ?>
  <label>Nama<input type="text" name="name" value="<?php echo @$p['name']; ?>" required></label>
  <label>Harga<input type="number" name="price" value="<?php echo @$p['price']; ?>" required></label>
  <label>Stok<input type="number" name="stock" value="<?php echo @$p['stock']; ?>" required></label>
  <label>Deskripsi<textarea name="description"><?php echo @$p['description']; ?></textarea></label>
  <label>Gambar<input type="file" name="image"></label>
  <button class="btn">Simpan</button>
</form>
<?php include __DIR__ . '/../inc/footer.php'; ?>