<?php

require_once("bookrelated.php");

class BookParticipants extends BookRelated{
	
	const PERSONID = "personid";
	const ISAUTHOR = "isauthor";
	const ISEDITOR = "iseditor";
	const ISTRANSLATOR = "istranslator";
	const ISILLUSTRATOR = "isillustrator";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "authored";
		$this->fields[BookParticipants::PERSONID] = null;
		$this->fields[BookParticipants::ISAUTHOR] = null;
		$this->fields[BookParticipants::ISEDITOR] = null;
		$this->fields[BookParticipants::ISTRANSLATOR] = null;
		$this->fields[BookParticipants::ISILLUSTRATOR] = null
		array_push($this->primary_keys, BookRelated::ISBN);
		array_push($this->primary_keys, Authored::PERSONID);
	}
	
	public function get_personid(){
		return $this->fields[BookParticipants::PERSONID];
	}
	
	public function set_personid($p){
		$this->fields[BookParticipants::PERSONID] = $p;
	}
	
	public function get_isauthor(){
		return $this->fields[BookParticipants::ISAUTHOR];
	}
	
	public function set_isauthor($is_author){
		$this->fields[BookParticipants::ISAUTHOR] = $is_author;
	}
	
	public function get_iseditor(){
		return $this->fields[BookParticipants::ISEDITOR];
	}
	
	public function set_iseditor($is_editor){
		$this->fields[BookParticipants::ISEDITOR] = $is_editor;
	}
	
	public function get_istranslator(){
		return $this->fields[BookParticipants::ISTRANSLATOR];
	}
	
	public function set_istranslator($is_translator){
		$this->fields[BookParticipants::ISTRANSLATOR] = $is_translator;
	}
	
	public function get_isillustrator(){
		return $this->fields[BookParticipants::ISILLUSTRATOR];
	}
	
	public function set_isillustrator($is_illustrator){
		$this->fields[BookParticipants::ISILLUSTRATOR] = $is_illustrator;
	}
	
	/**
	Automatically set the role in a bookparticipants record by the parameter
	$role. I.E., if $role is "isillustrator", do set_isillustrator(true).
	
	If the $role passed isn't an actual role, nothing happens.
	
	Pro tip: Just use the class constants provided.
	*/
	public function set_role($role, $val){
		if($role == BookParticipants::ISAUTHOR ||
		  $role == BookParticipants::ISEDITOR ||
		  $role == BookParticipants::ISTRANSLATOR ||
		  $role == BookParticipants::ISILLUSTRATOR){
			$this->fields[$role] = $val;
		}
	}
	
}

?>
