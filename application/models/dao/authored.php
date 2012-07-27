<?php

require_once("daomodel.php");

class Authored extends DAOModel{
	
	private $isbn;
	private $personid;
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "authored";
	}
	
	public get_isbn(){
		return $isbn;
	}
	
	public set_isbn($i){
		$isbn = $i;
	}
	
	public get_personid(){
		return $personid;
	}
	
	public set_personid($p){
		$personid = $p;
	}
	
}

?>
