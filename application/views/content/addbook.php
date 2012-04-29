<h1>Add a Book to the Inventory</h1>

<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["id"] = "add_book";
	echo form_open("add/book", $form_attributes);
?>

<!--TODO: Consider using a 3-column table for displaying these fields-->

<h2>Book Information</h2>
<label for="isbn">ISBN:</label><br /><input type="text" id="isbn" name="isbn" maxlength="13" /><br />
<label for="title">Title:</label><br /><input type="text" id="title" name="title" /><br /><br />

<h2>Book Persons</h2>
<label for="authors">Author(s):</label><br /><input type="text" id="authors" name="authors" /><br />
<label for="illustrators">Illustrator(s):</label><br /><input type="text" id="illustrators" name="illustrators" /><br />
<label for="editors">Editor(s):</label><br /><input type="text" id="editors" name="editors" /><br /><br />

<h2>Publishing Information</h2>
<label for="publisher">Publisher:</label><br /><input type="text" id="publisher" name="publisher" /><br />
<label for="printer">Printer:</label><br /><input type="text" id="printer" name="printer" /><br />
<label for="year">Year:</label><br /><input type="text" id="year" name="year" /><br />
<br /><input type="submit" value="Add Book" />

<?php echo form_close(); ?>
