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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title><?php echo APP_TITLE . " - " . $title; ?></title>
		<base href="<?php echo base_url(); ?>" />
		<link rel="stylesheet" type="text/css" href="css/librariantheme.css" />
		<?php
			foreach($stylesheets as $style){
				echo '<link rel="stylesheet" type="text/css" href="css/$style" />"';
			}
		?>
		
		<?php
			foreach($scripts as $script){
				echo '<script type="text/javascript" src="scripts/$script"></script>"';
			}
		?>
	</head>
	<body>
		<div class="main_box">
			<img src="images/librarian.png" />
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
