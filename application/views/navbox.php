<div class="navbox">
	<a href="index.php/home" class="navbox">Search</a>
	<a href="index.php/about" class="navbox">About</a>
	<?php if(isset($logged_in) && $logged_in){ ?>
		<a href="index.php/logout" class="navbox">Log Out</a>
		<a href="index.php/dashboard" class="navbox">Dashboard</a>
		<a href="index.php/manage/users" class="navbox">Manage Users</a>
		<a href="index.php/manage/books" class="navbox">Manage Books</a>
		<a href="index.php/settings" class="navbox">Settings</a>
	<?php }else{ ?>
		<a href="index.php/login" class="navbox">Log In</a>
	<?php } ?>
</div>
