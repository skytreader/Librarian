<?php

require_once(APPPATH . "app_constants.php");
require_once("login.php");
require_once("maincontroller.php");

/**
This controller handles what the user will see upon
successful log in. This also handles what happens upon
log in failure.

@author Chad Estioco
*/
class Dashboard extends MainController{
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	Tests:
	  -Check behavior when visited and user is not logged in
	  -Check behavior when visited and user is logged in
	*/
	public function index(){
		$this->load->model("LoginModel");
		$this->load->library("session");
		
		$is_logged_in = $this->session->userdata(SESSION_LOGGED_IN);
		$is_verified = isset($_POST["username"]) &&
		               isset($_POST["password"]) &&
		               $this->LoginModel->verify($_POST["username"], $_POST["password"]);
		
		if(!$is_logged_in && $is_verified){
			$user_session[SESSION_USERNAME] = $_POST["username"];
			$user_session[SESSION_LOGGED_IN] = TRUE;
			
			$this->load->library("session");
			$this->session->set_userdata($user_session);
			$is_logged_in = TRUE;
			$this->display_logged_in_view();
		} elseif($is_logged_in){
			$this->display_logged_in_view();
		} elseif(!$is_verified){
			//Just load some views here.
			$this->load->helper("url");
			redirect("login/fail");
		} else{
			//User visited the dashboard URL without logging in.
		}
	}
	
	private function display_logged_in_view(){
		parent::$data_bundle["echo_content"] = TRUE;
		parent::$data_bundle["content"] = "<h1>Welcome to your Dashboard</h1>";
		parent::$data_bundle["title"] = "Dashboard";
		parent::$data_bundle["logged_in"] = TRUE;
		$this->load->helper("url");
		$this->load->view("mainview", parent::$data_bundle);
	}
}

?>
