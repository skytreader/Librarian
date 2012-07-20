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
			$genre = $this->input->post("genre");
			$genre = $genre[$i];
			$authors = $this->input->post("authors");
			$authors = $authors[$i];
			$illustrators = $this->input->post("illustrators");
			$illustrators = $illustrators[$i];
			$editors = $this->input->post("editors");
			$editors = $editors[$i];
			$translators = $this->input->post("translators");
			$translators = $translators[$i];
			$publisher = $this->input->post("publisher");
			$publisher = $publisher[$i];
			$printer = $this->input->post("printer");
			$printer = $printer[$i];
			$year = $this->input->post("year");
			$year = $year[$i];
			
			$book_data["isbn"] = $isbn;
			$book_data["title"] = $title;
			$book_data["genre"] = $genre;
			$book_data["authors"] = $authors;
			$book_data["illustrators"] = $illustrators;
			$book_data["editors"] = $editors;
			$book_data["translators"] = $translators;
			$book_data["publisher"] = $publisher;
			$book_data["printer"] = $printer;
			$book_data["year"] = $year;
			
			$add = $this->Addbook->add($book_data);
			
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
