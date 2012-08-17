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
	<input type="submit" class="btn frequent" value="Change Password" />
</form>
