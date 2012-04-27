<?php

require_once(APPPATH . "app_constants.php");

/**
TODO: Maybe, it's a bad idea to generalize the add function?
Code looks messy!
Model that handles all the add functions in Librarian.

TODO: Decide on how to implement db-content passing.
TODO: Examine query results and react accordingly.
*/
class Add extends CI_Model{

	public function book($isbn, $title, $authors, $illustrators,
	                     $editors, $publisher, $printer, $year){
		$this->load->database(BOOKS_DSN);
		$add_book_query = "INSERT INTO books (isbn, title) VALUES (?,?);";
		$add_bookperson_query = "INSERT INTO bookpersons (lastname, firstname) VALUES (?,?);";
		$add_publisher_query = "INSERT INTO publishers (publishername) VALUES (?);";
		$add_printer_query = "INSERT_INTO printers (printername) VALUES (?);";
		
		//Insert values into the database
		$add_book_result = $this->db->query($add_book_query, array($isbn, $title));
		$this->insert_persons($authors, $add_bookperson_query);
		$this->insert_persons($illustrators, $add_bookperson_query);
		$this->insert_persons($editors, $add_bookperson_query);
		$add_publisher_result = $this->db->query($add_publisher_query, array($publisher));
		$add_printer_result = $this->db->query($add_printer_query, array($printer));
		
		//Relate the added values to each other
		//TODO: Modify database so that we are sure that only unique publisher/printer names
		//get entered into the database.
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
	}
	
	private function relate_to_persons($personids, $common_factor, $relation_query){
		foreach($personids as $id){
			$this->db->query($relation_query, array($id, $common_factor));
		}
	}
	
	/**
	Parses user input of $authors, $illustrators, and $editors. Presently,
	we are assuming that the format of names is in Lastname, Firstname(s)
	and delimited by semicolons. In future iterations, we need to check the
	user settings for the name format and the delimiter used.
	
	After parsing the given names, it inserts the names into the database
	using the $insertion_query.
	*/
	private function insert_persons($persons_delimited, $insertion_query){
		$persons_split = explode(";", $persons_delimited);
		
		foreach($persons_split as $person){
			$name_parse = explode(",", $person);
			//Working under assumptions...
			$lastname = trim($name_parse[0]);
			$firstname = trim($name_parse[1]);
			$insert_person = $this->db->query($insertion_query, array($lastname, $firstname));
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
			$name_parse = explode(",", $name);
			$lastname = trim($name_parse[0]);
			$firstname = trim($name_parse[1]);
			$query_action = $this->db->query($query, array($lastname, $firstname));
			$personids[$name] = $query_action->results()->personid;
		}
		
		return $personids;
	}
}

?>
