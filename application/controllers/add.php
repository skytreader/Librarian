<?php

/**
Adds books to the database.
*/
class Add extends CI_Controller{

	public function book(){
		$this->load->model("Addbook");
		$add = $this->Addbook->add($_POST["isbn"], $_POST["title"], $_POST["authors"],
		                           $_POST["illustrators"], $_POST["editors"], $_POST["publisher"],
		                           $_POST["printer"], $_POST["year"]);
		
		if($add){
			echo "Success!";
		}
	}

}

?>
