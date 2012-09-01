<?php

require_once("daomodel.php");

class Imprints extends Daomodel{
	
	const MOTHERCOMPANY = "mothercompany";
	const IMPRINTCOMPANY = "imprintcompany";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "imprints";
		$this->fields[Imprints::MOTHERCOMPANY] = null;
		$this->fields[Imprints::IMPRINTCOMPANY] = null;
		array_push($this->primary_keys, Imprints::MOTHERCOMPANY, Imprints::IMPRINTCOMPANY);
	}
	
	public function get_mothercompany(){
		return $this->fields[Imprints::MOTHERCOMPANY];
	}
	
	public function set_mothercompany($mothercompany){
		$this->fields[Imprints::MOTHERCOMPANY] = $mothercompany;
	}
	
	public function get_imprintcompany(){
		return $this->fields[Imprints::IMPRINTCOMPANY];
	}
	
	public function set_imprintcompant($imprintcompany){
		$this->fields[Imprints::IMPRINTCOMPANY] = $imprintcompany;
	}
	
}

?>
