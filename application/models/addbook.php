<?php

require_once(APPPATH . "app_constants.php");

/**
Model that handles all the add functions in Librarian.

TODO: Examine query results and react accordingly for errors, etc.
TODO: Not all names may be parseable as firstname, lastname. This is
a western concept. Handle this.
*/
class Addbook extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->library("Utils");
		$this->load->library("LibrarianUtilities");
	}
	
	/**
	Expects an associative array/hash map of the book's data.
	
	Expected keys are: isbn, title, genre, authors, illustrators, editors,
	translators, publisher, printer, year.
	*/
	public function add($book_data){
	        $isbn = $book_data["isbn"];
	        $title = $book_data["title"];
	        $genre = $book_data["genre"];
	        $authors = $book_data["authors"];
	        $illustrators = $book_data["illustrators"];
	        $editors = $book_data["editors"];
	        $translators = $book_data["translators"];
	        $publisher = $book_data["pusblisher"];
	        $printer = $book_data["printer"];
	        $year = $book_data["year"];
	        
	        try{
				$this->load->database(BOOKS_DSN);
				
				// Non-person tables only, since authors, illustrators, et.al.,
				// need special parsing.
				$entity_tables = array("books", "bookpersons", "publishers", "printers", "genres");
				$entity_cols = array("isbn,title", "lastname,firstname", "publishername",
					"printername", "genrename");
				$array_vals = array(array($isbn,$title), array($lastname,$firstname),
					array($publisher), array($printer), array($genre));
				
				//Insert book into the database
				$this->Utils->insert("books", "isbn,title", array($isbn, $title));
				//Insert persons into the database
				$this->insert_persons($authors);
				$this->insert_persons($illustrators);
				$this->insert_persons($editors);
				
				$this->LibrarianUtilities->insert_entity("publisher", "publishername", array($publisher));
				$this->LibrarianUtilities->insert_entity("printer", "printername", array($printer));
			
				//Relate the added values to each other
				$author_personids = $this->LibrarianUtilities->get_personids(explode(";", $authors));
				$this->LibrarianUtilities->relate_to_persons($author_personids, $isbn);
				$illustrator_personids = $this->LibrarianUtilities->get_personids(explode(";", $illustrators));
				$this->LibrarianUtilities->relate_to_persons($illustrator_personids, $isbn);
				$editor_personids = $this->LibrarianUtilities->get_personids(explode(";", $editors));
				$this->LibrarianUtilities->relate_to_persons($editor_personids, $isbn);
				
				//Now relate the publisher and printer
				$publisherid_query = "SELECT publisherid FROM publishers WHERE publishername = ? LIMIT 1;";
				$publisherid_action = $this->db->query($publisherid_query, array($publisher));
				$publisherid = $publisherid_action->row()->publisherid;
				$printerid_query = "SELECT printerid FROM printers WHERE printername = ? LIMIT 1;";
				$printerid_action = $this->db->query($printerid_query, array($printer));
				$printerid = $printerid_action->row()->printerid;
				$this->Utils->insert("publishers", "isbn,publisherid,year",
					array($isbn, $publisherid, $year));
				$this->Utils->insert("printers", "isbn,printerid", array($isbn, $printerid));
				
				return TRUE;
		} catch(Exception $e){
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	/**
	Parses user input of $authors, $illustrators, and $editors. Presently,
	we are assuming that the format of names is in Lastname, Firstname(s)
	and delimited by semicolons.
	*/
	private function insert_persons($persons_delimited, $person_delimiter, $name_part_delimiter){
		$person_delimiter = ";";
		$name_part_delimiter = ",";
		
		$persons_split = explode($person_delimiter, $persons_delimited);
		
		foreach($persons_split as $person){
			if($person == "" || $person == NULL){
				continue;
			}
			
			$name_parse = explode($name_part_delimiter, $person);
			
			$this->LibrarianUtilities->insert_entity("bookpersons", "lastname,firstname", $name_parse);
		}
	}
}

?>
