<?php

require_once("daomodel.php");

/**
Encapsulates common properties of DAOs related to books.
*/
class BookRelated extends DAOModel{
	const ISBN = "isbn";
	
	public function __construct(){
		parent::__construct();
		$this->fields[BookRelated::ISBN] = null;
	}
	
	public function get_isbn(){
		return $this->fields[BookRelated::ISBN];
	}
	
	public function set_isbn($isbn){
		$this->fields[BookRelated::ISBN] = $isbn;
	}
}

?>
