<?php

interface BookSearch{
	public function search();
}

class AuthorSearch implements BookSearch{
	
	define("AUTHOR_SEARCH", "SELECT * FROM books, authored WHERE authored.personid=? AND books.isbn=authored.isbn;");
	define("PERSONID_LASTNAME_SEARCH", "SELECT * FROM bookpersons WHERE lastname=?;");
	define("PERSONID_FULL_SEARCH", "SELECT * FROM bookpersons WHERE lastname=? AND firstname=?;");
	
	/**
	Assume that $authorname is unexploded---must parse!
	
	TODO: Can you write this using regular expressions?
	*/
	function __construct($authorname){
		$exploded = explode(" ", $authorname);
		$limit = count($exploded);
		$i = 0;
		
		//Consider everything but the last item in $exploded
		//as the first name of the author.
		while($i < $limit){
			$this->firstname += $i == 0 ? $exploded[$i] : " " . $exploded[$i];
			$i++;
		}
		
		$this->lastname = $exploded[$i];
	}
	
	public function search(){
		
	}

?>
