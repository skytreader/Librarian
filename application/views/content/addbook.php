<h1>Add a Book to the Inventory</h1>

<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["id"] = "add_book";
	echo form_open("add", $form_attributes);
?>

<?php echo form_close(); ?>
