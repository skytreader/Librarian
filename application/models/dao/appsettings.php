<?php

require_once("daomodel.php");

class Appsettings extends DAOModel{
	
	private $settingcode;
	private $settingstring;
	private $description;
	private $settingvalue;
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "appsettings";
	}
	
	public function get_settingcode(){
		return $settingcode;
	}
	
	public function set_settingcode($s){
		$settingcode = $s;
	}
	
	public function get_settingstring(){
		return $settingstring;
	}
	
	public function set_settingstring($s){
		$settingstring = $s;
	}
	
	public function get_description(){
		return $description;
	}
	
	public function set_description($d){
		$description = $d;
	}
	
	public function get_settingvalue(){
		return $settingvalue;
	}
	
	public function set_settingvalue($s){
		$settingvalue = $s;
	}
	
}

?>
