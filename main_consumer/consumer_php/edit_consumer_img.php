<?php
//ユーザープロフィール写真変更写真
session_start();
ini_set( 'display_errors', 1 );

include('../../functions.php');
check_session_id();

// var_dump($_FILES);
// exit();

if(!isset($_FILES['image']) || $_FILES['image']['error'] != 0){
  exit('画像が送信されていません');
}else{
  $uploaded_file_name = $_FILES['image']['name'];
  $temp_path = $_FILES['image']['tmp_name'];
  $directory_path = '../../up_file/consumer/';

  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis').md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  $img='';
  if(!is_uploaded_file($temp_path)){
    exit('画像がありません');
  }else{
    if(!move_uploaded_file($temp_path,$filename_to_save)){
      exit('Error:アップロードできませんでした');
    }else{
      chmod($filename_to_save,0644);
    }
  }
}

$user_id = $_SESSION['uid'];
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE consumer SET img=:img,updated_at=sysdate() WHERE consumer_id=:user_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':img', $filename_to_save, PDO::PARAM_STR);
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
