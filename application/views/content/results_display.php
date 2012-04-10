<?php

/**
Displays all the query results in table form. This file assumes that a variable
$search_results contains the results to be displayed. This assumes that the results
have the following relevant fields:
  -ISBN
  -Book title
  -Author
*/
if($search_result->num_rows() == 0){
	echo "<p>No results were found.</p>";
} else{
	echo "<p>Just you wait....</p>";
}

?>
