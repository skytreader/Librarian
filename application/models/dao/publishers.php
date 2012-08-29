<?php

require_once("daomodel.php");

class Publishers extends DAOModel{
	
	const PUBLISHERID = "PUBLISHERID";
	const PUBLISHERNAME = "PUBLISHERNAME";
	
	public function __construct(){
		$this->table_name = "publishers";
		$this->fields[Publishers::PUBLISHERID] = null;
		$this->fields[Publishers::PUBLISHERNAME] = null;
		array_push($this->primary_keys, Publishers::PUBLISHERID);
	}
	
	public function get_publisherid(){
		return $this->fields[Publishers::PUBLISHERID];
	}
	
	public function set_publisherid($publisherid){
		$this->fields[Publishers::PUBLISHERID]  = $publisherid;
	}
	
	public function get_publishername(){
		return $this->fields[Publishers::PUBLISHERNAME];
	}
	
	public function set_publishername($publisher_name){
		$this->fields[Publishers::PUBLISHERNAME] = $publisher_name;
	}
	
}

?>
