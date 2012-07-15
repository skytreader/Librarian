<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");

/**
Handles login feature of Librarian.

@author Chad Estioco
*/
class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	TODO: Abstract these two functions!
	*/
	public function index(){
		parent::$data_bundle["title"] = "Login";
		parent::$data_bundle["content"] = "content/login.php";
		$this->load->helper("url");
		$this->load->view("mainview", parent::$data_bundle);
	}
	
	public function fail(){
		parent::$data_bundle["title"] = "Login";
		parent::$data_bundle["content"] = "content/login.php";//?" . FLAG_LOGIN_FAIL . "=true";
		parent::$data_bundle["fail"] = TRUE;
		$this->load->helper("url");
		$this->load->view("mainview", parent::$data_bundle);
	}
}

?>
