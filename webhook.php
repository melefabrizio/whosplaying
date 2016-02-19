<?php 
define('__ROOT__', __DIR__); 
require_once  __ROOT__.'/conf.php';
require_once  __ROOT__.'/Rito.php';
require_once  __ROOT__.'/class.Model.php';
// read incoming info and grab the chatID
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$messageReceived = $update['message']['text'];
$arrayReceived = explode(' ', $messageReceived);
$mod = new Modello();
$reply = 'Da qualche parte qualcosa è andato storto';
if($arrayReceived[0]=='/whosplaying') {
	if($arrayReceived[1] == 'create'){
		$name = $arrayReceived[2];
		$res = createGroup($name);
		$reply = $res?"Ok, il gruppo ".$name." è pronto!":"Oops, abbiamo un problema";
	}else if(checkGroup($arrayReceived[1])){
		$group = $arrayReceived[1];
		$reply = $group;
		$reply .= getStats($group);
		try{
			$command = $arrayReceived[2];
			$summoner = $arrayReceived[3];
			switch ($command) {
				case 'add':
					$reply .= $mod->addFollowing($group,$summoner);
					break;
				case 'remove':
					$reply .= $mod->removeFollowing($group,$summoner);

					break;
				
			}
		}catch (Exception $e){
			//$reply .= "eccezione";
			//$reply .= getStats($group);
		}
		//Ciclo sull'edit/view del gruppo
	}else $reply = "Scusa, non capisco";
	
	
}
// compose reply

// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;

file_get_contents($sendto);
die("fine!");
function sendMessage($message){
	return $message;
}
function checkGroup($name){
	//$group = $mod->getUser($name);
	return true;
}

function getStats($group){
	$following = implode(', ',$mod->getFollowing($group));
	return "Statistiche del gruppo ".$group.", a cui appartengono: ".$following;
}

?>