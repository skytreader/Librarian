<?php

require_once("daomodel.php");

class Books extends DAOModel{
	
	const ISBN = "isbn";
	const TITLE = "title";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "books";
		$this->fields[ISBN] = null;
		$this->fields[TITLE] = null;
		array_push($this->primary_keys, Books::ISBN);
	}
	
	public function get_isbn($i){
		return $this->fields[Books::ISBN];
	}
	
	public function set_isbn($i){
		$this->fields[Books::ISBN] = $i;
	}
	
	public function get_title(){
		return $this->fields[Books::TITLE];
	}
	
	public function set_title($t){
		$this->fields[Books::TITLE]= $t;
	}
}

?>
