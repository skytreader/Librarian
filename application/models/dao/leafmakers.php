<?php

require_once("bookrelated.php");

class LeafMakers extends BookRelated{
	
	const COMPANYID = "companyid";
	const ISPUBLISHER = "ispublisher";
	const ISPRINTER = "isprinter";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "leafmakers";
		$this->fields[LeafMakers::COMPANYID] = null;
		$this->fields[LeafMakers::ISPUBLISHER] = null;
		$this->fields[LeafMakers::ISPRINTER] = null;
		array_push($this->primary_keys, BookRelated::ISBN, LeafMakers::COMPANYID);
	}
	
	public function get_companyid(){
		return $this->fields[LeafMakers::COMPANYID];
	}
	
	public function set_companyid($companyid){
		$this->fields[LeafMakers::COMPANYID] = $companyid;
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
	
}

?>
