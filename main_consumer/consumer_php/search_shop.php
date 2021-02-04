<?php
//検索されたデータ取得
session_start();
ini_set( 'display_errors', 1 );
// var_dump($_GET['searchWord']);
// exit();

include('../../functions.php');
$pdo = connect_to_db();

// データ取得SQL作成
//データがあるかを確認
if($_GET['searchWord']==""){
    exit();
}else{
    $search_word = $_GET['searchWord'];
    $sql = "SELECT * FROM shop LEFT OUTER JOIN (SELECT shop_id, brand1,brand2,brand3,brand4,brand5,brand6,brand7,brand8,brand9,brand10 FROM brand ) AS shop_data ON shop.shop_id = shop_data.shop_id
    WHERE shopname LIKE '%{$search_word}%' OR area LIKE '%{$search_word}%' OR brand1 LIKE '%{$search_word}%' OR brand2 LIKE '%{$search_word}%' OR brand3 LIKE '%{$search_word}%' OR brand4 LIKE '%{$search_word}%' OR brand5 LIKE '%{$search_word}%' OR brand6 LIKE '%{$search_word}%' OR brand7 LIKE '%{$search_word}%' OR brand8 LIKE '%{$search_word}%' OR brand9 LIKE '%{$search_word}%' OR brand10  LIKE '%{$search_word}%' ";

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
        echo json_encode($result);
    }
}

