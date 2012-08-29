<?php

require_once("daomodel.php");

class Printers extends DAOModel{
	
	const PRINTERID = "PRINTERID";
	const PRINTERNAME = "PRINTERNAME";
	
	public function __construct(){
		$this->table_name = "publishers";
		$this->fields[Printers::PRINTERID] = null;
		$this->fields[Printers::PRINTERNAME] = null;
		array_push($this->primary_keys, Printers::PRINTERID);
	}
	
	public function get_publisherid(){
		return $this->fields[Printers::PRINTERID];
	}
	
	public function set_publisherid($printerid){
		$this->fields[Printers::PRINTERID]  = $printerid;
	}
	
	public function get_publishername(){
		return $this->fields[Printers::PRINTERNAME];
	}
	
	public function set_publishername($printer_name){
		$this->fields[Printers::PRINTERNAME] = $printer_name;
	}
	
}

?>
