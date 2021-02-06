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
$stylest_id = $_GET['stylest_id'];
$sql = "SELECT salesperson.salesperson_id, name, age, city, gender, shop, experience, image FROM salesperson LEFT OUTER JOIN( SELECT salesperson_id,coordinat_img FROM coordinat ) AS salesperson_data ON salesperson.salesperson_id = salesperson_data.salesperson_id
 WHERE salesperson_id=:stylest_id";

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':stylest_id', $stylest_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result);
    exit();
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

