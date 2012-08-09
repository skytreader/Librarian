<?php

require_once(APPPATH . "app_constants.php");
require_once(ARC_CONSTANTS_PATH . "architecture_constants.php");
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
	
	TODO: How do we abstract this?
	*/
	public function index(){
		$this->load->model("dao/Librarians");
		$this->load->library("session");
		$this->load->database(BOOKS_DSN);
		
		$is_logged_in = $this->session->userdata(SESSION_LOGGED_IN);
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$password = hash(HASH_FUNCTION, $password);
		
		$this->Librarians->set_username($username);
		$this->Librarians->set_password($password);
		
		$is_verified = $this->Librarians->check_login_cred($username, $password);
		
		if(!$is_logged_in && $is_verified){
			$user_session[SESSION_USERNAME] = $_POST["username"];
			$user_session[SESSION_LOGGED_IN] = TRUE;
			
			// Get the librarianid and make a session var out of it.
			$librarianid_result = $this->Librarians->select("librarianid", "username = ?", "LIMIT 1");
			$result_array = $librarianid_resutl->result_array();
			$user_session[SESSION_LIBRARIAN_ID] = $result_array("librarianid");
			
			$this->session->set_userdata($user_session);
			$is_logged_in = TRUE;
			$this->display_logged_in_view();
		} elseif($is_logged_in){
			$this->display_logged_in_view();
		} elseif($is_logged_in == false){
			log_message("debug", "Not logged in");
			log_message("debug", "Check is_logged_in: " . isset($is_logged_in));
			parent::login_check();
		} elseif(!$is_verified){
			log_message("debug", "Wrong password");
			log_message("debug", "Check is_logged_in:" .isset($is_logged_in));
			//Just load some views here.
			$this->load->helper("url");
			redirect("login/fail");
		}
	}
	
	private function display_logged_in_view(){
		$this->data_bundle["echo_content"] = TRUE;
		$this->data_bundle["content"] = "<h1>Welcome to your Dashboard</h1>";
		$this->data_bundle["title"] = "Dashboard";
		$this->data_bundle["logged_in"] = TRUE;
		$this->load->helper("url");
		$this->load->view("mainview", $this->data_bundle);
	}
}

?>
