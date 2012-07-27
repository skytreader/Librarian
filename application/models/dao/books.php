<?php

require_once("daomodel.php");

class Books extends DAOModel{
	
	private $isbn;
	private $title;
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "books";
	}
	
	public function get_isbn($i){
		return $isbn;
	}
	
	public function set_isbn($i){
		$isbn = $i;
	}
	
	public function get_title(){
		return $title;
	}
	
	public function set_title($t){
		$title= $t;
	}
}

?>
