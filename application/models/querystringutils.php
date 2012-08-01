<?php

/**
Utility functions used for making query strings.
*/
class QueryStringUtils extends CI_Model{
	
	/*
	Generates a string of the form \(\?(,\?)*\)---bind variables
	to an SQL query for CodeIgniter. The number of bind variables
	generated depends on $num .
	*/
	public static function generate_insert_bind_vars($num){
		$bind_vars = "(";
		
		for($i = 0; $i < $num; $i++){
			if($i == 0){
				$bind_vars .= "?";
			} else{
				$bind_vars .= ",?";
			}
		}
		
		$bind_vars .= ")";
		
		return $bind_vars;
	}
	
	/**
	Generates a bind clause, linked by ANDs, given the commma-
	delimited columns.
	
	@param $cols
	  The columns, comma-delimited.
	@return A bind clause for the columns, linked by ANDs.
	*/
	public static function generate_and_clause($cols){
		$col_names = explode(",", $cols);
		$limit = count($col_names);
		$bind_clause = "";
		
		for($i = 0; $i < $limit; $i++){
			if($i == 0){
				$bind_clause = $col_names[$i] . "=?";
			} else{
				$bind_clause .= " AND " . $col_names[$i] . "=?";
			}
		}
		
		return $bind_clause;
	}
	
	/**
	Returns the table names embedded in a where clause with bind vars.
	*/
	private function get_table_names($where_clause){
		preg_match("[a-zA-Z][a-zA-Z0-9_]*\s*=\s*\?", $where_clause,
			$table_names);
		
		echo $table_names[0];
		
		return $table_names;
	}
	
}

?>
