<?php

require_once("utility/resultprinter.php");
require_once(APPPATH . "app_constants.php");
require_once("maincontroller.php");

/**
This controller is for displaying the search results. The actual
controller for the search form is home.php .

The SEARCH_TYPE and SEARCH_QUERY will be passed as $_GET variables
to the index of this controller. The index then calls the function
display to "prepare" the results for a view.

TODO: Use CI's Pagination class to break down results into pages.
*/
class Search extends MainController{
	
	/**
	These constants contain the class names of the models
	which will carry out the search.
	*/
	const AUTHOR = "AuthorSearch";
	const TITLE = "TitleSearch";
	const PUBLISHER = "PublisherSearch";
	const ISBN = "ISBNSearch";
	
	/**
	These constants contain the field names of certain elements
	of the search form. All book search views should refer to this.
	*/
	const SEARCH_TYPE = "searchtype";
	const SEARCH_QUERY = "query";
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$search_method = $_GET[Search::SEARCH_TYPE];
		$search_query = $_GET[Search::SEARCH_QUERY];
		$this->display($search_method, $search_query);
	}
	
	private function display($search_method, $search_query){
		$this->load->library("session");
		$printer = new ResultPrinter();
		
		$this->load->model($search_method);
		$search_results = $this->$search_method->search($search_query)->result();
		$this->data_bundle["title"] = "Search Results";
		$this->data_bundle["echo_content"] = TRUE;
		$this->data_bundle["content"] = $printer->print_results($search_results);
		$this->data_bundle["logged_in"] = $this->session->userdata(SESSION_LOGGED_IN);
		$this->load->helper("url");
		$this->load->view("mainview", $this->data_bundle);
	}
	
	
}
?>
