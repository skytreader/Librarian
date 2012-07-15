<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

class Home extends MainController {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		parent::$data_bundle["title"] = "Home";
		parent::$data_bundle["content"] = "content/searchbox.php";
		
		$this->load->library("session");
		parent::$data_bundle["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		
		$this->load->helper("url");
		$this->load->view("mainview", parent::$data_bundle);
	}
	
	public function search($on){
		
	}
}

?>
