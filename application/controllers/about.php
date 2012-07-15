<?php

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

/**
The about page. Just text.

@author Chad Estioco
*/
class About extends MainController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		parent::$data_bundle["title"] = "About";
		parent::$data_bundle["content"] = "content/about.php";
		
		$this->load->library("session");
		parent::$data_bundle["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		
		$this->load->helper("url");
		$this->load->view("mainview", parent::$data_bundle);
	}
	
}

?>
