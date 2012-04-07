<?php

require_once(APPPATH . "dbconfigs.php");

/**
Searches books based on author.
*/
class AuthorSearch implements BookSearch extends CI_Model{
	
	define("AUTHOR_SEARCH", "SELECT * FROM books, authored WHERE authored.personid=? AND books.isbn=authored.isbn;");
	//TODO: Try to write these using joins.
	define("AUTHOR_LASTNAME_SEARCH", "SELECT * FROM authored, books, bookpersons WHERE bookpersons.lastname=? AND
	                                  bookpersons.personid=authored.personid AND authored.isbn=books.isbn;");
	define("AUTHOR_FULL_SEARCH", "SELECT * FROM authored, bookpersons, books WHERE bookpersons.lastname=? AND
	                              bookpersons.firstname=? AND authored.personid=bookpersons.personid AND
	                              authored.isbn=books.isbn;");
	
	/**
	Assume that $authorname is unexploded---must parse!
	
	TODO: Can you write this using regular expressions?
	*/
	function __construct(){
		parent::__construct();
	}
	
	public function search($authorname){
		$exploded = explode(" ", $authorname);
		$limit = count($exploded);
		$i = 0;
		
		//Consider everything but the last item in $exploded
		//as the first name of the author.
		while($i < $limit){
			$firstname += $i == 0 ? $exploded[$i] : " " . $exploded[$i];
			$i++;
		}
		
		$lastname = $exploded[$i];
		
		global $dbconfigs;
		$this->load->database($dbconfigs);
		
		if($firstname == null){
			//Lastname-only search
			$author_query = $this->db->query(AUTHOR_LASTNAME_SEARCH, array($lastname));
		} else{
			//Search using both lastname and firstname
			$author_query = $this->db->query(PERSONID_FULL_SEARCH, array($lastname, $firstname));
		}
		
		return $author_query->result();
	}
}
?>
