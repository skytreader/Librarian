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
		$this->fields[SETTINGCODE] = null;
		$this->fields[SETTINGSTRING] = null;
		$this->fields[DESCRIPTION] = null;
		$this->fields[SETTINGVALUE] = null;
		array_push($this->primary_keys, SETTING_CODE);
	}
	
	public function get_settingcode(){
		return $this->fields[SETTINGCODE];
	}
	
	public function set_settingcode($s){
		$this->fields[SETTINGCODE] = $s;
	}
	
	public function get_settingstring(){
		return $this->fields[SETTINGSTRING];
	}
	
	public function set_settingstring($s){
		$this->fields[SETTINGSTRING] = $s;
	}
	
	public function get_description(){
		return $this->fields[DESCRIPTION];
	}
	
	public function set_description($d){
		$this->fields[DESCRIPTION] = $d;
	}
	
	public function get_settingvalue(){
		return $this->fields[SETTINGVALUE];
	}
	
	public function set_settingvalue($s){
		$this->fields[SETTINGVALUE] = $s;
	}
	
}

?>
