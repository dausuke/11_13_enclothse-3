<?php
//いいねの色判定用
session_start();
ini_set( 'display_errors', 1 );

include('../../functions.php');
$pdo = connect_to_db();

$user_id = $_SESSION['uid'];
$shop_id = $_GET['shop_id'];

$sql = 'SELECT COUNT(*) FROM favorite WHERE consumer_id=:user_id AND shop_id=:shop_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':shop_id', $shop_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $favorite_count = $stmt->fetch();
}

//データの有無を判定
if ($favorite_count[0] != 0) {
    $judg = '0';
} else {
    $judg = '1';
}
echo $judg;