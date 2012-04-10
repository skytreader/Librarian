<?php

/**
Provides a method for displaying the results of a <i>book</i> query
in table form. Returns a string which can then be echoed to a View
class.
*/
class ResultPrinter{
	/**
	Displays all the query results in table form or, if there are no
	results to display, issues a message to that effect. This assumes
	that the results have the following relevant fields:
	  -ISBN (isbn)
	  -Book title (title)
	  -Author (lastname, firstname);
	*/
	public function print_results($search_results){
		$limit = count($search_results);
		
		if($limit == 0){
			return "<p>No results were found for your query.</p>";
		} else{
			$table = "<table class='search_results'>\n<tr><td>ISBN</td><td>Title</td><td>Author</td></tr>\n";
			$i = 0;
			
			while($i < $limit){
				$isbn = $search_results[$i]->isbn;
				$title = $search_results[$i]->title;
				$author = $search_results[$i]->lastname . ", " . $search_results[$i]->firstname;
				$table .= "<tr><td>$isbn</td><td>$title</td><td>$author</td></tr>\n";
				$i++;
			}
			
			return $table;
		}
	}
}

?>
