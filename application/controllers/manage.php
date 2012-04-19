<?php

require_once(APPPATH . "app_constants.php");

class Manage extends CI_Controller{
	
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
	
	public function books(){
		$view_data["title"] = "Manage Books";
		
		if($this->is_logged_in){
			$view_data["content"] = "content/addbook.php";
			$view_data["logged_in"] = TRUE;
		} else{
			$view_data["content"] = "content/not_logged_in.php";
		}
		
		$this->load->view("mainview", $view_data);
	}
	
}

?>
