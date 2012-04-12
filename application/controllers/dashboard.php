<?php

class Dashboard extends CI_Controller{
	
	/**
	Tests:
	  -Check behavior when visited and user is not logged in
	  -Check behavior when visited and user is logged in
	*/
	public function index(){
		$this->load->model("LoginModel");
		if($this->LoginModel->verify($_POST["username"], $_POST["password"])){
			$user_session[SESSION_USERNAME] = $_POST["username"];
			$user_session[SESSION_LOGGED_IN] = TRUE;
			
			$this->load->library("session");
			$this->session->set_userdata($user_session);
		} else{
			//Just load some views here.
		}
	}
	
}

?>
