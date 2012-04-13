<div class="navbox">
	<a href="home" class="navbox">Search</a>
	<a href="about" class="navbox">About</a>
	<?php if(isset($logged_in) && $logged_in){ ?>
		<a href="logout" class="navbox">Log Out</a>
		<a href="dashboard" class="navbox">Dashboard</a>
		<a href="users" class="navbox">Manage Users</a>
		<a href="books" class="navbox">Manage Books</a>
	<?php }else{ ?>
		<a href="login" class="navbox">Log In</a>
	<?php } ?>
</div>
