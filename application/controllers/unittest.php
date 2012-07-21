<?

class UnitTest extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library("unit_test");
	}
	
	/**
	Tests generate_and_clause from LibrarianUtilities.
	*/
	public function generate_and_clause(){
		$this->load->model("LibrarianUtilities");
		
		$single = "foo";
		$single_test = $this->LibrarianUtilities->generate_and_clause($single);
		$single_expected_result = "foo=?";
		$single_name = "Single column bindvar";
		$this->unit->run($single_test, $single_expected_result, $single_name);
		
		$multi = "foo,bar,baz";
		$multi_test = $this->LibrarianUtilities->generate_and_clause($multi);
		$multi_expected_result = "foo=? AND bar=? AND baz=?";
		$multi_name = "Multi-column bindvar";
		$this->unit->run($multi_test, $multi_expected_result, $multi_name);
		
		echo $this->unit->report();
	}
	
	/**
	Tests generate_insert_bind_vars in Utilities.
	*/
	public function generate_insert_bind_vars(){
		$this->load->model("Utils");
		
		$single_test = $this->Utils->generate_insert_bind_vars(1);
		$single_expected_result = "(?)";
		$single_name = "Single-column bindstring";
		$this->unit->run($single_test, $single_expected_result, $single_name);
		
		$multi_test = $this->Utils->generate_insert_bind_vars(3);
		$multi_expected_result = "(?,?,?)";
		$multi_name = "Multi-column bindstring";
		$this->unit->run($multi_test, $multi_expected_result, $multi_name);
		
		echo $this->unit->report();
	}
}

?>
