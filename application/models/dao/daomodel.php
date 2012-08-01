<?php

/**
General handler for single-table database transactions.

To do a query, instantiate a DAO object and then set the fields
affected by your query. Afterwards, call one of the DB query
methods of that DAO object. See the documentation of said function
for details on how they'll use the DAO properties.

This class automatically loads QueryStringUtils upon construction.
*/
class DAOModel extends CI_Model{
	const TIMESTAMP = "timestamp";
	const LAST_UPDATER = "last_updater";
	
	protected $table_name;
	/**
	A hash map with table names as keys, mapping the values.
	*/
	protected $fields;
	
	public function __construct(){
		$fields = array(DAOModel::TIMESTAMP => null, DAOModel::LAST_UPDATER => null);
		$this->load->model("QueryStringUtils");
	}
	
	public function get_timestamp(){
		return $fields[DAOModel::TIMESTAMP];
	}
	
	public function set_timestamp($ts){
		$fields[DAOModel::TIMESTAMP] = $ts;
	}
	
	public function get_last_updater(){
		return $fields[DAOModel::LAST_UPDATER];
	}
	
	public function set_last_updater($lu){
		$fields[DAOModel::LAST_UPDATER] = $lu;
	}
	
	public function get_table_name(){
		return $table_name;
	}
	
	/**
	Inserts a record to the database.
	
	All specified fields should be in $fields and with their corresponding
	$values. Else, this function will fail.
	
	@param fields
	  The columns to insert to, comma delimited.
	
	TODO is this safe? Will PHP return the same order of keys everytime?
	*/
	public function insert($fields){
		$insert_fields = generate_insert_fields();
		$bind_vars = $this->QueryStringUtils->generate_insert_bind_vars(count($insert_fields));
		$insert_query = "INSERT INTO $table_name $insert_fields VALUES $bind_vars";
		$bind_var_vals = array();
		
		foreach($fields as $f){
			if($f != null){
				array_push($bind_var_vals, $f);
			}
		}
		
		$query_result = $this->db->query($insert_query, $bind_var_vals);
		return $query_result->result();
	}
	
	/*
	Checks every field in $fields. All non-null values are returned as a comma-
	separated list, wrapped in parentheses.
	*/
	private function generate_insert_fields(){
		$insert_fields = "(";
		
		while(list($key) = each($fields)){
			if($fields[$key] != null){
				if($insert_fields == "("){
					$insert_fields .= $key;
				} else{
					$insert_fields .= "," . $key;
				}
			}
		}
		
		$insert_fields .= ")";
		return $insert_fields;
	}
	
	/**
	Selects records from the database.
	
	@param fields
	  The columns to be searched and returned.
	@param where_clause
	  The where clause of the query, expect bind vars. The values of the
	  bind vars will be taken from the attributes of this object.
	@return The result set of the query.
	*/
	public function select($fields, $where_clause){
		$query_statement = "SELECT $fields FROM $table_name WHERE $where_clause";
		$field_names = $this->QueryStringUtils->get_field_names($where_clause);
		$bind_var_vals = array();
				
		foreach($field_names as $tn){
			array_push($bind_var_vals, $fields[$tn]);
		}
		
		$query_return = $this->db->query($query_statement, $bind_var_vals);
		return $query_return->result();
	}
	
	/**
	Updates a record to the database. Values of $set_fields and $where_fields
	are all taken from the attributes of this object.
	
	@param set_fields
	  The fields to be updated, expressed with bind vars.
	@param where_fields
	  Ideally, the primary keys. Expressed with bind vars.
	@param timestamp
	  For timestamp checking.
	
	TODO: Timestamp checking.
	*/
	public function update($set_fields, $where_fields, $timestamp){
		$query_statement = "UPDATE $table SET $set_fields WHERE $where_fields";
		$bind_var_vals = array();
		
		// Bind the set vars
		$set_field_names = $this->QueryStringUtils->get_field_names($set_fields);
		
		foreach($set_field_names as $field){
			array_push($bind_var_vals, $fields[$field]);
		}
		
		$where_field_names = $this->QueryStringUtils->get_field_names($where_fields);
		
		foreach($where_field_names as $field){
			array_push($bind_var_vals, $fields[$field]);
		}
		
		$query_return = $this->db->query($query_statement, $bind_var_vals);
		return $query_return->result();
	}
	
	/**
	Deletes a record from the database.
	
	@param where_clause
	  The where clause, expected to be in bind vars.
	*/
	public function delete($where_clause){
		$delete_query = "DELETE FROM $table_name WHERE $where_clause";
		$bind_var_vals = array();
		$fields = $this->QueryStringUtils->get_field_names($where_clause);
		
		foreach($fields as $field){
			array_push($bind_var_vals, $field);
		}
		
		$query_return = $this->db->query($delete_query, $bind_var_vals);
		return $query_return->result();
		
	}
}

?>
