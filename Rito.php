<?php 
require_once  __ROOT__.'/conf.php';
class Rito{

	
	private $rito_url ='';
	private $rito_key;

	public function __construct(){

		$rito_key = RIOTKEY;
	}

	function getDati($utente){
		if(is_string($utente))
			return "Questi sono i dati del singolo utente";
		else die("errore");
	}

	function getDatiFinal($utenti){

		if(is_array($utenti)){
		$r = '';
		for($i=0;$i<count($utenti);$i++){
			$r+=getDati($utenti[$i]);
		}
		return $r;

		}else die("Errore!");

	}

}

?>