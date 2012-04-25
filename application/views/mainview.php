<?php
	require_once(APPPATH . "app_constants.php");
/**
This view requires the following variables to be defined:
  >$title - displayed at the title bar of the browser
  >$content - can either be the URL of a page to include or text
   to be echoed

Additionally, if the $content contains text to be echoed, users of this
view must set a variable $echo_content to TRUE. You should also, ALWAYS,
load the URL helper.

For navbox.php, you also need to specify the variable $logged_in,
to determine if we should display the logged-in navbar.
*/
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
