<?php

class LibrarianUtilities extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->library("Utils");
		$this->load->library("QueryStringUtils");
	}
	
	/**
	Before inserting, we first check if entity already exists.
	It is only inserted if and only if it does not exist in the
	database yet.
	
	@param $entity_table
	  The table name of the entity.
	@param $cols
	  The columns, comma-delimited.
	@param values
	  The values to be inserted, in array form.
	@return Boolean, depending on whether insertion succeeded or not.
	*/
	public static function insert_entity($entity_table, $cols, $values){
		$and_bind = $this->QueryStringUtils->generate_and_clause($cols);
		$check_query = "SELECT $cols FROM $entity_table where $and_bind";
		$check_result = $this->db->query($check_query, $values);
		
		if($check_result->num_rows()){
		} else{
			$this->Utils->insert($entity_table, $cols, $values);
		}
	}
	
	/**
	Returns an associative array where each name is mapped to its corresponding
	personid in the database. For convenience, we are assuming that $persons
	is already an array of names in format Lastname, Firstname(s).
	*/
	public static function get_personids($persons){
		$query = "SELECT personid FROM bookpersons WHERE lastname = ? AND firstname = ? LIMIT 1;";
		$personids = array();
		
		foreach($persons as $name){
			if($name == "" || $name == NULL){
				continue;
			}
			
			$name_parse = explode(",", $name);
			$lastname = trim($name_parse[0]);
			$firstname = trim($name_parse[1]);
			$query_action = $this->db->query($query, array($lastname, $firstname));
			$query_result = $query_action->row();
			$personids[$name] = $query_result->personid;
		}
		
		return $personids;
	}
	
}

?>
