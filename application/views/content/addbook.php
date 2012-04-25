<h1>Add a Book to the Inventory</h1>

<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["id"] = "add_book";
	echo form_open("add", $form_attributes);
?>

<label for="isbn">ISBN:</label><br /><input type="text" id="isbn" /><br />
<label for="title">Title:</label><br /><input type="text" id="title" /><br />
<label for="author">Author:</label><br /><input type="text" id="author" /><br />
<label for="publisher">Publisher:</label><br /><input type="text" id="publisher" /><br />
<br /><input type="submit" value="Add Book" />

<?php echo form_close(); ?>
