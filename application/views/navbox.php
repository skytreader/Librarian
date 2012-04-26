<div class="navbox">
	<a href="<?php echo base_url() . 'index.php/home'; ?>" class="navbox">Search</a>
	<a href="<?php echo base_url() . 'index.php/about'; ?>" class="navbox">About</a>
	<?php if(isset($logged_in) && $logged_in){ ?>
		<a href="<?php echo base_url() . 'index.php/logout'; ?>" class="navbox">Log Out</a>
		<a href="<?php echo base_url() . 'index.php/dashboard'; ?>" class="navbox">Dashboard</a>
		<a href="manage/users" class="navbox">Manage Users</a>
		<a href="manage/books" class="navbox">Manage Books</a>
		<a href="<?php echo base_url() . 'index.php/settings'; ?>" class="navbox">Account Settings</a>
	<?php }else{ ?>
		<!--No need to call base_url() here since we are sure that this will only appear iff
		the user isn't logged-in, and therefore the "subdirectoried" URLs are not accessible-->
		<a href="login" class="navbox">Log In</a>
	<?php } ?>
</div>
