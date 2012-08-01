<?php

require_once(APPPATH . "app_constants.php");
require_once("daomodel.php");

class Librarians extends DAOModel{
	
	const LIBRARIANID = "librarianid";
	const USERNAME = "username";
	const PASSWORD = "password";
	const CANREAD = "canread";
	const CANWRITE = "canwrite";
	const CANEXEC = "canexec";
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "librarians";
	}
	
	public function get_librarianid(){
		return $this->tables[Librarians::LIBRARIANID];
	}
	
	public function set_librarianid($l){
		$this->tables[Librarians::LIBRARIANID] = $l;
	}
	
	public function get_username(){
		return $this->tables[Librarians::USERNAME];
	}
	
	public function set_username($u){
		$this->tables[Librarians::USERNAME] = $u;
	}
	
	public function get_password(){
		return $this->tables[Librarians::PASSWORD];
	}
	
	public function set_password($p){
		$this->tables[Librarians::PASSWORD] = $p;
	}
	
	public function get_canread(){
		return $this->tables[Librarians::CANREAD];
	}
	
	public function set_canread($c){
		$this->tables[Librarians::CANREAD] = $c;
	}
	
	public function get_canwrite(){
		return $this->tables[Librarians::CANWRITE];
	}
	
	public function get_canexec(){
		return $this->tables[Librarians::CANEXEC];
	}
	
	public function set_canexec($c){
		$this->tables[Librarians::CANEXEC] = $c;
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
