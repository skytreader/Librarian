<?php

require_once("daomodel.php");

/**
Encapsulates common properties of DAOs related to books.
*/
class Bookrelated extends Daomodel{
	const ISBN = "isbn";
	
	public function __construct(){
		parent::__construct();
		$this->fields[Bookrelated::ISBN] = null;
	}
	
	public function get_isbn(){
		return $this->fields[Bookrelated::ISBN];
	}
	
	public function set_isbn($isbn){
		$this->fields[Bookrelated::ISBN] = $isbn;
	}
}

?>
