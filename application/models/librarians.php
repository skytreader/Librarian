<?php

require_once(APPPATH . "app_constants.php");
require_once("daomodel.php");

class Librarians extends DAOModel{
	
	private $librarianid;
	private $username;
	private $password;
	private $canread;
	private $canwrite;
	private $canexec;
	
	public function __construct(){
		parent::__construct()
	}
	
	public function get_librarianid(){
		return $librarianid;
	}
	
	public function set_librarianid($li){
		$librarianid = $li;
	}
	
}

?>
