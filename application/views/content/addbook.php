<h1>Add a Book to the Inventory</h1>

<div>

<form id="detailsForm" name="addbook" action="" method="">
<div class="block">
	<h2>Book Information</h2>
	<label for="isbn">ISBN:*</label><br />
	<input type="text" id="isbn" class="required" name="isbn1" maxlength="13" /><br />
	<label for="title">Title:*</label><br />
	<input type="text" id="title" class="required" name="title1" /><br />
	<label for="genre">Genre:*</label><br />
	<input type="text" id="genre" class="required" name="genre1" /><br />
</div>

<div class="block">
	<h2>Content Creators</h2>
	<label for="authors">Author(s):</label><br />
	<input type="text" id="authors" name="authors1" /><br />
	<label for="illustrators">Illustrator(s):</label><br />
	<input type="text" id="illustrators" name="illustrators1" /><br />
	<label for="editors">Editor(s):</label><br />
	<input type="text" id="editors" name="editors1" /><br />
	<label for="translators">Translator(s):</label><br />
	<input type="text" id="translators" name="translators1" /><br /><br />
</div>

<div class="block">
	<h2>Publishing Information</h2>
	<label for="publisher">Publisher:*</label><br />
	<input type="text" id="publisher" class="required" name="publisher1" /><br />
	<label for="printer">Printer:*</label><br />
	<input type="text" id="printer" class="required" name="printer1" /><br />
	<label for="year">Year:*</label><br />
	<input type="text" id="year" class="required year" name="year1" /><br />
</div>
<div>
	<br /><input type="button" name="add" value="List Book" class="btn frequent" />
</div>
</form>

</div>
<div style="clear: both;">
	<hr noshade />
</div>
<br />
<?php
	$this->load->helper("form");
	$form_attributes["method"] = "post";
	$form_attributes["name"] = "bookqueue";
	echo form_open("add/book", $form_attributes);
?>
<table class="booklist" id="booklist">
	<tbody>
		<tr class="booklist">
			<td colspan="8">
				No books yet.
			</td>
		</tr>
	</tbody>
</table>
<?php
	$submit_button_data = array("name"=>"dbadd", "value"=>"Add Books", "class"=>"btn frequent");
	echo form_submit($submit_button_data);
	echo form_close();
?>
