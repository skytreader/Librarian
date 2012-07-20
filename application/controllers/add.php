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
			$isbn = $this->input->post("isbn[$i]");
			$title = $this->input->post("title[$i]");
			$authors = $this->input->post("authors[$i]");
			$illustrators = $this->input->post("illustrators[$i]");
			$editors = $this->input->post("editors[$i]");
			$publisher = $this->input->post("publisher[$i]");
			$printer = $this->input->post("printer[$i]");
			$year = $this->input->post("year[$i]");
			
			$add = $this->Addbook->add($isbn, $title, $authors, $illustrators, $editors,
				$publisher, $printer, $year);
			
			if(!$add){
				echo "Transaction failed for book $title with ISBN $isbn";
			}
			
			$i++;
		}
		
		if($add){
			echo "Transaction end.";
		}
		/*$record_count = count($this->input->post("title"));
		echo $record_count;*/
	}

}

?>
