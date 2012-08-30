<?php

require_once("bookrelated.php");

class Books extends BookRelated{
	
	const TITLE = "title";
	const YEAR = "year";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "books";
		$this->fields[Books::TITLE] = null;
		$this->fields[Books::YEAR] = null;
		array_push($this->primary_keys, Books::ISBN);
	}
	
	public function get_title(){
		return $this->fields[Books::TITLE];
	}
	
	public function set_title($t){
		$this->fields[Books::TITLE]= $t;
	}
	
	public function get_year(){
		return $this->fields[Books::YEAR];
	}
	
	public function set_year($year){
		$this->fields[Books::YEAR] = $year;
	}
}

?>
