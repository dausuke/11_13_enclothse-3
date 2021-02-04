<?php
//スタイリスト（販売員）情報取得
session_start();
ini_set( 'display_errors', 1 );
$user_id = $_SESSION['uid'];
// var_dump($user_id);
// exit();

include('../../functions.php');
check_session_id();

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM salesperson LEFT OUTER JOIN (SELECT salesperson_id,consumer_id FROM stylest ) AS shop_data ON salesperson.salesperson_id = shop_data.salesperson_id';
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
    $outputData = [];
    foreach($result as $val){
        if($val['consumer_id']==$user_id){
            $outputData[]=$val;
        }
    }
    echo json_encode($outputData, JSON_UNESCAPED_UNICODE);

            //    $a = json_encode($outputData, JSON_UNESCAPED_UNICODE);

            //     var_dump($a);
            // exit();
}
?>