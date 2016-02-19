<?php 
define('__ROOT__', __DIR__); 
require_once  __ROOT__.'/conf.php';
require_once __ROOT__.'/apiServer.php';
// read incoming info and grab the chatID
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$messageReceived = $update['message']['text'];

if($messageReceived == "/pippo"){
	$mod = new Modello();
	$reply = sendMessage(implode(', ',$mod->getFollowing("pippo")));
}else $reply = "Non capisco";
// compose reply
		
// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;

file_get_contents($sendto);

function sendMessage($message){
	return $message;
}

?>