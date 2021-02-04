<?php
//検索されたデータ取得
session_start();
ini_set( 'display_errors', 1 );
// var_dump($_GET['searchWord']);
// exit();

include('../../functions.php');
$pdo = connect_to_db();

// var_dump($_GET);
// exit();
// データ取得SQL作成
$shop_id = $_GET['shop_id'];
$sql = "SELECT shopname,Introduction,area,photo,name,age,experience,image,brand1,brand2,brand3,brand4,brand5,brand6,brand7,brand8,brand9,brand10 FROM shop LEFT OUTER JOIN (SELECT * FROM brand ) AS shop_data ON shop.shop_id = shop_data.shop_id LEFT OUTER JOIN (SELECT * FROM salesperson ) AS salesperson_data ON shop.shop_id = salesperson_data.shop_id WHERE shop.shop_id=:shop_id";

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':shop_id', $shop_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    // exit();
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

