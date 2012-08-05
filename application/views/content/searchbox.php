<div align="center">
<h1>Search the Catalog</h1>

<?php
$this->load->helper("form");
//Method is get so results are bookmark-able.
$search_form_attributes["method"] = "get";
$search_form_attributes["id"] = "book_search";
echo form_open("search", $search_form_attributes);
?>

<table border="0">
<tr class="text">
	<td>Search by</td>
	<td>Query</td>
	<td></td>
</tr>
<tr>
	<td>
		<?php	
			require_once(APPPATH . "controllers/search.php");
			$book_fields[Search::TITLE] = "Title";
			$book_fields[Search::AUTHOR] = "Author";
			$book_fields[Search::PUBLISHER] = "Publisher";
			$book_fields[Search::ISBN] = "ISBN";
			
			$bookfield_attributes = 'class="search"';
			
			echo form_dropdown(Search::SEARCH_TYPE, $book_fields, "title", $bookfield_attributes);
		?>
	</td>
	<td>
		<?php
			$query_attributes["name"] = Search::SEARCH_QUERY;
			$query_attributes["class"] = "search";
			$query_attributes["value"] = "";
			$query_attributes["size"] = "60";
			echo form_input($query_attributes);
		?>
	</td>
	<td>
		<?php
			$submit_attributes["class"] = "search btn";
			echo form_submit($submit_attributes, "Search");
		?>
	</td>
</tr>
</table>
<?php echo form_close(); ?>
</div>
