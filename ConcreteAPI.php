<?php
require_once 'Rito.php';
require_once 'APIClass.class.php';

class MyAPI extends APIClass{

	public function prova(){
		if($this->method == 'GET'){
			return "Prova con GET";
		}
		else return "Prova con POST";
	}

	public function utente(){
		$modello = $GLOBALS['model'];
		if($this->method == 'GET'){
			
			
			if(!isset($_GET['following']) || $_GET['following']==''){

			$following = ($modello->getFollowing($_GET['nome'])); #Model.getUser($args[0]);
			return json_decode($following);
			} else {
				return $modello->addFollowing($_GET['nome'],$_GET['following']);
			}

			
		}
		
	}
}
?>