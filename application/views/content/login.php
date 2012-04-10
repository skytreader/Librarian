<?php 
$this->load->helper("form");
echo form_open("login/dashboard"); ?>
	Username:<br />
	<input type="text" id="username" name="username" /><br />
	Password:<br />
	<input type="password" id="password" name="password" /><br />
	<input type="submit" value="Log-in" />
</form>
