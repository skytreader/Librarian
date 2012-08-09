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
	const PK_EXCEPTION_MESSAGE = "Not all primary keys are set.";
	const TIMESTAMP_EXPIRED_MESSAGE = "You don't have the most recent copy of this record.";
	
	protected $table_name;
	/**
	A hash map with field names as keys, mapping the values.
	*/
	protected $fields;
	/**
	An array containing the primary keys of the table represented.
	Contents of this array must be valid keys for $fields.
	*/
	protected $primary_keys;
	/**
	If set to true, every update and delete transaction commits automatically.
	Default is true;
	*/
	protected $autocommit;
	
	public function __construct(){
		$this->fields = array(DAOModel::TIMESTAMP => null, DAOModel::LAST_UPDATER => null);
		$this->load->model("QueryStringUtils");
		$this->primary_keys = array();
		$this->autocommit = true;
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
	Checks if all primary keys have non-null values.
	*/
	private function are_pks_set(){
		foreach($primary_keys as $pk){
			if($fields[$pk] == null){
				return false;
			}
		}
		
		return true;
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
		
		return $this->db->query($insert_query, $bind_var_vals);
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
	  
	  Never pass an empty/whitespace string for this parameter. If you
	  don't need any where conditions, pass in "1".
	@param extra_specs
	  Conditions like ORDER BY, LIMIT, etc.
	@return The result set of the query.
	*/
	public function select($fields, $where_clause, $extra_specs){
		$table_name = $this->table_name;
		$query_statement = "SELECT $fields FROM $table_name WHERE $where_clause $extra_specs";
		$field_names = $this->QueryStringUtils->get_field_names($where_clause);
		$bind_var_vals = array();
				
		foreach($field_names as $fn){
			array_push($bind_var_vals, $this->fields[$fn]);
		}
		
		return $this->db->query($query_statement, $bind_var_vals);
	}
	
	/**
	Assumes that where_clause pertains to one and only one record.
	*/
	private function get_current_timestamp($where_clause){
		$timestamp_resultset = select(TIMESTAMP, $where_clause, "LIMIT 1");
		$timestamp_array = $timestamp_resultset->result_array();
		
		return $timestamp_array[TIMESTAMP];
	}
	
	/**
	Starts a transaction (effectively disabling the autocommit feature of
	MySQL) and locks the record represented by this class.
	
	@param where_clause
	  The where clause, expected to be in bind vars. Values will be taken
	  from the attributes of this object.
	@return TODO What to do if locking fails?
	*/
	public function lock($where_clause){
		if(!$autocommit){
			$this->db->query("START TRANSACTION");
		}
		
		$lock_query = "SELECT 1 FROM $table_name WHERE $where_clause FOR UPDATE";
		$field_names = $this->QueryStringUtils->get_field_names($where_clause);
		$bind_var_vals = array();
		
		foreach($field_names as $field){
			array_push($bind_var_vals, $fields[$field]);
		}
		
		$this->db->query($lock_query, $bind_var_vals);
	}
	
	public function commit(){
		return $this->db->query("commit");
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
		if(!are_pks_set()){
			throw new Exception(PK_EXCEPTION_MESSAGE);
		}else if(get_current_timestamp($where_fields) != $timestamp){
			throw new Exception(TIMESTAMP_EXPIRED_MESSAGE);
		}
		
		lock($where_fields);
		
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
		return $this->db->query($query_statement, $bind_var_vals);
	}
	
	/**
	Deletes a record from the database.
	
	@param where_clause
	  The where clause, expected to be in bind vars.
	*/
	public function delete($where_clause, $timestamp){
		if(!are_pks_set()){
			throw new Exception(PK_EXCEPTION_MESSAGE);
		}else if(get_current_timestamp($where_clause) != $timestamp){
			throw new Exception(TIMESTAMP_EXPIRED_MESSAGE);
		}
		
		lock($where_clause);
		
		$delete_query = "DELETE FROM $table_name WHERE $where_clause";
		$bind_var_vals = array();
		$fields = $this->QueryStringUtils->get_field_names($where_clause);
		
		foreach($fields as $field){
			array_push($bind_var_vals, $field);
		}
		
		return $this->db->query($delete_query, $bind_var_vals);
	}
}

?>
