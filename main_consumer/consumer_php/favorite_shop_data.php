<?php
//店舗情報取得
session_start();
ini_set( 'display_errors', 1 );

include('../../functions.php');
check_session_id();

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT shop.shop_id,shopname,area,photo,favorite_consumer_data.consumer_id  FROM shop LEFT OUTER JOIN (SELECT shop_id,consumer_id FROM favorite ) AS favorite_data ON shop.shop_id = favorite_data.shop_id INNER JOIN (SELECT consumer_id FROM consumer )AS favorite_consumer_data ON favorite_data.consumer_id=favorite_consumer_data.consumer_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
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
?>