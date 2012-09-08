<?php

require_once(APPPATH . "app_constants.php");

/**
General handler for single-table database transactions.

To do a query, instantiate a DAO object and then set the fields
affected by your query. Afterwards, call one of the DB query
methods of that DAO object. See the documentation of said function
for details on how they'll use the DAO properties.

This class automatically loads QueryStringUtils upon construction.
*/
class Daomodel extends CI_Model{
	const TIMESTAMP = "lastupdate";
	const LAST_UPDATER = "lastupdateby";
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
	Default is true.
	*/
	protected $autocommit;
	
	public function __construct(){
		$this->fields = array(Daomodel::TIMESTAMP => null, Daomodel::LAST_UPDATER => null);
		$this->load->model("QueryStringUtils");
		$this->primary_keys = array();
		$this->autocommit = true;
	}
	
	public function get_timestamp(){
		return $this->fields[Daomodel::TIMESTAMP];
	}
	
	public function set_timestamp($ts){
		$this->fields[Daomodel::TIMESTAMP] = $ts;
	}
	
	public function get_last_updater(){
		return $this->fields[Daomodel::LAST_UPDATER];
	}
	
	public function set_last_updater($lu){
		$this->fields[Daomodel::LAST_UPDATER] = $lu;
	}
	
	public function get_table_name(){
		return $table_name;
	}
	
	/**
	Checks if all primary keys have non-null values.
	*/
	protected function are_pks_set(){
		foreach($this->primary_keys as $pk){
			if($this->fields[$pk] == null){
				return false;
			}
		}
		
		return true;
	}
	
	/**
	Converts the PKs array to a comma-delimited list, as for
	the fields requirements of the functions in this class.
	*/
	private function pks_fields(){
		$csl = "";
		$first = true;
		
		foreach($this->primary_keys as $pk){
			if($csl == ""){
				$csl .= $pk;
			} else{
				$csl .= ",$pk";
			}
		}
		
		return $csl;
	}
	
	/*
	Returns a string featuring each primary key, bind var-ed, in conjunctive form.
	*/
	private function pk_condition(){
		$cond = "";
		
		foreach($this->primary_keys as $pk){
			if($cond == ""){
				$cond .= "$pk = ?";
			} else{
				$cond .= " AND $pk =?";
			}
		}
		
		return $cond;
	}
	
	/**
	Assuming that the primary keys have been set, this function loads
	the invoking Daomodel instance with all the values of the row as
	described by the PKs.
	*/
	public function load(){
		if($this->are_pks_set()){
			$pk_fields = $this->pks_fields();
			
			$query = $this->select("*", $this->pk_condition(), "");
			$row = $query->row_array();
			
			$fields = array_keys($this->fields);
			
			foreach($fields as $f){
				$this->fields[$f] = $row[$f];
			}
		} else{
			throw new Exception(Daomodel::PK_EXCEPTION_MESSAGE);
		}
	}
	
	/**
	Checks if a certain combination of values (not necessarily primary
	keys) exists in the table.
	
	@param where_clause
	  The where clause, expected as bind vars. The values are taken from the
	  attributes of the invoking Daomodel.
	*/
	public function check_exists($where_clause){
		$query = $this->select("*", $where_clause, "LIMIT 1");
		return $query->num_rows() == 1;
	}
	
	/**
	Inserts a record to the database.

	@param fields
	  The columns to insert to, comma delimited.
	
	TODO is this safe? Will PHP return the same order of keys everytime?
	TODO should we still check if all pks are set?
	If PKs are not set, won't this just throw an exception anyway? So it seems
	pointless to check and throw our own exception.
	*/
	public function insert($fields){
		$data_map = $this->get_query_data_map($fields);
		$insert_query = $this->db->insert_string($this->table_name, $data_map);
		
		return $this->db->query($insert_query);
	}
	
	/**
	Returns an associative array with each column in $fields as key and
	their corresponding values, as set in the invoking Daomodel as values.
	
	@param fields
	  The keys of the return array, as a comma-delimited string.
	@return An associative array with each column as specified in $fields
	as key and the values taken from the attributes of the calling Daomodel.
	*/
	private function get_query_data_map($fields){
		$field_parse = preg_split("/\\s*,\\s*/", $fields);
		$data_map = array();
		
		foreach($field_parse as $field){
			$data_map[$field] = $this->fields[$field];
		}
		
		return $data_map;
	}
	
