<?php
//いいねの処理
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
  // var_dump($favorite_count);
  // exit();
}

//データの有無を判定
if ($favorite_count[0] != 0) {
  $sql = 'DELETE FROM favorite WHERE consumer_id=:user_id AND shop_id=:shop_id';
} else {
  $sql = 'INSERT INTO favorite (id, consumer_id, shop_id, created_at) VALUES (NULL, :user_id, :shop_id, sysdate())';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':shop_id', $shop_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}
