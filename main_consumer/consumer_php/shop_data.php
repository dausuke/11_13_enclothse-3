<?php
//店舗情報取得
session_start();
ini_set( 'display_errors', 1 );

include('../../functions.php');
check_session_id();

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM shop LEFT OUTER JOIN (SELECT shop_id, brand1,brand2,brand3,brand4,brand5,brand6,brand7,brand8,brand9,brand10 FROM brand ) AS shop_data ON shop.shop_id = shop_data.shop_id';
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
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
?>