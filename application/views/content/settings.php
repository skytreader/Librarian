<?php

if(isset($messages["app_settings"])){
	echo "<em>" . $messages["app_settings"] . "</em>";
}

?>
<!--
Expects the variable $app_settings defined containing all the
rows in the appsettings table in an array.
-->
<h1>App Settings</h1>
<form id="app_settings" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<input type="hidden" name="mc" value="app_settings" />
<?php if(isset($app_settings)): ?>
	<?php foreach($app_settings as $s): ?>
		<strong><?= $s["settingstring"] ?>:</strong><br />
		<em><?= $s["description"] ?></em><br />
		<input type="text" value="<?= $s['settingvalue'] ?>" class="<?= $s['classes'] ?>" name="<?= $s['settingcode'] ?>" /><br />
		<input type="hidden" value="<?= $s['lastupdate'] ?>" name="<?= $s['settingcode'] ?>_timestamp" />
	<?php endforeach ?>
<?php endif ?>
<input type="submit" class="btn frequent" name="save_app_settings" value="Save App Settings" />
</form>
<br />
<hr noshade>

<?php

if(isset($messages["password"])){
	echo "<em>" . $messages["password"] . "</em>";
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
<form id="change_password" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<input type="hidden" name="mc" value="password" />
	<input type="hidden" name="timestamp" value="<?= $user->get_timestamp(); ?>" />
	<strong>Password:</strong><br />
	<input type="password" class="required" name="password" /><br />
	<strong>New Password:</strong><br />
	<input type="password" class="required" name="new_password" /><br />
	<strong>Confirm New Password:</strong><br />
	<input type="password" class="required" name="confirm_new_password" /><br />
	<input type="submit" class="btn frequent" name="change_password" value="Change Password" />
</form>
