<?php
//コーディネート写真取得
session_start();
ini_set( 'display_errors', 1 );
include('../../functions.php');
check_session_id();

$user_id = $_SESSION['uid'];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT coordinat_img FROM coordinat WHERE consumer_id=:user_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
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