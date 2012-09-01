<?php

require_once("daomodel.php");

class Genres extends Daomodel{
	
	const GENREID = "genreid";
	const GENRENAME = "genrename";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "genres";
		$this->fields[Genres::GENREID] = null;
		$this->fields[Genres::GENRENAME] = null;
		array_push($this->primary_keys, Genres::GENREID);
	}
	
	public function get_genreid(){
		return $this->fields[Genres::GENREID];
	}
	
	public function set_genreid($genreid){
		$this->fields[Genres::GENREID] = $genreid;
	}
	
	public function get_genrename(){
		return $this->fields[Genres::GENRENAME];
	}
	
	public function set_genrename($genrename){
		$this->fields[Genres::GENRENAME]  = $genrename;
	}
}

?>
