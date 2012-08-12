<?php

require_once("daomodel.php");

class Foo extends DAOModel{
	
	const ID = "id";
	const MSG = "msg";
	
	public function __construct(){
		parent::__construct();
		$this->fields[Foo::ID] = null;
		$this->fields[Foo::MSG] = null;
		$this->table_name = "foo";
		array_push($this->primary_keys, Foo::ID);
	}
	
	public function get_id(){
		return $this->fields[Foo::ID];
	}
	
	public function set_id($id){
		$this->fields[Foo::ID] = $id;
	}
	
	public function get_msg(){
		return $this->fields[Foo::MSG];
	}
	
	public function set_msg($msg){
		$this->fields[Foo::MSG] = $msg;
	}
	
}

?>
