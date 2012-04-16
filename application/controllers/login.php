<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");

/**
Handles login feature of Librarian.

@author Chad Estioco
*/
class Login extends CI_Controller{
	
	/**
	TODO: Abstract these two functions!
	*/
	public function index(){
		$data["title"] = "Login";
		$data["content"] = "content/login.php";
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	public function fail(){
		$data["title"] = "Login";
		$data["content"] = "content/login.php";//?" . FLAG_LOGIN_FAIL . "=true";
		$data["fail"] = TRUE;
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
}

?>
