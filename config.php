<?php
// config.php - database connection
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'aksesoris_db';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

session_start();

if(empty($_SESSION['csrf_token'])){ $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
function csrf_input(){ echo '<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">'; }
function verify_csrf($token){ return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'],$token); }
function set_flash($msg){ $_SESSION['flash'] = $msg; }
function get_flash(){ $m = isset($_SESSION['flash'])?$_SESSION['flash']:null; unset($_SESSION['flash']); return $m; }

function esc($s){ global $conn; return htmlspecialchars($conn->real_escape_string(trim($s))); }
?>