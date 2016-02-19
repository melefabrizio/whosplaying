<?php
require  __ROOT__.'/meekrodb.2.2.class.php';


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
	 	$data = DB::query("SELECT name from following where name = %s;", $name);
	 	return json_encode($data);
	}

	#GET followers 
	public function getFollowing($utente){

		$data = DB::query("SELECT following from following where name = %s;", $utente);
		$f = $data;
		$f = $f[0]["following"];
		#str_replace('"','',$f);
		$f = explode('-',$f);
		$f = array_filter($f);
		return $f;

	}

	public function addFollowing($utente, $new){

		$f = $this->getFollowing($utente);
		$imploded = implode('-',$f);
		if(!strpos($imploded, $new)){
			
			#str_replace('"','',$f);
			print_r("\n prima:".$imploded);
		

			array_push($f,$new.'-');

			$f = implode('-',$f);
			print("\n dopo:".$f);
			$data = DB::query("UPDATE following SET following = %s WHERE name = %s;", $f, $utente);
			return $data=='true'?'Now following '.$new:'Error updating followers';
		}else{
			return 'Already following';
		}
	}

	public function removeFollowing($utente, $following){
		$f = $this ->getFollowing($utente);
		$f = implode('-',$f);
		if(!strpos(' '.$f.' ',$following)){

			return $following.' is already not among your followers!';
		}else{
			#$f = $f[0]["following"];
			
			#$f = str_replace('"','',$f);
			
			$f=str_replace($following,'',$f);
			$f = str_replace('--','-',$f);

			$data = DB::query("UPDATE following SET following = %s WHERE name = %s;", $f, $utente);
			return $data=='true'?'Unfollowed '.$following:'Error updating followers';

		}
	}

}

?>