<?php
ini_set('display_errors',1);//コンソールツールにエラーを表示させるため

$number =$_POST["number"];
include("function.php");
$db = db_con();

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
$stmt = $db->prepare("SELECT mobile_id FROM line_user_info WHERE No=$number");
$status = $stmt->execute();
$result = $stmt->fetch(PDO::FETCH_NUM);//全件取得して、連想配列で取得
foreach ($result as $key => $value) {
  echo $value;
}






 ?>
