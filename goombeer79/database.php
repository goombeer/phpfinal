<?php
ini_set('display_errors',1);//コンソールツールにエラーを表示させるため

// $username = $_POST["username"];

include("function.php");
$db = db_con();

$stmt = $db->prepare("SELECT No,name,age,question1,question2,question3,judge FROM line_user_info");
$status = $stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
error_log(print_r($result,true));
$ar = array_values($result);
error_log(print_r($ar,true));
$json = json_encode($ar);
error_log(print_r($json,true));
echo $json;


 ?>
