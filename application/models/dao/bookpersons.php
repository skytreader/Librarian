<?php

require_once("daomodel.php");

class Bookpersons extends DAOModel{
	
	const PERSONID = "personid";
	const LASTNAME = "lastname";
	const FIRSTNAME = "firstname";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "bookpersons";
		$this->fields[Bookpersons::PERSONID] = null;
		$this->fields[Bookpersons::LASTNAME] = null;
		$this->fields[Bookpersons::FIRSTNAME] = null;
		array_push($this->primary_keys, Bookpersons::PERSONID);
	}
	
	public function get_personid(){
		return $this->fields[Bookpersons::PERSONID];
	}
	
	public function set_personid($person_id){
		$this->fields[Bookpersons::PERSONID] = $person_id;
	}
	
	public function get_lastname(){
		return $this->fields[Bookpersons::LASTNAME];
	}
	
	public function set_lastname($lastname){
		$this->fields[Bookpersons::LASTNAME] = $lastname;
	}
	
	public function get_firstname(){
		return $this->fields[Bookpersons::FIRSTNAME];
	}
	
	public function set_firstname($firstname){
		$this->fields[Bookpersons::FIRSTNAME] = $firstname;
	}
	
}

?>
