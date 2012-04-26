<h1>Add a Book to the Inventory</h1>

<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["id"] = "add_book";
	echo form_open("addbook", $form_attributes);
?>

<!--TODO: Consider using a 3-column table for displaying these fields-->

<h2>Book Information</h2>
<label for="isbn">ISBN:</label><br /><input type="text" id="isbn" /><br />
<label for="title">Title:</label><br /><input type="text" id="title" /><br /><br />

<h2>Book Persons</h2>
<label for="authors">Author(s):</label><br /><input type="text" id="authors" /><br />
<label for="illustrators">Illustrator(s):</label><br /><input type="text" id="illustrators" /><br />
<label for="editors">Editor(s):</label><br /><input type="text" id="editors" /><br /><br />

<h2>Auxilliary Information</h2>
<label for="publisher">Publisher:</label><br /><input type="text" id="publisher" /><br />
<lable for="printer">Printer:</label><br /><input type="text" id="printer" /><br />
<br /><input type="submit" value="Add Book" />

<?php echo form_close(); ?>
