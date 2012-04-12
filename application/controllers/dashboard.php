<?php

require_once(APPPATH . "app_constants.php");

/**
This controller handles what the user will see upon
successful log in. This also handles what happens upon
log in failure.

@author Chad Estioco
*/
class Dashboard extends CI_Controller{
	
	/**
	Tests:
	  -Check behavior when visited and user is not logged in
	  -Check behavior when visited and user is logged in
	
	TODO: Fix behavior when user returns to dashboard after initial log in.
	*/
	public function index(){
		$this->load->model("LoginModel");
		if($this->LoginModel->verify($_POST["username"], $_POST["password"])){
			$user_session[SESSION_USERNAME] = $_POST["username"];
			$user_session[SESSION_LOGGED_IN] = TRUE;
			
			$this->load->library("session");
			$this->session->set_userdata($user_session);
			
			$page_data["echo_content"] = TRUE;
			$page_data["content"] = "<h1>Welcome to your Dashboard</h1>";
			$page_data["title"] = "Dashboard";
			$page_data["logged_in"] = TRUE;
			$this->load->helper("url");
			$this->load->view("mainview", $page_data);
		} else{
			//Just load some views here.
			echo "Log-in failed.";
		}
	}
	
}

?>
