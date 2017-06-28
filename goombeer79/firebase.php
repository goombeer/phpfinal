<?php
function firebase($message_text,$userID){
ini_set('display_errors',1);

require_once "vendor/autoload.php";

define("DEFAULT_URL","https://linebot-834b3.firebaseio.com");
define("DEFAULT_TOKEN","NltslhhjYjSmXtehypw8EtgVjijVzIkBrdk2Uicp");

$ar = array(
    "name" => $userID,
    "text" => $message_text
);

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL,DEFAULT_TOKEN);

// set
$firebase->push("/$userID", $ar);

};
