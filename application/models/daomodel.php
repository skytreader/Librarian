<?php

class DAOModel extends CI_Model{
	
	protected $timestamp;
	protected $last_updater;
	
	public function __construct(){
	}
	
	public function get_timestamp(){
		return $timestamp;
	}
	
	public function set_timestamp($ts){
		$timestamp = $ts;
	}
	
	public function get_last_updater(){
		return $last_updater;
	}
	
	public function set_last_updater($lu){
		$last_updater = $lu;
	}
	
	/**
	Inserts a record to the database.
	
	All required fields should be in $fields and with their corresponding
	$values. Else, this function will fail.
	
	TODO: Format for $fields and $values?
	*/
	public function insert($fields, $values){
	}
	
	/**
	Selects a record from the database.
	
	TODO: What will this function return?
	*/
	public function select($fields){
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
