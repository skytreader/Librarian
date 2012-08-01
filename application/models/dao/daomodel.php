<?php

class DAOModel extends CI_Model{
	
	const TIMESTAMP = "timestamp";
	const LAST_UPDATER = "last_updater";
	
	protected $table_name;
	/**
	A hash map with table names as keys, mapping the values.
	*/
	protected $tables;
	
	public function __construct(){
		$tables = array(DAOModel::TIMESTAMP => null, DAOModel::LAST_UPDATER => null);
	}
	
	public function get_timestamp(){
		return $tables[DAOModel::TIMESTAMP];
	}
	
	public function set_timestamp($ts){
		$tables[DAOModel::TIMESTAMP] = $ts;
	}
	
	public function get_last_updater(){
		return $tables[DAOModel::LAST_UPDATER];
	}
	
	public function set_last_updater($lu){
		$tables[DAOModel::LAST_UPDATER] = $lu;
	}
	
	public function get_table_name(){
		return $table_name;
	}
	
	/**
	Inserts a record to the database.
	
	All required fields should be in $fields and with their corresponding
	$values. Else, this function will fail.
	
	@param fields
	  The columns to insert to, comma delimited.
	@param values
	  The values to be inserted, as an array.
	*/
	public function insert($fields, $values){
	}
	
	/**
	Selects records from the database.
	
	@param fields
	  The columns to be searched and returned.
	@param where_clause
	  The where clause of the query, expect bind vars.
	@return The result set of the query.
	*/
	public function select($fields, $where_clause){
		$query_statement = "SELECT $fields FROM $table_name WHERE $where_clause";
		$query_return = $this->db->query($query);
		return $query_return->result();
	}
	
	/**
	Updates a record to the database.
	
	@param fields
	  The fields to be updated.
	@param values
	  The new values to the fields to be updated.
	@param wherefields
	  Ideally, the primary keys.
	@param wherevals
	  The corresponding values to wherefields.
	@param timestamp
	  For timestamp checking.
	*/
	public function update($fields, $values, $wherefields, $wherevals, $timestamp){
	}
	
	/**
	Deletes a record from the database.
	*/
	public function delete($fields, $values){
	}
}

?>
