<?php

class Utils extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->library("QueryStringUtils");
	}
	
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
		$bind_vars = generate_insert_bind_vars($bind_var_count);
		$insertion = "INSERT into $table ($cols) VALUES $bind_vars;";
		return $this->db->query($insertion, $values);
	}
	
}

?>
