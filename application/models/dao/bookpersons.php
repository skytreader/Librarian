<?php

require_once("daomodel.php");

class BookPersons extends DAOModel{
	
	const PERSONID = "personid";
	const LASTNAME = "lastname";
	const FIRSTNAME = "firstname";
	
	public function __construct(){
		$this->table_name = "bookpersons";
		$this->fields[BookPersons::PERSONID] = null;
		$this->fields[BookPersons::LASTNAME] = null;
		$this->fields[BookPersons::FIRSTNAME] = null;
		array_push($this->primary_keys, BookPersons::PERSONID);
	}
	
	public function get_personid(){
		return $this->fields[BookPersons::PERSONID];
	}
	
	public function set_personid($person_id){
		$this->fields[BookPersons::PERSONID] = $person_id;
	}
	
	public function get_lastname(){
		return $this->fields[BookPersons::LASTNAME];
	}
	
	public function set_lastname($lastname){
		$this->fields[BookPersons::LASTNAME] = $lastname;
	}
	
	public function get_firstname(){
		return $this->fields[BookPersons::FIRSTNAME];
	}
	
	public function set_firstname($firstname){
		$this->fields[BookPersons::FIRSTNAME] = $firstname;
	}
	
}

?>
