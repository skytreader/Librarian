<?php

require_once(APPPATH . "app_constants.php");
require_once("login.php");

class Logout extends CI_Controller{
	
	public function index(){
		$this->load->library("session");
		$logout[SESSION_LOGGED_IN] = FALSE;
		$logout[SESSION_USERNAME] = "";
		
		$this->session->set_userdata($logout);
		
		$redirect = new Login();
		$redirect->index();
	}
	
}

?>
