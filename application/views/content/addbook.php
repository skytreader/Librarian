<script type="text/javascript" language="javascript" src="scripts/isbn_verify.js"></script>
<h1>Add a Book to the Inventory</h1>

<div>

<!--TODO: Consider using a 3-column table for displaying these fields-->
<div class="block">
	<h2>Book Information</h2>
	<label for="isbn">ISBN:</label><br /><input type="text" id="isbn" name="isbn" maxlength="13" /><br />
	<label for="title">Title:</label><br /><input type="text" id="title" name="title" /><br /><br />
</div>

<div class="block">
	<h2>Content Creators</h2>
	<label for="authors">Author(s):</label><br /><input type="text" id="authors" name="authors" /><br />
	<label for="illustrators">Illustrator(s):</label><br /><input type="text" id="illustrators" name="illustrators" /><br />
	<label for="editors">Editor(s):</label><br /><input type="text" id="editors" name="editors" /><br /><br />
</div>

<div class="block">
	<h2>Publishing Information</h2>
	<label for="publisher">Publisher:</label><br /><input type="text" id="publisher" name="publisher" /><br />
	<label for="printer">Printer:</label><br /><input type="text" id="printer" name="printer" /><br />
	<label for="year">Year:</label><br /><input type="text" id="year" name="year" /><br />
</div>
<div>
	<br /><input type="submit" value="List Book" class="btn" />
</div>

</div>
<div style="clear: both;">
	<hr width="99%" />
</div>
<br />
<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["id"] = "add_book";
	echo form_open("add/book", $form_attributes);
?>

<table class="booklist" id="booklist">
	<tr class="booklist">
		<td class="booklist">ISBN</td>
		<td class="booklist">Title</td>
		<td class="booklist">Author(s)</td>
		<td class="booklist">Illustrator(s)</td>
		<td class="booklist">Editor(s)</td>
		<td class="booklist">Publisher</td>
		<td class="booklist">Printer</td>
		<td class="booklist">Year</td>
		<td class="booklist"></td>
	</tr>
	<tr class="booklist">
		<td colspan="8">
			No records yet.
		</td>
	</tr>
</table>
<?php echo form_close(); ?>
