<?php
/**
This file provides controllers for searching books based on certain
criteria. Criterias should implement the BookSearch interface and define
their own search() methods.
*/

interface BookSearch{
	/**
	Returns all the books based on a given criteria as a query result.
	*/
	public function search($search_query);
}

?>
