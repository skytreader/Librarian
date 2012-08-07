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
		$this->fields[Appsettings::SETTINGCODE] = null;
		$this->fields[Appsettings::SETTINGSTRING] = null;
		$this->fields[Appsettings::DESCRIPTION] = null;
		$this->fields[Appsettings::SETTINGVALUE] = null;
		array_push($this->primary_keys, Appsettings::SETTINGCODE);
	}
	
	public function get_settingcode(){
		return $this->fields[Appsettings::SETTINGCODE];
	}
	
	public function set_settingcode($s){
		$this->fields[Appsettings::SETTINGCODE] = $s;
	}
	
	public function get_settingstring(){
		return $this->fields[Appsettings::SETTINGSTRING];
	}
	
	public function set_settingstring($s){
		$this->fields[Appsettings::SETTINGSTRING] = $s;
	}
	
	public function get_description(){
		return $this->fields[Appsettings::DESCRIPTION];
	}
	
	public function set_description($d){
		$this->fields[Appsettings::DESCRIPTION] = $d;
	}
	
	public function get_settingvalue(){
		return $this->fields[Appsettings::SETTINGVALUE];
	}
	
	public function set_settingvalue($s){
		$this->fields[Appsettings::SETTINGVALUE] = $s;
	}
	
}

?>