	/*
	Checks every field in $fields. All non-null values are returned as a comma-
	separated list, wrapped in parentheses.
	*/
	private function generate_insert_fields(){
		$insert_fields = "(";
		
		while(list($key) = each($this->fields)){
			if($this->fields[$key] != null){
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
		$timestamp_resultset = $this->select(Daomodel::TIMESTAMP, $where_clause, "LIMIT 1");
		$timestamp_array = $timestamp_resultset->row_array();
		
		return $timestamp_array[Daomodel::TIMESTAMP];
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
		if(!$this->autocommit){
			$this->db->query("START TRANSACTION");
		}
		
		$lock_query = "SELECT 1 FROM " . $this->table_name . " WHERE $where_clause FOR UPDATE";
		$field_names = $this->QueryStringUtils->get_field_names($where_clause);
		$bind_var_vals = array();
		
		foreach($field_names as $field){
			array_push($bind_var_vals, $this->fields[$field]);
		}
		
		$this->db->query($lock_query, $bind_var_vals);
	}
	
	public function commit(){
		return $this->db->query("commit");
	}
	
	/*
	Returns the current timestamp from the database server.
	
	TODO What if this query fails?
	*/
	private function get_db_timestamp(){
		$query = $this->db->query("SELECT CURRENT_TIMESTAMP");
		$query_row = $query->row_array();
		return $query_row["CURRENT_TIMESTAMP"];
	}
	
	/**
	Updates a record to the database. Values of $set_fields are all taken
	from the attributes of this object. The invoking Daomodel must have all
	its PKs set.
	
	This automatically updates the timestamp field of the record concerned
	---no need to specift in $set_fields (though it wouldn't hurt to do so).
	The record is also automatically locked before the timestamps are compared.
	If the timestamps are different, the lock is released (by "commit") before
	and exception is thrown.
	
	@param set_fields
	  The fields to be updated, expressed as a comma-delimited string.
	@param timestamp
	  For timestamp checking.
	*/
	public function update($set_fields, $timestamp){
		$where_fields = $this->pk_condition();
		$this->lock($where_fields);
		
		if(!$this->are_pks_set()){
			throw new Exception(Daomodel::PK_EXCEPTION_MESSAGE);
		}else if($this->get_current_timestamp($where_fields) != $timestamp){
			$this->db->query("commit");
			throw new Exception(Daomodel::TIMESTAMP_EXPIRED_MESSAGE);
		}
		
		$timestamp_in_set_fields = strpos($set_fields, Daomodel::TIMESTAMP);
		
		if($timestamp_in_set_fields === false){
			$set_fields .= "," . Daomodel::TIMESTAMP;
			// It's alright that we have a bit of discrepancy between the timestamp
			// set and the actual moment we update the record since the record is
			// now locked.
			// TODO What if this query fails?
			$this->set_timestamp($this->get_db_timestamp());
		}
		
		$data_map = $this->get_query_data_map($set_fields);
		
		$query_statement = $this->db->update_string($this->table_name, $data_map, $where_fields);
		$bind_var_vals = array();
		
		// Bind the set vars
		$set_field_names = $this->QueryStringUtils->get_field_names($set_fields);
		
		foreach($set_field_names as $field){
			array_push($bind_var_vals, $fields[$field]);
		}
		
		$where_field_names = $this->QueryStringUtils->get_field_names($where_fields);
		
		foreach($where_field_names as $field){
			array_push($bind_var_vals, $this->fields[$field]);
		}
		
		$query_return = $this->db->query($query_statement, $bind_var_vals);
		return $this->db->query($query_statement, $bind_var_vals);
	}
	
	/**
	Deletes a record from the database.
	
	@param where_clause
	  The where clause, expected to be in bind vars.
	*/
	public function delete($timestamp){
		$where_clause = $this->pk_condition();
		
		if(!are_pks_set()){
			throw new Exception(Daomodel::PK_EXCEPTION_MESSAGE);
		}else if(get_current_timestamp($where_clause) != $timestamp){
			throw new Exception(Daomodel::TIMESTAMP_EXPIRED_MESSAGE);
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
