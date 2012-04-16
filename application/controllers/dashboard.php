<?php

require_once(APPPATH . "app_constants.php");
require_once("login.php");

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
	*/
	public function index(){
		$this->load->model("LoginModel");
		$this->load->library("session");
		
		$is_logged_in = $this->session->userdata(SESSION_LOGGED_IN);
		
		if(!$is_logged_in && $this->LoginModel->verify($_POST["username"], $_POST["password"])){
			$user_session[SESSION_USERNAME] = $_POST["username"];
			$user_session[SESSION_LOGGED_IN] = TRUE;
			
			$this->load->library("session");
			$this->session->set_userdata($user_session);
			$is_logged_in = TRUE;
		} else{
			//Just load some views here.
			$this->load->helper("url");
			redirect("login/fail");
		}
		
		if($is_logged_in){
			$page_data["echo_content"] = TRUE;
			$page_data["content"] = "<h1>Welcome to your Dashboard</h1>";
			$page_data["title"] = "Dashboard";
			$page_data["logged_in"] = TRUE;
			$this->load->helper("url");
			$this->load->view("mainview", $page_data);
		}
	}
	
}

?>
