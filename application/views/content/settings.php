<!--
Expects the variable $settings defined containing all the
rows in the appsettings table in an array.
-->
<?php if(isset($settings)): ?>
	<?php foreach($settings as $s): ?>
		<strong><?= $s["settingstring"] ?>:</strong><br />
		<em><?= $s["description"] ?></em><br />
		<input type="text" value="<?= $s['settingvalue'] ?>" /><br />
	<?php endforeach ?>
<?php endif ?>
