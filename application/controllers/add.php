<?php

/**
Adds books to the database.

@author Chad Estioco
*/
class Add extends CI_Controller{
	
	/**
	No server side validation yet. Assume that there is an equal number
	of items for each field (as should be).
	*/
	public function book(){
		$this->load->model("Addbook");
		
		$record_count = count($this->input->post("isbn"));
		
		for($i = 0; $i < $record_count; $i++){
			$isbn = $this->input->post("isbn");
			$isbn = $isbn[$i];
			$title = $this->input->post("title");
			$title = $title[$i];
			$authors = $this->input->post("authors");
			$authors = $authors[$i];
			$illustrators = $this->input->post("illustrators");
			$illustrators = $illustrators[$i];
			$editors = $this->input->post("editors");
			$editors = $editors[$i];
			$publisher = $this->input->post("publisher");
			$publisher = $publisher[$i];
			$printer = $this->input->post("printer");
			$printer = $printer[$i];
			$year = $this->input->post("year");
			$year = $year[$i];
			
			$add = $this->Addbook->add($isbn, $title, $authors, $illustrators, $editors,
				$publisher, $printer, $year);
			
			if(!$add){
				echo "Transaction failed for book $title with ISBN $isbn";
			} else{
				echo "Book $i of $record_count<br />";
				echo "ISBN: $isbn<br />";
				echo "Title: $title<br />";
			}
		}
		
		if($add){
			echo "Transaction end.";
		}
		/*$record_count = count($this->input->post("title"));
		echo $record_count;*/
	}

}

?>
