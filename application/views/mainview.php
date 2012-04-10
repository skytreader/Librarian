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
				<?php
					if(isset($echo_content) && $echo_content){
						echo $content;
					} else{
						include($content);
					}
				?>
			</div>
		</div>
	</body>
</html>
