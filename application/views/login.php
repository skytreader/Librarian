<?php 
$this->load->helper("form");
echo form_open("login/verify"); ?>
	Username:<br />
	<input type="text" id="uname" /><br />
	Password:<br />
	<input type="password" id="password" /><br />
	<input type="submit" value="Log-in" />
</form>
