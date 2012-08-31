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
		$this->fields[AppSettings::SETTINGCODE] = null;
		$this->fields[AppSettings::SETTINGSTRING] = null;
		$this->fields[AppSettings::DESCRIPTION] = null;
		$this->fields[AppSettings::SETTINGVALUE] = null;
		array_push($this->primary_keys, AppSettings::SETTINGCODE);
	}
	
	public function get_settingcode(){
		return $this->fields[AppSettings::SETTINGCODE];
	}
	
	public function set_settingcode($s){
		$this->fields[AppSettings::SETTINGCODE] = $s;
	}
	
	public function get_settingstring(){
		return $this->fields[AppSettings::SETTINGSTRING];
	}
	
	public function set_settingstring($s){
		$this->fields[AppSettings::SETTINGSTRING] = $s;
	}
	
	public function get_description(){
		return $this->fields[AppSettings::DESCRIPTION];
	}
	
	public function set_description($d){
		$this->fields[AppSettings::DESCRIPTION] = $d;
	}
	
	public function get_settingvalue(){
		return $this->fields[AppSettings::SETTINGVALUE];
	}
	
	public function set_settingvalue($s){
		$this->fields[AppSettings::SETTINGVALUE] = $s;
	}
	
}

?>
