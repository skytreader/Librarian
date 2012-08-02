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
		array_push($this->primary_keys, ISBN);
	}
	
	public function get_isbn($i){
		return $this->fields[ISBN];
	}
	
	public function set_isbn($i){
		$this->fields[ISBN] = $i;
	}
	
	public function get_title(){
		return $this->fields[TITLE];
	}
	
	public function set_title($t){
		$this->fields[TITLE]= $t;
	}
}

?>
