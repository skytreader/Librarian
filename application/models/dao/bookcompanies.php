<?php

require_once("daomodel.php");

class BookCompanies extends DAOModel{

	const COMPANYID = "COMPANYID";
	const COMPANYNAME = "COMPANYNAME";

	public function __construct(){
		$this->table_name = "bookcompanies";
		$this->fields[BookCompanies::COMPANYID] = null;
		$this->fields[BookCompanies::COMPANYNAME] = null;
		array_push($this->primary_keys, BookCompanies::COMPANYID);
	}

	public function get_publisherid(){
		return $this->fields[BookCompanies::COMPANYID];
	}

	public function set_publisherid($companyid){
		$this->fields[BookCompanies::COMPANYID]  = $companyid;
	}

	public function get_publishername(){
		return $this->fields[BookCompanies::COMPANYNAME];
	}

	public function set_publishername($company_name){
		$this->fields[BookCompanies::COMPANYNAME] = $company_name;
	}

}

?>
