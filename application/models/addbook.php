<?php

require_once(APPPATH . "app_constants.php");
require_once(APPPATH . "models/dao/bookparticipants.php");
require_once(APPPATH . "models/dao/leafmakers.php");

/**
Model that handles all the add functions in Librarian.

TODO: Examine query results and react accordingly for errors, etc.
TODO: Not all names may be parseable as firstname, lastname. This is
a western concept. Handle this.
*/
class Addbook extends CI_Model{
	
	/*
	Loaded at add. Holds the userid of the user performing the
	insertion.
	*/
	private $userid;
	
	public function __construct(){
		parent::__construct();
		//$this->load->model("Q");
		
		$this->load->model("dao/Appsettings");
		$this->load->model("dao/Books");
		$this->load->model("dao/Bookcompanies");
		$this->load->model("dao/Leafmakers");
		$this->load->model("dao/Bookpersons");
		$this->load->model("dao/Bookparticipants");
	}
	
	/**
	Expects an associative array/hash map of the book's data.
	
	Expected keys are: isbn, title, genre, authors, illustrators, editors,
	translators, publisher, printer, year.
	*/
	public function add($book_data){
		// Get all the form data
		$isbn = $book_data["isbn"];
		$title = $book_data["title"];
		$genre = $book_data["genre"];
		$authors = $book_data["authors"];
		$illustrators = $book_data["illustrators"];
		$editors = $book_data["editors"];
		$translators = $book_data["translators"];
		$publisher = $book_data["publisher"];
		$printer = $book_data["printer"];
		$year = $book_data["year"];
		
		// Load the user id of current user for lastupdateby fields
		$this->load->library("session");
		$this->userid = $this->session->userdata(SESSION_LIBRARIAN_ID);
		
		try{
			$this->load->database(BOOKS_DSN);
			
			$this->Appsettings->set_settingcode("name_separator");
			$this->Appsettings->load();
			$name_separator = $this->Appsettings->get_settingvalue();
			$ns_regex = '/\s*' . $name_separator . '\s*/';
			
			$this->Appsettings->set_settingcode("person_separator");
			$this->Appsettings->load();
			$person_separator = $this->Appsettings->get_settingvalue();
			$ps_regex = '/\s*' . $person_separator . '\s*/';
			
			// Add the book to the books table
			$this->Books->set_isbn($isbn);
			$this->Books->set_title($title);
			$this->Books->set_year($year);
			$this->Books->set_last_updater($this->userid);
			$this->Books->insert("isbn,title,year,lastupdateby");
			
			// Now, the messy part...
			// Parse names and insert to relevant tables.
			$author_names = preg_split($ps_regex, $authors);
			$illustrator_names = preg_split($ps_regex, $illustrators);
			$editor_names = preg_split($ps_regex, $editors);
			$translator_names = preg_split($ps_regex, $translators);
			
			$this->insert_bookpersons($author_names, $ns_regex);
			$this->insert_bookpersons($illustrator_names, $ns_regex);
			$this->insert_bookpersons($editor_names, $ns_regex);
			$this->insert_bookpersons($translator_names, $ns_regex);
			
			$this->insert_bookparticipants($author_names, $isbn, $ns_regex,
			  Bookparticipants::ISAUTHOR);
			$this->insert_bookparticipants($illustrator_names, $isbn, $ns_regex,
			  Bookparticipants::ISILLUSTRATOR);
			$this->insert_bookparticipants($editor_names, $isbn, $ns_regex,
			  Bookparticipants::ISEDITOR);
			$this->insert_bookparticipants($translator_names, $isbn, $ns_regex,
			  Bookparticipants::ISTRANSLATOR);
			
			// Publisher and printer.
			$diff_publisher_printer = $publisher != $printer;
			
			// Add them to bookcompanies
			$publisher_companyid = $this->insert_bookcompanies($publisher);
			$printer_companyid = ($diff_publisher_printer) ? $this->insert_bookcompanies($publisher) :
			  $publisher_companyid;
			
			// Get publisher timestamp.
			$this->Bookcompanies->set_companyid($publisher_companyid);
			$this->Bookcompanies->load();
			$publisher_timestamp = $this->Bookcompanies->get_timestamp();
			
			// Get the printer timestamp.
			// It may be that printer and publisher is the same and in between
			// $publisher_timestamp and $printer_timestamp, someone modifes that
			// record and changes the timestamp. Then $printer_timestamp will have
			// the most-recent timestamp and can lock the record. However, I decide
			// not to take advantage of this fact since, if one of the two timestamps
			// is invalid, this transaction will stop and user will resend alll data.
			// In that event, the overhead of querying for the timestamp twice is
			// wasted (it will happen again). Better just compare publisher and
			// printer since the wrong timestamp will just terminate the whole process.
			$this->Bookcompanies->set_companyid($printer_companyid);
			if($diff_publisher_printer){
				$this->Bookcompanies->load();
				$printer_timestamp = $this->Bookcompanies->get_timestamp();
			} else{
				$printer_timestamp = $publisher_timestamp;
			}
			
			// Aaannnddd... set!
			$this->check_toggle($publisher_companyid, $isbn, Leafmakers::ISPUBLISHER, $publisher_timestamp);
			$this->check_toggle($printer_companyid, $isbn, Leafmakers::ISPRINTER, $printer_timestamp);
			
			return true;
		} catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	/*
	Checks if a given companyid id in the leafmakers table and inserts
	them if not. The given role is also set to true.
	*/
	private function check_toggle($companyid, $isbn, $role, $timestamp){
		$this->Leafmakers->set_companyid($companyid);
		$this->Leafmakers->set_isbn($isbn);
		$this->Leafmakers->set_last_updater($this->userid);
		
		if(!$this->Leafmakers->check_exists("companyid = ? and isbn = ?")){
			$this->Leafmakers->insert("isbn,companyid,lastupdateby");
		}
		
		$this->Leafmakers->set_role($role, true);
		$this->Leafmakers->update($role, $timestamp);
	}
	
	/*
	Checks if a given company is in the bookcompanies table and inserts
	them if not.
	
	Returns the companyid of the company in the database.
	*/
	private function insert_bookcompanies($company_name){
		$this->Bookcompanies->set_companyname($company_name);
		
		if(!$this->Bookcompanies->check_exists("companyname = ?")){
			$this->Bookcompanies->set_last_updater($this->userid);
			$this->Bookcompanies->insert("companyname,lastupdateby");
		}
		
		return $this->get_company_id($company_name);
	}
	
	/*
	Returns the companyid given a company name. Assume that the given company
	name _is_ in the database.
	*/
	private function get_company_id($company_name){
		$this->Bookcompanies->set_companyname($company_name);
		$query = $this->Bookcompanies->select("companyid", "companyname = ?", "LIMIT 1");
		$ra = $query->result_array();
		return $ra[0]["companyid"];
	}
	
	/*
	Inserts all persons in $names array in the bookparticipants table. That is assuming
	that the names are already in the bookpersons table; if not, this raises an
	exception. Then, set the participation field specified by $role to true.
	
	If a person is already in the bookparticipants, the personid is not re-inserted. We
	just set the specified role to true.
	
	@param names
	  The array of names, unparsed, to insert in the bookparticipants table.
	@param name_delimiter
	  Regex that separates last names from first names
	@param userid
	  User id of the user performing the insertion
	@param role
	  Role of these names.
	*/
	private function insert_bookparticipants($names, $isbn, $name_delimiter, $role){
		$this->Bookparticipants->set_isbn($isbn);
		$this->Bookparticipants->set_role($role, true);
		$this->Bookparticipants->set_last_updater($this->userid);
		
		foreach($names as $name){
			if($this->is_blank($name)){
				continue;
			}
			$name_parse = preg_split($name_delimiter, $name);
			
			// Get personid from bookpersons.
			$this->Bookpersons->set_lastname($name_parse[0]);
			$first_name = (count($name_parse) == 2) ? $name_parse[1] : "";
			$this->Bookpersons->set_firstname($first_name);
			
			$query = $this->Bookpersons->select("personid", "firstname = ? AND lastname = ?", "LIMIT 1");
			$result = $query->row();
			$personid = $result->personid;
			
			// Now, construct the bookparticipants record.
			$this->Bookparticipants->set_personid($personid);
			
			if($this->Bookparticipants->check_exists("personid = ? AND isbn = ?")){
				// Hmmmm....something seems off with this kind of timestamp checking
				// and locking...
				$query = $this->Bookparticipants->select("lastupdate", "personid = ?", "LIMIT 1");
				$result_array = $query->result_array();
				$timestamp = $result_array[0]["lastupdate"];
				
				$this->Bookparticipants->update("$role,lastupdateby", $timestamp);
			} else{
				$this->Bookparticipants->insert("personid,isbn,$role,lastupdateby");
			}
		}
	}
	
	/*
	Inserts all names in $names array in the bookpersons table. All names
	are assumed to be unparsed.
	
	@param names
	  An array of unparsed names.
	@param name_delimiter
	  Regex that separates last names from first names.
	@param userid
	  User id of the user performing the insertion.
	*/
	private function insert_bookpersons($names, $name_delimiter){
		$where_clause = "firstname = ? AND lastname = ?";
		$this->Bookpersons->set_last_updater($this->userid);
		
		foreach($names as $name){
			if($this->is_blank($name)){
				continue;
			}
			$name_parse = preg_split($name_delimiter, $name);
			//$name_components = $name_parse[0][1];
			$this->Bookpersons->set_lastname($name_parse[0]);
			$first_name = (count($name_parse) == 2) ? $name_parse[1] : "";
			$this->Bookpersons->set_firstname($first_name);
			
			if(!$this->Bookpersons->check_exists($where_clause)){
				$this->Bookpersons->insert("lastname,firstname,lastupdateby");
			}
		}
	}
	
	private function is_blank($text){
		return $text == "";
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
			
			$this->Librarianutilities->insert_entity("bookpersons", "lastname,firstname", $name_parse);
		}
	}
}

?>
