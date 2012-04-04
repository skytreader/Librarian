<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index(){
		$data["title"] = "Home";
		$data["content"] = "searchbox.php";
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	public function search($on){
		
	}
}

?>
