<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");
require_once(ARC_CONSTANTS_PATH . "architecture_constants.php");

class Login extends CI_Controller{
	
	public function index(){
		$data["title"] = "Login";
		$data["content"] = "login.php";
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	/**
	Returns true if the username-password combination exists. Else, false.
	
	Assume that $password is not hashed yet.
	*/
	public function verify($username, $password){
		global $dbconfigs;
		$this->load->database($dbconfigs);
		$password = hash(HASH_FUNCTION, $password);
		$user_query = "SELECT * FROM librarians WHERE username = ? AND password = ?;";
		$query_result = $this->db->query($user_query, array($username, $password));
		
		if($query_result->num_rows() == 1){
			return TRUE;
		} else{
			return FALSE;
		}
	}
}

?>
