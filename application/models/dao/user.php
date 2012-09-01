<?php

require_once("daomodel.php");

/**
This class represents any web app user. This encapsulates
common properties for any app user for any project.
*/
class User extends Daomodel{
	
	const CANREAD = "canread";
	const CANWRITE = "canwrite";
	const CANEXEC = "canexec";
	
	public function __construct(){
		parent::__construct();
		$this->fields[User::CANREAD] = null;
		$this->fields[User::CANWRITE] = null;
		$this->fields[User::CANEXEC] = null;
	}
	
	public function get_canread(){
		return $this->fields[User::CANREAD];
	}
	
	public function set_canread($c){
		$this->fields[User::CANREAD] = $c;
	}
	
	public function get_canwrite(){
		return $this->fields[User::CANWRITE];
	}
	
	public function set_canwrite($c){
		$this->fields[User::CANWRITE] = $c;
	}
	
	public function get_canexec(){
		return $this->fields[User::CANEXEC];
	}
	
	public function set_canexec($c){
		$this->fields[User::CANEXEC] = $c;
	}
}

?>
