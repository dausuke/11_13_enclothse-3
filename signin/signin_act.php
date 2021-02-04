<?php

// ini_set( 'display_errors', 1 );
session_start();

//データ受信
$email = $_POST['email'];
$password = $_POST['pass'];
$attribute = $_POST['attribute'];
// var_dump($_POST);
// exit();

// DB接続の設定
include('../functions.php');
$pdo = connect_to_db();

//ログイン情報取得
//販売員かユーザーの判定
if($attribute == 0){
    $sql = 'SELECT * FROM consumer WHERE email=:email AND password=:password AND is_deleted=0';
}elseif($attribute == 1){
    $sql = 'SELECT * FROM salesperson WHERE email=:email AND password=:password AND is_deleted=0';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
    $val = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$val){
        echo "<script>alert('ログインできませんでした')</script>";
        echo "<script>location.href = 'signin.php';</script>";
        exit();
    }else{
        if($attribute == 0){
            $_SESSION = array();
            $_SESSION['session_id'] = session_id();
            $_SESSION['name'] = $val['name'];
            $_SESSION['uid'] = $val['consumer_id'];
            header('Location:../main_consumer/main.php');
            exit();
        }elseif($attribute == 1){
            $_SESSION = array();
            $_SESSION['session_id'] = session_id();
            $_SESSION['name'] = $val['name'];
            $_SESSION['uid'] = $val['salesperson_id'];
            header('Location:../main_salesperson/main.php');
            exit();
        }

  }
}

//ログイン認証
//入力されたアドレス、パスワードの配列がDB内にあれば変数judgeにtrueなければfalseを格納
//ログイン成功時、ＤＢ内のＩＤをセッション情報に保存
// var_dump($user_data);
// exit();

?>

<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/signin.css">
    <title></title>
</head>

<body>
    <div class='loader'>
        <p>Loading...</p>
    </div>
    <main>
        <form action="signin_data.php" method="POST">
            <div class="signin">
                <fieldset class="signin-content">
                    <input type="text" name="email" id='mail' placeholder="email">
                    <input type="password" name="pass" id='password' placeholder="password">
                    <button id="signupbtn">sign-in</button>
                </fieldset>
            </div>
        </form>
    </main>
</body>

</html>