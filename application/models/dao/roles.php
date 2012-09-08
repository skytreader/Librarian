<?php

require_once("daomodel.php");

class Roles extends Daomodel{
	
	const ROLEID = "roleid";
	const ROLENAME = "rolename";
	
	public function __construct(){
		parent::__construct();
		$this->fields[Roles::ROLEID] = null;
		$this->fields[Roles::ROLENAME] = null;
		$this->table_name = "roles";
		array_push($this->primary_keys, Roles::ROLEID);
	}
	
	public function get_roleid(){
		return $this->fields[Roles::ROLEID];
	}
	
	public function set_roleid($roleid){
		$this->fields[Roles::ROLEID] = $roleid;
	}
	
	public function get_rolename(){
		return $this->fields[Roles::ROLENAME];
	}
	
	public function set_rolename($rolename){
		$this->fields[Roles::ROLENAME] = $rolename;
	}
	
}

?>
