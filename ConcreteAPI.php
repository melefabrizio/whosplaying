<?php
require_once  __ROOT__.'/Rito.php';
require_once  __ROOT__.'/APIClass.class.php';

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
				return $following;
			
			} else {
				
				if($_GET['unfollow']==1){
					return $modello->removeFollowing($_GET['nome'],$_GET['following']);
				}else
					return $modello->addFollowing($_GET['nome'],$_GET['following']);
			}

			
		}

		else if($this->method =='POST'){
			return "questa è una post di telegram";
		}
		
	}
}
?>