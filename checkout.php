<?php require 'inc/header.php';
if(empty($_SESSION['cart'])){ echo '<p>Keranjang kosong. <a href="products.php">Belanja sekarang</a></p>'; require 'inc/footer.php'; exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $customer = esc($_POST['customer']);
  $phone = esc($_POST['phone']);
  $address = esc($_POST['address']);
  $items = $_SESSION['cart'];
  $total = 0; foreach($items as $it) $total += $it['price'] * $it['qty'];

  // start transaction and check stocks
  $conn->begin_transaction();
  try{
    foreach($items as $it){
      $res = $conn->query("SELECT stock FROM products WHERE id=".(int)$it['id']." FOR UPDATE");
      $row = $res->fetch_assoc();
      if(!$row || $row['stock'] < $it['qty']){ throw new Exception('Stok tidak cukup untuk produk: '.$it['name']); }
    }

    $stmt = $conn->prepare("INSERT INTO orders (customer,phone,address,total,created_at) VALUES (?,?,?,?,NOW())");
    $stmt->bind_param('sssi',$customer,$phone,$address,$total);
    if(!$stmt->execute()){ throw new Exception('Gagal membuat pesanan'); }
    $order_id = $stmt->insert_id; $stmt->close();

    foreach($items as $it){
      $stmt = $conn->prepare("INSERT INTO order_items (order_id,product_id,price,qty) VALUES (?,?,?,?)");
      $stmt->bind_param('iiii',$order_id,$it['id'],$it['price'],$it['qty']);
      if(!$stmt->execute()){ throw new Exception('Gagal menyimpan item'); }
      $stmt->close();
      $conn->query("UPDATE products SET stock = stock - ".(int)$it['qty']." WHERE id = ".(int)$it['id']);
    }

    $conn->commit();
    unset($_SESSION['cart']);
    echo '<p>Terima kasih! Pesanan Anda berhasil. ID Pesanan: '.$order_id.'</p>';
    echo '<p><a href="products.php">Kembali ke produk</a></p>';
    require 'inc/footer.php'; exit;
  }catch(Exception $e){
    $conn->rollback();
    echo '<p class="error">Gagal melakukan checkout: '.$e->getMessage().'</p>';
  }
}
?>
<h2>Checkout</h2>
<form method="post" class="form">
  <label>Nama Lengkap<input type="text" name="customer" required></label>
  <label>Telepon<input type="text" name="phone" required></label>
  <label>Alamat Pengiriman<textarea name="address" required></textarea></label>
  <button class="btn">Bayar & Konfirmasi</button>
</form>
<?php require 'inc/footer.php'; ?>