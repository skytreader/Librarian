<?php

require_once(APPPATH . "dbconfigs.php");

class Login extends CI_Controller{
	
	public function index(){
		$data["title"] = "Login";
		$data["content"] = "content/login.php";
		$this->load->helper("url");
		$this->load->view("mainview", $data);
	}
	
	public function dashboard(){
		$this->load->model("LoginModel");
		if($this->LoginModel->verify($_POST["username"], $_POST["password"])){
			echo "Login success!";
		} else{
			echo "Login failed";
		}
	}
	
}

?>
