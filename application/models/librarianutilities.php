<?php

class LibrarianUtilities extends CI_Model{
	
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
		$and_bind = generateAndClause($cols);
		$check_query = "SELECT $cols FROM $entity_table where";
	}
	
	/**
	Generates a bind clause, linked by ANDs, given the commma-
	delimited columns.
	
	When unit-testing, set this to public. Else, this _must_ be
	private.
	
	@param $cols
	  The columns, comma-delimited.
	@return A bind clause for the columns, linked by ANDs.
	*/
	private static function generate_and_clause($cols){
		$col_names = explode(",", $cols);
		$limit = count($col_names);
		$bind_clause = "";
		
		for($i = 0; $i < $limit; $i++){
			if($i == 0){
				$bind_clause = $col_names[$i] . "=?";
			} else{
				$bind_clause = " AND " . $col_names[$i] . "=?";
			}
		}
		
		return $bind_clause;
	}
	
}

?>
