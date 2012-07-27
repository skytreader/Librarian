<?php

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

class Manage extends MainController{
	
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
		$this->data_bundle["title"] = "Manage Books";
		array_push($this->data_bundle["scripts"], "manage/globals.js", "jquery.js", "jquery.validate.min.js",
			"manage/ready.js", "isbn_verify.js");
		
		parent::login_check();
		
		$this->data_bundle["content"] = "content/addbook.php";
		$this->data_bundle["logged_in"] = TRUE;
		
		$this->load->library("javascript");
		$this->load->view("mainview", $this->data_bundle);
	}
	
}

?>
