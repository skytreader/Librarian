<?php

require_once("bookrelated.php");

class Bookparticipants extends Bookrelated{
	
	const PERSONID = "personid";
	const ROLEID = "roleid";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "bookparticipants";
		$this->fields[Bookparticipants::PERSONID] = null;
		$this->fields[Bookparticipants::ROLEID] = null;
		array_push($this->primary_keys, Bookrelated::ISBN);
		array_push($this->primary_keys, Bookparticipants::PERSONID);
		array_push($this->primary_keys, Bookparticipants::ROLEID);
	}
	
	public function get_personid(){
		return $this->fields[Bookparticipants::PERSONID];
	}
	
	public function set_personid($p){
		$this->fields[Bookparticipants::PERSONID] = $p;
	}
	
	public function get_roleid(){
		return $this->fields[Bookparticipants::ROLEID];
	}
	
	public function set_roleid($ri){
		$this->fields[BookParticipants::ROLEID] = $ri;
	}
	
}

?>
