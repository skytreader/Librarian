<div align="center">
<h1>Search the Catalog</h1>

<?php
$this->load->helper("form");
$search_form_attributes = array("method" => "get",
                                "id" => "book_search");
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
			$book_fields["title"] = "Title";
			$book_fields["author"] = "Author";
			$book_fields["publisher"] = "Publisher";
			$book_fields["isbn"] = "ISBN";
			
			$bookfield_attributes = 'class="search"';
			
			echo form_dropdown("bookfield", $book_fields, "title", $bookfield_attributes);
		?>
	</td>
	<td>
		<?php
			$query_attributes["name"] = "query";
			$query_attributes["class"] = "search";
			$query_attributes["value"] = "";
			$query_attributes["size"] = "60";
			echo form_input($query_attributes);
		?>
	</td>
	<td>
		<?php
			$submit_attributes["class"] = "search";
			echo form_submit($submit_attributes, "Search");
		?>
	</td>
</tr>
</table>
<?php echo form_close(); ?>
</div>
