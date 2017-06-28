<?php
//コンソールツールにエラーを表示させるため
ini_set('display_errors',1);


//セッションを持たせて、ログイン機能を強化
session_start();
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["pass"] = $_POST["pass"];

//データベース関連
include("function.php");
$db = db_con();

//ユーザーのメールアドレスを取り出して、会員登録しているか確認
$stmt = $db->prepare("SELECT username,email,pass,root FROM user_database WHERE username=:username AND email=:email");
$stmt -> bindValue(':username',$_SESSION["username"]);
$stmt -> bindValue(':email',$_SESSION["email"]);
$status = $stmt->execute();
$result = $stmt->fetch();
if ($status == false) {
  queryError($stmt);
}

if (password_verify($_SESSION["pass"],$result["pass"]) && $result["root"] == 1) {
  $_SESSION["chk_ssid"]  = $_SESSION["ssid"];
  $_SESSION["name"]      = $result['username'];
  $_SESSION["root_master"]      = $result["root"];
  echo "1";
} elseif (password_verify($_SESSION["pass"],$result["pass"]) && $result["root"] == 0) {
  $_SESSION["chk_ssid"]  = $_SESSION["ssid"];
  $_SESSION["name"]      = $result['username'];
  $_SESSION["root"]      = $result["root"];
  echo "0";
}else {
  echo "ログインに失敗しました";
}
// $result = array_values($result);
// error_log(print_r($result,true));
// $judge = in_array($_SESSION["email"],$result);
// error_log($judge);


 ?>
