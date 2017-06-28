<?php
$accessToken="O4ZC4kWwhIoEj/P/sMzBz6/l/t2HxCeVnopGEWjffC79fjZezdUk22U6wu1ZOmAUAgs02BBUKBm02ZFCkneVNS0tOlunyn+Ec7kJyUHbqLCAvxXnMKZ9h0sgOWmFuewkG4Xm0SceE/0yFgf8J4Ha0gdB04t89/1O/w1cDnyilFU=";

ini_set('display_errors',1);//コンソールツールにエラーを表示させるため

$userID = $_POST["userID"];
$text = $_POST["text"];

$response_format_text = [
    "type" => "text",
    "text" => $text
];

//ポストデータ
$post_data = [
    "to" => $userID,
    "messages" => [$response_format_text]
];



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
curl_close($ch);

 ?>
