<?php

require_once(APPPATH . "app_constants.php");
require_once("login.php");

class Logout extends CI_Controller{
	
	public function index(){
		$this->load->helper("url");
		$this->load->library("session");
		$logout[SESSION_LOGGED_IN] = "";
		$logout[SESSION_USERNAME] = "";
		
		$this->session->unset_userdata($logout);
		
		redirect("login");
	}
	
}

?>
