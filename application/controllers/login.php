<?php

require_once(APPPATH . "dbconfigs.php");
require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

/**
Handles login feature of Librarian.

@author Chad Estioco
*/
class Login extends MainController{
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	TODO: Abstract these two functions!
	*/
	public function index(){
		parent::enforce_https();
		$this->data_bundle["title"] = "Login";
		$this->data_bundle["content"] = "content/login.php";
		$this->load->helper("url");
		$this->load->view("mainview", $this->data_bundle);
	}
	
	public function fail(){
		parent::enforce_https();
		$this->data_bundle["title"] = "Login";
		$this->data_bundle["content"] = "content/login.php";//?" . FLAG_LOGIN_FAIL . "=true";
		$this->data_bundle["fail"] = TRUE;
		$this->load->helper("url");
		$this->load->view("mainview", $this->data_bundle);
	}
}

?>
