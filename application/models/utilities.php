<?php

class Utils extends CI_Model{
	
	/**
	Inserts all the values into $table.
	
	@param $table
	  The name of the table to which we insert values.
	@param $cols
	  The cols of the table, in comma-separated format, to which
	  values are specified.
	@param $values
	  An array containing the values to be inserted to the row.
	@return Boolean, depending on the success or failure of the insertion.
	*/
	public static function insert($table, $cols, $values){
		$bind_var_count = count($values);
		$bind_vars = generate_bind_vars($bind_var_count);
		$insertion = "INSERT into $table ($cols) VALUES $bind_vars;";
		return $this->db->query($insertion, $values);
	}
	
	/*
	Generates a string of the form \(\?(,\?)*\)---bind variables
	to an SQL query for CodeIgniter. The number of bind variables
	generated depends on $num .
	*/
	private static function generate_bind_vars($num){
		$bind_vars = "(";
		
		for($i = 0; $i < $num; $i++){
			if($i == 0){
				$bind_vars += "?";
			} else{
				$bind_vars += ",?";
			}
		}
		
		$bind_vars = ")";
		
		return $bind_vars;
	}
	
}

?>
