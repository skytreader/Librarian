<?php

require_once("daomodel.php");

class Authored extends DAOModel{
	
	const ISBN = "isbn";
	const PERSONID = "personid";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "authored";
		$this->fields[ISBN] = null;
		$this->fields[PERSONID] = null;
		array_push($this->primary_keys, ISBN);
		array_push($this->primary_keys, PERSONID);
	}
	
	public get_isbn(){
		return $this->fields[ISBN];
	}
	
	public set_isbn($i){
		$this->fields[ISBN] = $i;
	}
	
	public get_personid(){
		return $this->fields[PERSONID];
	}
	
	public set_personid($p){
		$this->fields[PERSONID] = $p;
	}
	
}

?>
