<?php

require_once("daomodel.php");

class Bookcompanies extends Daomodel{

	const COMPANYID = "companyid";
	const COMPANYNAME = "companyname";

	public function __construct(){
		parent::__construct();
		$this->table_name = "bookcompanies";
		$this->fields[Bookcompanies::COMPANYID] = null;
		$this->fields[Bookcompanies::COMPANYNAME] = null;
		array_push($this->primary_keys, Bookcompanies::COMPANYID);
	}

	public function get_companyid(){
		return $this->fields[Bookcompanies::COMPANYID];
	}

	public function set_companyid($companyid){
		$this->fields[Bookcompanies::COMPANYID]  = $companyid;
	}

	public function get_companyname(){
		return $this->fields[Bookcompanies::COMPANYNAME];
	}

	public function set_companyname($company_name){
		$this->fields[Bookcompanies::COMPANYNAME] = $company_name;
	}

}

?>
