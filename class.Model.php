<?php

require_once 'meekrodb.2.2.class.php';
require_once 'conf.php';
class Modello {

	public $name;
	public function __construct(){

	DB::$user = DBUSER;
	DB::$password = DBPASS;
	DB::$dbName = DBNAME;

	$this->name = "fatto";
}
	#GET utente a partire dal nome

	 public function getUser($name){
	 	$data = DB::query("SELECT * from following where user = %s;", $name);
	 	return json_encode($data);
	}

	#GET followers 
	public function getFollowing($utente){

		$data = DB::query("SELECT following from following where user = %s;", $utente);

		return json_encode($data);

	}

	public function addFollowing($utente, $new){

		$f = $this->getFollowing($utente);
		$f =json_decode($f,true);
		$f = $f[0]["following"];
		str_replace('"','',$f);
		$f = explode(', ',$f);
		array_push($f,$new);
		$f = implode(', ',$f);
		return $f;
	}

}

?>