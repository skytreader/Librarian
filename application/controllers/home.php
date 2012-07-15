<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

class Home extends MainController {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->data_bundle["title"] = "Home";
		$this->data_bundle["content"] = "content/searchbox.php";
		
		$this->load->library("session");
		$this->data_bundle["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		
		$this->load->helper("url");
		$this->load->view("mainview", $this->data_bundle);
	}
	
	public function search($on){
		
	}
}

?>
