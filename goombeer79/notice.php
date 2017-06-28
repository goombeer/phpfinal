<?php
$sample =$_POST["judge"];
$s=array_column($sample, 'value');
include_once("function.php");
$db = db_con();
//
for ($i=0; $i <count($s); $i++) {
  $num = 1+$i;
  $stmt = $db->prepare("UPDATE line_user_info SET judge=:judge WHERE No LIKE '%{$num}%'");
  $stmt->bindValue(':judge', $s[$i], PDO::PARAM_STR);
  $status = $stmt->execute();
  var_dump($stmt);
}
//合格者のID取得
$stmt = $db->prepare("SELECT mobile_id FROM line_user_info WHERE judge='pass'");//mobile_idを取り出して、新規ユーザーなのか検索
$status = $stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_COLUMN);//全件取得して、連想配列で取得
$ar = $result;
var_dump($ar);

//不合格者のID取得
$stmt = $db->prepare("SELECT mobile_id FROM line_user_info WHERE judge='unpass'");//mobile_idを取り出して、新規ユーザーなのか検索
$status = $stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_COLUMN);//全件取得して、連想配列で取得
$ar2 = $result;
var_dump($ar2);

$accessToken="O4ZC4kWwhIoEj/P/sMzBz6/l/t2HxCeVnopGEWjffC79fjZezdUk22U6wu1ZOmAUAgs02BBUKBm02ZFCkneVNS0tOlunyn+Ec7kJyUHbqLCAvxXnMKZ9h0sgOWmFuewkG4Xm0SceE/0yFgf8J4Ha0gdB04t89/1O/w1cDnyilFU=";
//レスポンスフォーマット


//合格者に対しての通知
for ($j=0; $j <count($ar) ; $j++) {
  $response_format_text = [
    "type" => "text",
    "text" => "おめでとうございます！合格いたしました！"
  ];

  $post_data = [
    "to" => $ar[$j],
    "messages" => [$response_format_text]
  ];

  //curl実行
  $ch = curl_init("https://api.line.me/v2/bot/message/push");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
  ));
  $result = curl_exec($ch);
  var_dump($result);
  curl_close($ch);
}

// 不合格者に対しての通知
for ($k=0; $k <count($ar2) ; $k++) {
  $response_format_text = [
    "type" => "text",
    "text" => "残念ながら不合格です"
  ];

  $post_data = [
    "to" => $ar2[$k],
    "messages" => [$response_format_text]
  ];
//
//   //curl実行
  $ch = curl_init("https://api.line.me/v2/bot/message/push");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
  ));
  $result = curl_exec($ch);
  var_dump($result);
  curl_close($ch);
}






 ?>
