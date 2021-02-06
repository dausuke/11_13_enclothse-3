<?php
//ユーザープロフィール編集
session_start();
ini_set( 'display_errors', 1 );

include('../../functions.php');
check_session_id();

$request_body = file_get_contents('php://input'); //送信されてきたbodyを取得(JSON形式）
$data = json_decode($request_body,true); // デコード
$edit_consumer_data = $data['data'];
$user_id = $_SESSION['uid'];

// var_dump($edit_consumer_data);
// exit();

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE consumer SET city=:city, email=:email,height=:height,weight=:weight,shop=:shop, updated_at=sysdate() WHERE consumer_id=:user_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':city', $edit_consumer_data['city'], PDO::PARAM_STR);
$stmt->bindValue(':email', $edit_consumer_data['email'], PDO::PARAM_STR);
$stmt->bindValue(':height', $edit_consumer_data['height'], PDO::PARAM_STR);
$stmt->bindValue(':weight', $edit_consumer_data['weight'], PDO::PARAM_STR);
$stmt->bindValue(':shop', $edit_consumer_data['shop'], PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

?>
