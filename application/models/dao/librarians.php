<?php

require_once(APPPATH . "app_constants.php");
require_once("daomodel.php");

class Librarians extends DAOModel{
	
	private $librarianid;
	private $username;
	private $password;
	private $canread;
	private $canwrite;
	private $canexec;
	
	public function __construct(){
		parent::__construct();
		$this->table_name = "librarians";
	}
	
	public function get_librarianid(){
		return $librarianid;
	}
	
	public function set_librarianid($l){
		$librarianid = $l;
	}
	
	public function get_username(){
		return $username;
	}
	
	public function set_username($u){
		$username = $u;
	}
	
	public function get_password(){
		return $password;
	}
	
	public function set_password($p){
		$password = $p;
	}
	
	public function get_canread(){
		return $canread;
	}
	
	public function set_canread($c){
		$canread = $c;
	}
	
	public function get_canwrite(){
		return $canwrite;
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
