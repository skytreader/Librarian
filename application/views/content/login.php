<?php

require_once(APPPATH . "app_constants.php");

$this->load->helper("form");
echo form_open("dashboard"); ?>
	<?php if(isset($_GET[FLAG_LOGIN_FAIL]) && $_GET[FLAG_LOGIN_FAIL]){?>
		<p><b>Username-Password combination is invalid.</b></p>
	<?php } ?>
	Username:<br />
	<input type="text" id="username" name="username" /><br />
	Password:<br />
	<input type="password" id="password" name="password" /><br />
	<input type="submit" value="Log-in" />
</form>
