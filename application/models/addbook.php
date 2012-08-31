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
	private $this->userid;
	
	public function __construct(){
		parent::__construct();
		$this->load->library("Utils");
		$this->load->library("LibrarianUtilities");
		
		$this->load->model("dao/appsettings");
		$this->load->model("dao/books");
		$this->load->model("dao/bookcompanies");
		$this->load->model("dao/leafmakers");
		$this->load->model("dao/bookpersons");
		$this->load->model("dao/bookparticipants");
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
			
			$this->AppSettings->set_settingcode("name_separator");
			$this->AppSettings->load();
			$name_separator = $this->AppSettings->get_settingvalue();
			$ns_regex = "/\s*$name_separator\s*/";
			
			$this->AppSettings->set_settingcode("person_separator");
			$this->AppSetting->load();
			$person_separator = $this->AppSettings->get_settingvalue();
			$ps_regex = "/\s*$person_separator\s*/";
			
			// Add the book to the books table
			$this->Books->set_isbn($isbn);
			$this->Books->set_title($title);
			$this->Books->set_year($year);
			$this->Books->set_lastupdateby($this->userid);
			$this->Books->insert("isbn,title,lastupdateby");
			
			// Now, the messy part...
			// Parse names and insert to relevant tables.
			$author_names = preg_split($authors, $ps_regex);
			$illustrator_names = preg_split($illustrators, $ps_regex);
			$editor_names = preg_split($editors, $ps_regex);
			$translator_names = preg_split($translators, $ps_regex);
			
			$this->insert_bookpersons($author_names, $ns_delimiter);
			$this->insert_bookpersons($illustrator_names, $ns_delimiter);
			$this->insert_bookpersons($editor_names, $ns_delimiter);
			$this->insert_bookpersons($translator_names, $ns_delimiter);
			
			$this->insert_bookparticipants($author_names, $ns_delimiter,
			  BookParticipants::ISAUTHOR);
			$this->insert_bookparticipants($illustrator_names, $ns_delimiter,
			  BookParticipants::ISILLUSTRATOR);
			$this->insert_bookparticipants($editor_names, $ns_delimiter,
			  BookParticipants::ISEDITOR);
			$this->insert_bookparticipants($translator_names, $ns_delimiter,
			  BookParticipants::ISTRANSLATOR);
			
			// Publisher and printer.
			$diff_publisher_printer = $publisher != $printer;
			
			// Add them to bookcompanies
			$publisher_companyid = $this->insert_bookcompanies($publisher);
			$printer_companyid = ($diff_publisher_printer) ? $this->insert_bookcompanies($publisher) :
			  $publisher_companyid;
			
			// Get publisher timestamp.
			$this->BookCompanies->set_companyid($publisher_companyid);
			$this->BookCompanies->load();
			$publisher_timestamp = $this->BookCompanies->get_timestamp();
			
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
			$this->BookCompanies->set_companyid($printer_companyid);
			if($diff_publisher_printer){
				$this->BookCompanies->load();
				$printer_timestamp = $this->BookCompanies->get_timestamp();
			} else{
				$printer_timestamp = $publisher_timestamp;
			}
			
			// Aaannnddd... set!
			$this->check_toggle($publisher_companyid, LeafMakers::ISPUBLISHER, $publisher_timestamp);
			$this->check_toggle($printer_companyid, LeafMakers::ISPRINTER, $printer_timestamp);
			
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
	private function check_toggle($companyid, $role, $timestamp){
		$this->LeafMakers->set_company_id($companyid);
		$this->LeafMakers->set_lastupdateby($this->userid);
		
		if(!$this->LeafMakers->check_exists("companyid = ?")){
			$this->LeafMakers->insert("companyid,lastupdateby");
		}
		
		$this->LeafMakers->set_role($role, true);
		$this->LeafMakers->update($role, $timestamp);
	}
	
	/*
	Checks if a given company is in the bookcompanies table and inserts
	them if not.
	
	Returns the companyid of the company in the database.
	*/
	private function insert_bookcompanies($company_name){
		$this->BookCompanies->set_companyname($company_name);
		
		if(!$this->BookCompanies->check_exists("companyname = ?")){
			$this->BookCompanies->set_lastupdateby($this->userid);
			$this->BookCompanies->insert("companyname,lastupdateby");
		}
		
		return $this->get_company_id($company_name);
	}
	
	/*
	Returns the companyid given a company name. Assume that the given company
	name _is_ in the database.
	*/
	private function get_company_id($company_name){
		$this->BookCompanies->set_companyname($company_name);
		$query = $this->BookCompanies->select("companyid", "companyname = ?", "LIMIT 1");
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
	private function insert_bookparticipants($names, $name_delimiter, $role){
		foreach($name as $names){
			$name_parse = preg_split($name, $name_delimiter);
			$name_components = $name_parse[1];
			
			// Get personid from bookpersons.
			$this->BookPersons->set_lastname($name_components[0]);
			$first_name = (count($name_components) == 2) ? $name_components[1] : "";
			$this->BookPersons->set_firstname($first_name);
			
			$query = $this->BookPersons->select("personid", "firstname = ? AND lastname = ?", "LIMIT 1");
			$result_array = $query->result_array();
			$personid = $result_array[0]["personid"];
			
			// Now, construct the bookparticipants record.
			$this->BookParticipants->set_personid($personid);
			$this->BookParticipants->set_lastupdateby($this->userid);
			$this->BookParticipants->set_role($role, true);
			
			if($this->BookParticipants->check_exists("personid = ?")){
				// Hmmmm....something seems off with this kind of timestamp checking
				// and locking...
				$query = $this->BookParticipants->select("lastupdate", "personid = ?", "LIMIT 1");
				$result_array = $query->result_array();
				$timestamp = $result_array[0]["lastupdate"];
				
				$this->BookParticipants->update("$role,lastupdateby", $timestamp);
			} else{
				$this->BookParticipants->insert("personid,$role,lastupdateby");
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
		$this->BookPersons->set_lastupdateby($this->userid);
		
		foreach($name as $names){
			$name_parse = preg_split($name, $name_delimiter);
			$name_components = $name_parse[1]
			$this->BookPersons->set_lastname($name_components[0]);
			$first_name = (count($name_components) == 2) ? $name_components[1] : "";
			$this->BookPersons->set_firstname($first_name);
			
			if($this->BookPersons->check_exists($where_clause){
				$this->BookPersons->insert("lastname,firstname,lastupdateby");
			}
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
