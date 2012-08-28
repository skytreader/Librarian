<?php

require_once("bookrelated.php");

class Authored extends BookRelated{
	
	const PERSONID = "personid";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "authored";
		$this->fields[Authored::PERSONID] = null;
		array_push($this->primary_keys, BookRelated::ISBN);
		array_push($this->primary_keys, Authored::PERSONID);
	}
	
	public get_personid(){
		return $this->fields[PERSONID];
	}
	
	public set_personid($p){
		$this->fields[PERSONID] = $p;
	}
	
}

?>
