<?php
	require_once(APPPATH . "app_constants.php");
?>
<html>
	<head>
		<title><?php echo APP_TITLE . " - " . $title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/librariantheme.css';?>" />
	</head>
	<body>
		<div class="main_box">
			<img src="<?php echo base_url();?>images/librarian.png" />
			<?php include("navbox.php"); ?>
			<div class="content_box">
				<?php include($content); ?>
			</div>
		</div>
	</body>
</html>
