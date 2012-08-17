<?php
require_once(APPPATH . "architecture_constants.php");
?>

<!--
Expects the variable $app_settings defined containing all the
rows in the appsettings table in an array.
-->
<h1>App Settings</h1>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<?php if(isset($app_settings)): ?>
	<?php foreach($app_settings as $s): ?>
		<strong><?= $s["settingstring"] ?>:</strong><br />
		<em><?= $s["description"] ?></em><br />
		<input type="text" value="<?= $s['settingvalue'] ?>" /><br />
	<?php endforeach ?>
<?php endif ?>
<input type="submit" class="btn frequent" value="Save App Settings" />
</form>
<br />
<hr noshade>

<?php
/*
Check if page was loaded from password submission and change
password if appropriate.
*/
if($this->input->post("change_password")){
	try{
		$password = hash(HASH_FUNCTION, $this->input->post("password"));
		$new_password = hash(HASH_FUNCTION, $this->input->post("new_password"));
		$confirm_new_password = hash(HASH_FUNCTION ,$this->input->post("confirm_new_password"));
		$user->change_password($password, $new_password, $confirm_new_password, $user->get_timestamp());
		echo "<em>Password changed successfully.</em>";
	} catch(Exception $e){
		echo $e->getMessage();
	}
}
?>

<!--
And here, the librarian's user settings. Expects the following
variables:
  >$user_password - will not be displayed.
-->
<h1>User Settings</h1>
<h2>Change Password</h2>
<em>Use this form to change your password.</em><br />
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<strong>Password:</strong><br />
	<input type="password" name="password" /><br />
	<strong>New Password:</strong><br />
	<input type="password" name="new_password" /><br />
	<strong>Confirm New Password:</strong><br />
	<input type="password" name="confirm_new_password" /><br />
	<input type="submit" class="btn frequent" name="change_password" value="Change Password" />
</form>
