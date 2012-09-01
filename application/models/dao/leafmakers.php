<?php

require_once("bookrelated.php");

class Leafmakers extends Bookrelated{
	
	const COMPANYID = "companyid";
	const ISPUBLISHER = "ispublisher";
	const ISPRINTER = "isprinter";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "leafmakers";
		$this->fields[Leafmakers::COMPANYID] = null;
		$this->fields[Leafmakers::ISPUBLISHER] = null;
		$this->fields[Leafmakers::ISPRINTER] = null;
		array_push($this->primary_keys, Bookrelated::ISBN, Leafmakers::COMPANYID);
	}
	
	public function get_companyid(){
		return $this->fields[Leafmakers::COMPANYID];
	}
	
	public function set_companyid($companyid){
		$this->fields[Leafmakers::COMPANYID] = $companyid;
	}
	
	public function get_ispublisher(){
		return $this->fields[LeafMaker::ISPUBLISHER];
	}
	
	public function set_ispublisher($ispublisher){
		$this->fields[LeafMaker::ISPUBLISHER] = $ispublisher;
	}
	
	public function get_isprinter(){
		return $this->fields[LeafMaker::ISPRINTER];
	}
	
	public function set_isprinter($isprinter){
		$this->fields[LeafMaker::ISPRINTER] = $isprinter;
	}
	
	/**
	Allows setting arbitrary participation fields. For best results,
	use the constants provided by this class
	*/
	public function set_role($role, $val){
		if($role == Leafmakers::ISPUBLISHER ||
		  $role == Leafmakers::ISPRINTER){
			$this->fields[$role] = $val;
		}
	}
	
}

?>
