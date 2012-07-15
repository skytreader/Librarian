<?php

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

class Manage extends MainController{
	
	/**
	TODO: Create you own "root controller" class which implements CI_Controller
	and automatically loads the session library and checks for logged in/logged
	out states.
	*/
	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->library("session");
		$this->is_logged_in = $this->session->userdata(SESSION_LOGGED_IN);
	}
	
	public function users(){
		
	}
	
	/**
	TODO: Check validity of ISBN input upon form submission.
	(Or, maybe, we can use JavaScript for this?)
	*/
	public function books(){
		parent::$data_bundle["title"] = "Manage Books";
		
		if($this->is_logged_in){
			parent::$data_bundle["content"] = "content/addbook.php";
			parent::$data_bundle["logged_in"] = TRUE;
		} else{
			parent::$data_bundle["content"] = "content/not_logged_in.php";
		}
		
		$this->load->library("javascript");
		$this->load->view("mainview", parent::$data_bundle);
	}
	
}

?>
