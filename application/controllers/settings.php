<?php

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

class Settings extends MainController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		parent::login_check();
		$this->load->database(BOOKS_DSN);
		$this->load->model("dao/AppSettings");
		$this->load->model("dao/Librarians");
		$this->load->library("session");
		
		// Check first if user is super user to save time querying
		$this->Librarians->set_librarianid($this->session->userdata(SESSION_LIBRARIAN_ID));
		$this->Librarians->load();
		
		if($this->Librarians->get_canread() == 1 && $this->Librarians->get_canwrite() == 1 &&
		  $this->Librarian->get_canexec() == 1){
			$fields = "*";
			$where_clause = "1";
			$extra_specs = "";
			
			$result = $this->AppSettings->select($fields, $where_clause, $extra_specs);
			$result_array = $result->result_array();
			
			$this->data_bundle["app_settings"] = $result_array;
		}
		$this->data_bundle["title"] = "Settings";
		$this->data_bundle["content"] = "content/settings.php";
		$this->data_bundle["logged_in"] = true;
		$this->load->view("mainview", $this->data_bundle);
	}
	
}

?>
