<?php

require_once("daomodel.php");

class Appsettings extends DAOModel{
	
	const SETTINGCODE = "settingcode";
	const SETTINGSTRING = "settingstring";
	const DESCRIPTION = "description";
	const SETTINGVALUE = "settingvalue";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "appsettings";
		$this->tables[SETTINGCODE] = null;
		$this->tables[SETTINGSTRING] = null;
		$this->tables[DESCRIPTION] = null;
		$this->tables[SETTINGVALUE] = null;
	}
	
	public function get_settingcode(){
		return $this->tables[SETTINGCODE];
	}
	
	public function set_settingcode($s){
		$this->tables[SETTINGCODE] = $s;
	}
	
	public function get_settingstring(){
		return $this->tables[SETTINGSTRING];
	}
	
	public function set_settingstring($s){
		$this->tables[SETTINGSTRING] = $s;
	}
	
	public function get_description(){
		return $this->tables[DESCRIPTION];
	}
	
	public function set_description($d){
		$this->tables[DESCRIPTION] = $d;
	}
	
	public function get_settingvalue(){
		return $this->tables[SETTINGVALUE];
	}
	
	public function set_settingvalue($s){
		$this->tables[SETTINGVALUE] = $s;
	}
	
}

?>
