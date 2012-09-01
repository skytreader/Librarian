<?php

require_once("bookrelated.php");

class Bookparticipants extends Bookrelated{
	
	const PERSONID = "personid";
	const ISAUTHOR = "isauthor";
	const ISEDITOR = "iseditor";
	const ISTRANSLATOR = "istranslator";
	const ISILLUSTRATOR = "isillustrator";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "bookparticipants";
		$this->fields[Bookparticipants::PERSONID] = null;
		$this->fields[Bookparticipants::ISAUTHOR] = null;
		$this->fields[Bookparticipants::ISEDITOR] = null;
		$this->fields[Bookparticipants::ISTRANSLATOR] = null;
		$this->fields[Bookparticipants::ISILLUSTRATOR] = null;
		array_push($this->primary_keys, Bookrelated::ISBN);
		array_push($this->primary_keys, Bookparticipants::PERSONID);
	}
	
	public function get_personid(){
		return $this->fields[Bookparticipants::PERSONID];
	}
	
	public function set_personid($p){
		$this->fields[Bookparticipants::PERSONID] = $p;
	}
	
	public function get_isauthor(){
		return $this->fields[Bookparticipants::ISAUTHOR];
	}
	
	public function set_isauthor($is_author){
		$this->fields[Bookparticipants::ISAUTHOR] = $is_author;
	}
	
	public function get_iseditor(){
		return $this->fields[Bookparticipants::ISEDITOR];
	}
	
	public function set_iseditor($is_editor){
		$this->fields[Bookparticipants::ISEDITOR] = $is_editor;
	}
	
	public function get_istranslator(){
		return $this->fields[Bookparticipants::ISTRANSLATOR];
	}
	
	public function set_istranslator($is_translator){
		$this->fields[Bookparticipants::ISTRANSLATOR] = $is_translator;
	}
	
	public function get_isillustrator(){
		return $this->fields[Bookparticipants::ISILLUSTRATOR];
	}
	
	public function set_isillustrator($is_illustrator){
		$this->fields[Bookparticipants::ISILLUSTRATOR] = $is_illustrator;
	}
	
	/**
	Automatically set the role in a bookparticipants record by the parameter
	$role. I.E., if $role is "isillustrator", do set_isillustrator(true).
	
	If the $role passed isn't an actual role, nothing happens.
	
	Pro tip: Just use the class constants provided.
	*/
	public function set_role($role, $val){
		if($role == Bookparticipants::ISAUTHOR ||
		  $role == Bookparticipants::ISEDITOR ||
		  $role == Bookparticipants::ISTRANSLATOR ||
		  $role == Bookparticipants::ISILLUSTRATOR){
			$this->fields[$role] = $val;
		}
	}
	
}

?>
