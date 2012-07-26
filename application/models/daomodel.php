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
	
}

?>
