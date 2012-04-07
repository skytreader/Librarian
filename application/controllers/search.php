<?php

class Search extends CI_Controller{
	
	/**
	These constants will contain the class names of the models
	which will carry out the search.
	*/
	const AUTHOR = "AuthorSearch";
	const TITLE = "TitleSearch";
	const PUBLISHER = "PublisherSearch";
	
	public function display($search_method, $search_query){
		$this->load->model($search_method);
	}
}
?>
