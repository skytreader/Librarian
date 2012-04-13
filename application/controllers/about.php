<?php

require_once(APPPATH . "app_constants.php");

/**
The about page. Just text.

@author Chad Estioco
*/
class About extends CI_Controller{
	
	public function index(){
		$page_data["title"] = "About";
		$page_data["content"] = "content/about.php";
		
		$this->load->library("session");
		$page_data["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		
		$this->load->helper("url");
		$this->load->view("mainview", $page_data);
	}
	
}

?>
