<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . "app_constants.php");

class Home extends CI_Controller {
	
	public function index(){
		$data["title"] = "Home";
		$data["content"] = "content/searchbox.php";
		
		$this->load->library("session");
		$data["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	public function search($on){
		
	}
}

?>
