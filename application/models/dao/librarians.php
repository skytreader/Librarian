<?php

require_once(APPPATH . "app_constants.php");
require_once("daomodel.php");

class Librarians extends DAOModel{
	
	// TODO Map these keys in $this->tables
	const LIBRARIANID = "librarianid";
	const USERNAME = "username";
	const PASSWORD = "password";
	const CANREAD = "canread";
	const CANWRITE = "canwrite";
	const CANEXEC = "canexec";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "librarians";
		array_push($primary_keys, LIBRARIANID);
	}
	
	public function get_librarianid(){
		return $this->fields[Librarians::LIBRARIANID];
	}
	
	public function set_librarianid($l){
		$this->fields[Librarians::LIBRARIANID] = $l;
	}
	
	public function get_username(){
		return $this->fields[Librarians::USERNAME];
	}
	
	public function set_username($u){
		$this->fields[Librarians::USERNAME] = $u;
	}
	
	public function get_password(){
		return $this->fields[Librarians::PASSWORD];
	}
	
	public function set_password($p){
		$this->fields[Librarians::PASSWORD] = $p;
	}
	
	public function get_canread(){
		return $this->fields[Librarians::CANREAD];
	}
	
	public function set_canread($c){
		$this->fields[Librarians::CANREAD] = $c;
	}
	
	public function get_canwrite(){
		return $this->fields[Librarians::CANWRITE];
	}
	
	public function get_canexec(){
		return $this->fields[Librarians::CANEXEC];
	}
	
	public function set_canexec($c){
		$this->fields[Librarians::CANEXEC] = $c;
	}
	
	public function check_login_cred($username, $password){
		$user_query = "SELECT * FROM librarians WHERE username = ? AND password = ? LIMIT 1;";
		$query_result = $this->db->query($user_query, array($username, $password));
		
		if($query_result->num_rows() == 1){
			return TRUE;
		} else{
			return FALSE;
		}
	}
}

?>
