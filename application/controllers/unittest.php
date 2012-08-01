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
		$this->load->model("QueryStringUtils");
		
		$single = "foo";
		$single_test = $this->QueryStringUtils->generate_and_clause($single);
		$single_expected_result = "foo=?";
		$single_name = "Single column bindvar";
		$this->unit->run($single_test, $single_expected_result, $single_name);
		
		$multi = "foo,bar,baz";
		$multi_test = $this->QueryStringUtils->generate_and_clause($multi);
		$multi_expected_result = "foo=? AND bar=? AND baz=?";
		$multi_name = "Multi-column bindvar";
		$this->unit->run($multi_test, $multi_expected_result, $multi_name);
		
		echo $this->unit->report();
	}
	
	/**
	Tests generate_insert_bind_vars in Utilities.
	*/
	public function generate_insert_bind_vars(){
		$this->load->model("QueryStringUtils");
		
		$single_test = $this->QueryStringUtils->generate_insert_bind_vars(1);
		$single_expected_result = "(?)";
		$single_name = "Single-column bindstring";
		$this->unit->run($single_test, $single_expected_result, $single_name);
		
		$multi_test = $this->QueryStringUtils->generate_insert_bind_vars(3);
		$multi_expected_result = "(?,?,?)";
		$multi_name = "Multi-column bindstring";
		$this->unit->run($multi_test, $multi_expected_result, $multi_name);
		
		echo $this->unit->report();
	}
	
	public function get_field_names(){
		$this->load->model("QueryStringUtils");
		
		$single_cond_test = "somefieldname = ?";
		$single_cond_result = $this->QueryStringUtils->get_field_names($single_cond_test);
		$single_cond_expected_result = array("somefieldname");
		$single_cond_name = "Single where condition";
		$this->unit->run($single_cond_result, $single_cond_expected_result, $single_cond_name);
		
		$multiple_and = "somefieldname = ? AND anotherfieldname = ? AND fieldname = ?";
		$multiple_and_result = $this->QueryStringUtils->get_field_names($multiple_and);
		$multiple_and_expected_result = array("somefieldname", "anotherfieldname", "fieldname");
		$multiple_and_name = "Multiple conditions joined by AND";
		$this->unit->run($multiple_and_result, $multiple_and_expected_result, $multiple_and_name);
		
		$multiple_or = "somefieldname = ? OR anotherfieldname = ? OR fieldname = ?";
		$multiple_or_result = $this->QueryStringUtils->get_field_names($multiple_or);
		$multiple_or_name = "Multiple conditions joined by OR";
		$this->unit->run($multiple_or_result, $multiple_and_expected_result, $multiple_or_name);
		
		$mixed = "somefieldname = ? AND anotherfieldname = ? OR fieldname = ?";
		$mixed_result = $this->QueryStringUtils->get_field_names($mixed);
		$mixed_name = "Mixed AND and OR";
		$this->unit->run($mixed_result, $multiple_and_expected_result, $multiple_or_name);
		
		echo $this->unit->report();
	}
}

?>
