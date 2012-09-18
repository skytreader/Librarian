<?php

require_once(APPPATH . "app_constants.php");
require_once(APPPATH . "architecture_constants.php");
require_once("maincontroller.php");

class Settings extends MainController{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		parent::login_check();
		$this->load->database(BOOKS_DSN);
		$this->load->model("dao/Librarians");
		$this->load->library("session");
		
		array_push($this->data_bundle["scripts"], JQUERY_PATH, "jquery.validate.min.js", "settings/ready.js");
		
		// Check first if user is super user to save time querying
		$this->Librarians->set_librarianid($this->session->userdata(SESSION_LIBRARIAN_ID));
		$this->Librarians->load();
		
		$this->change_password($this->Librarians);
		$this->change_user_settings();
		
		if($this->Librarians->get_canread() == 1 && $this->Librarians->get_canwrite() == 1 &&
		  $this->Librarians->get_canexec() == 1){
			$this->data_bundle["app_settings"] = $this->get_app_settings();
		}
		$this->data_bundle["title"] = "Settings";
		$this->data_bundle["content"] = "content/settings.php";
		$this->data_bundle["logged_in"] = true;
		$this->data_bundle["user"] = $this->Librarians;
		$this->load->view("mainview", $this->data_bundle);
	}
	
	/**
	Returns a result array of all the items in the appsettings table.
	*/
	private function get_app_settings(){
		$this->load->model("dao/AppSettings");
		$fields = "*";
		$where_clause = "1";
		$extra_specs = "";
		
		$result = $this->AppSettings->select($fields, $where_clause, $extra_specs);
		$result_array = $result->result_array();
		
		return $result_array;
	}
	
	private function change_password($user){
		if($this->input->post("change_password")){
			$error_code = $this->input->post("mc");
				
			try{
				$timestamp = $this->input->post("timestamp");
				$password = hash(HASH_FUNCTION, $this->input->post("password"));
				$new_password = hash(HASH_FUNCTION, $this->input->post("new_password"));
				$confirm_new_password = hash(HASH_FUNCTION ,$this->input->post("confirm_new_password"));
				$user->change_password($password, $new_password, $confirm_new_password, $timestamp);
				$this->data_bundle["messages"][$error_code] = "Password changed successfully.";
			} catch(Exception $e){
				$this->data_bundle["messages"][$error_code] = $e->getMessage();
			}
		}
	}
	
	private function change_user_settings(){
		if($this->input->post("save_app_settings")){
			$error_code = $this->input->post("mc");
			$this->data_bundle["messages"][$error_code] = "";
			
			try{
				$this->load->model("dao/Appsettings");
				$all_settings = $this->get_app_settings();
				$error_occurred = false;
				
				foreach($all_settings as $setting){
					$setting_code = $setting["settingcode"];
					$timestamp = $this->input->post($setting_code . "_timestamp");
					$this->Appsettings->set_settingcode($setting_code);
					$setting_value = $this->input->post($setting_code);
					$this->Appsettings->set_settingvalue($setting_value);
					try{
						$this->Appsettings->update("settingvalue", $timestamp);
					} catch(Exception $e){
						$this->data_bundle["messages"][$error_code] .= $e->getMessage();
						$error_occurred = true;
					}
				}
				
				if(!$error_occurred){
					$this->data_bundle["messages"][$error_code] .= "Settings saved.";
				}
			} catch(Exception $e){
				$this->data_bundle["messages"][$error_code] = $e->getMessage();
			}
		}
	}
	
}

?>
