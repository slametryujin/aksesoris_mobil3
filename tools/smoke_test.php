<?php
// tools/smoke_test.php
// Simple smoke test: set BASE and run via CLI: php smoke_test.php
$BASE = $argv[1] ?? 'http://localhost/aksesoris_mobil2';
$paths = ['/home.php','/products.php','/cart.php','/checkout.php','/admin/login.php'];
$ch = curl_init();
$ok = true;
foreach($paths as $p){
  $url = rtrim($BASE, '/') . $p;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  $res = curl_exec($ch);
  $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if($code !== 200){ echo "[FAIL] $url => HTTP $code\n"; $ok = false; } else { echo "[OK] $url => HTTP $code\n"; }
}
curl_close($ch);
if($ok) echo "\nSmoke test passed.\n"; else echo "\nSome endpoints failed - check your web server.\n";
