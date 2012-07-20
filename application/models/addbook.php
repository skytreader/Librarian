<?php

require_once(APPPATH . "app_constants.php");
require_once("utilities.php");

/**
Model that handles all the add functions in Librarian.

TODO: Examine query results and react accordingly for errors, etc.
TODO: Not all names may be parseable as firstname, lastname. This is
a western concept. Handle this.
*/
class Addbook extends CI_Model{
	
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
				// TODO: Abstract this!
				$add_book_query = "INSERT INTO books (isbn, title) VALUES (?,?);";
				$add_bookperson_query = "INSERT INTO bookpersons (lastname, firstname) VALUES (?,?);";
				$add_publisher_query = "INSERT INTO publishers (publishername) VALUES (?);";
				$add_printer_query = "INSERT INTO printers (printername) VALUES (?);";
				$add_genre_query = "INSERT INTO genres (genrename) VALUES (?);";
				
				
				
				//Insert values into the database
				//$add_book_result = $this->db->query($add_book_query, array($isbn, $title));
				Utils.insert("books", "isbn,title", array($isbn, $title));
				$this->insert_persons($authors);
				$this->insert_persons($illustrators);
				$this->insert_persons($editors);
				
				$publisher_array = array($publisher);
				if($this->check_not_exists("publishers", "publishername = ?", $publisher_array)){
					$add_publisher_result = $this->db->query($add_publisher_query, $publisher_array);
				}
				
				$printer_array = array($printer);
				if($this->check_not_exists("printers", "printername = ?", $printer_array)){
					$add_printer_result = $this->db->query($add_printer_query, $printer_array);
				}
			
				//Relate the added values to each other
				$make_authored_query = "INSERT INTO authored (isbn, personid) VALUES (?,?);";
				$make_illustrated_query = "INSERT INTO illustrated (isbn, personid) VALUES (?,?);";
				$make_edited_query = "INSERT INTO edited (isbn, personid) VALUES (?,?);";
				$make_published_query = "INSERT INTO published (isbn, publisherid, year) VALUES (?,?,?);";
				$make_printed_query = "INSERT INTO printed (isbn, printerid) VALUES (?,?);";
				
				$author_personids = $this->get_personids(explode(";", $authors));
				$this->relate_to_persons($author_personids, $isbn, $make_authored_query);
				$illustrator_personids = $this->get_personids(explode(";", $illustrators));
				$this->relate_to_persons($illustrator_personids, $isbn, $make_illustrated_query);
				$editor_personids = $this->get_personids(explode(";", $editors));
				$this->relate_to_persons($editor_personids, $isbn, $make_edited_query);
				
				//Now relate the publisher and printer
				$publisherid_query = "SELECT publisherid FROM publishers WHERE publishername = ? LIMIT 1;";
				$publisherid_action = $this->db->query($publisherid_query, array($publisher));
				$publisherid = $publisherid_action->row()->publisherid;
				$printerid_query = "SELECT printerid FROM printers WHERE printername = ? LIMIT 1;";
				$printerid_action = $this->db->query($printerid_query, array($printer));
				$printerid = $printerid_action->row()->printerid;
				$this->db->query($make_published_query, array($isbn, $publisherid, $year));
				$this->db->query($make_printed_query, array($isbn, $printerid));
				
				return TRUE;
		} catch(Exception $e){
			echo $e->getMessage();
			return FALSE;
		}
	}
	
	private function relate_to_persons($personids, $common_factor, $relation_query){
		foreach($personids as $id){
			$this->db->query($relation_query, array($common_factor, $id));
		}
	}
	
	/**
	Checks if a certain combination of values does not exist $in_table.
	*/
	private function check_not_exists($in_table, $where_clause, $values){
		$query_statement = "SELECT * FROM $in_table WHERE $where_clause LIMIT 1;";
		$query_result = $this->db->query($query_statement, $values);
		return $query_result->num_rows() == 0;
	}
	
	/**
	Parses user input of $authors, $illustrators, and $editors. Presently,
	we are assuming that the format of names is in Lastname, Firstname(s)
	and delimited by semicolons. In future iterations, we need to check the
	user settings for the name format and the delimiter used.
	
	After parsing the given names, it inserts the names into the database
	using the $insertion_query.
	
	We are assuming that the insertion queries passed insert on table
	bookpersons.
	*/
	private function insert_persons($persons_delimited){
		$persons_split = explode(";", $persons_delimited);
		
		foreach($persons_split as $person){
			if($person == "" || $person == NULL){
				continue;
			}
			
			$name_parse = explode(",", $person);
			//Working under alphabet assumptions...
			$lastname = trim($name_parse[0]);
			$firstname = trim($name_parse[1]);
			
			$query_statement = "SELECT * FROM bookpersons WHERE lastname = ? AND firstname = ?;";
			$query_result = $this->db->query($query_statement, array($lastname, $firstname));
			
			if($query_result->num_rows()){
			} else{
				Utils.insert("bookpersons", "lastname,firstname", array($lastname, $firstname));
			}
		}
	}
	
	/**
	Returns an associative array where each name is mapped to its corresponding
	personid in the database. For purposes of performance, we are assuming
	that $persons is already an array of names in format Lastname, Firstname(s).
	*/
	private function get_personids($persons){
		$query = "SELECT personid FROM bookpersons WHERE lastname = ? AND firstname = ? LIMIT 1;";
		$personids = array();
		
		foreach($persons as $name){
			if($name == "" || $name == NULL){
				continue;
			}
			
			$name_parse = explode(",", $name);
			$lastname = trim($name_parse[0]);
			$firstname = trim($name_parse[1]);
			$query_action = $this->db->query($query, array($lastname, $firstname));
			$query_result = $query_action->row();
			$personids[$name] = $query_result->personid;
		}
		
		return $personids;
	}
}

?>
