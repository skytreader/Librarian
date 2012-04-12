<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");

/**
Handles login feature of Librarian.
*/
class Login extends CI_Controller{
	
	public function index(){
		$data["title"] = "Login";
		$data["content"] = "content/login.php";
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	public function dashboard(){
		
	}
	
}

?>
