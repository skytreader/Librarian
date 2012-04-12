<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");
require_once(ARC_CONSTANTS_PATH . "architecture_constants.php");

class LoginModel extends CI_Model{
	
	/**
	Returns true if the username-password combination exists. Else, false.
	
	Assume that $password is not hashed yet.
	*/
	public function verify($username, $password){
		$this->load->database(DSN);
		$password = hash(HASH_FUNCTION, $password);
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
