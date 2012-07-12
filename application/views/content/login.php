<?php

$this->load->helper("form");
echo form_open("dashboard"); ?>
	<?php if(isset($fail) && $fail){?>
		<p><b>Username-Password combination is invalid.</b></p>
	<?php } ?>
	Username:<br />
	<input type="text" id="username" name="username" /><br />
	Password:<br />
	<input type="password" id="password" name="password" /><br />
	<input type="submit" class="btn" value="Log-in" />
</form>
