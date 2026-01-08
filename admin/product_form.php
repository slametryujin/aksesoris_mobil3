<?php require_once __DIR__ . '/../config.php';
if(!isset($_SESSION['admin'])){ header('Location: login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id){ $res = $conn->query("SELECT * FROM products WHERE id=$id"); $p = $res->fetch_assoc(); }

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!isset($_POST['csrf_token']) || !verify_csrf($_POST['csrf_token'])){ die('Invalid CSRF token'); }
  $name = esc($_POST['name']); $price = (int)$_POST['price']; $stock = (int)$_POST['stock']; $desc = esc($_POST['description']);
  $image = 'placeholder.png';
  // ensure upload directory exists
  $uploadDir = __DIR__.'/../assets/img/uploads/';
  if(!is_dir($uploadDir)){ @mkdir($uploadDir,0755,true); }

  if(isset($_FILES['image']) && $_FILES['image']['tmp_name']){
    // improved file checks + safe naming + upload dir
    $allowed = ['image/png','image/jpeg','image/svg+xml'];
    if(!in_array($_FILES['image']['type'],$allowed) || $_FILES['image']['size'] > 3*1024*1024){ die('Gambar tidak valid atau terlalu besar'); }
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $ext = in_array($ext,['png','jpg','jpeg','svg']) ? $ext : 'png';
    $newName = uniqid('img_').'.'.$ext;
    $target = $uploadDir.$newName;
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

  <div style="display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap">
    <div>
      <?php $imgPath = isset($p['image']) && $p['image'] ? 'assets/img/'. $p['image'] : 'assets/img/demo/placeholder.png'; ?>
      <div class="image-preview"><img id="previewImg" src="<?php echo $imgPath; ?>" alt="Preview" style="max-width:220px;border-radius:8px;display:block;border:1px solid rgba(255,255,255,0.03)"></div>
      <div class="muted" style="font-size:0.9rem;margin-top:8px">Allowed: PNG JPG SVG — Max 3MB</div>
    </div>
    <div style="flex:1;min-width:220px">
      <label>Gambar<input id="imageInput" type="file" name="image" accept="image/png,image/jpeg,image/svg+xml"></label>
      <div style="margin-top:8px;color:var(--muted)">Kosongkan untuk mempertahankan gambar saat ini.</div>
    </div>
  </div>

  <button class="btn">Simpan</button>
</form>

<script>
  (function(){
    const inp = document.getElementById('imageInput');
    const prev = document.getElementById('previewImg');
    const maxSize = 3 * 1024 * 1024;
    if(!inp) return;
    inp.addEventListener('change', function(e){
      const f = this.files && this.files[0];
      if(!f){ return; }
      if(f.size > maxSize){ alert('File terlalu besar (maks 3MB).'); this.value=''; return; }
      if(!/^image\/(png|jpeg|svg\+xml)$/.test(f.type)){
        alert('Format tidak didukung. Gunakan PNG, JPG, atau SVG.'); this.value=''; return; }
      const reader = new FileReader(); reader.onload = function(ev){ prev.src = ev.target.result; };
      reader.readAsDataURL(f);
    });
  })();
</script>
<?php include __DIR__ . '/../inc/footer.php'; ?>