
<div id="site-top" class=" back-color-5">
	<div id="search" class="left">
    	<form id="search-form" method="post" action="/scripts/processing/process.search.php" >
			<input id="search" class="clear span-5" value="" />
    	</form>
	</div>
	
	<div id="account-links" class="right text-right">
	<?php
		if(!LOGGED_IN)
		{				
			echo '<p ><a id="login-link" class="modal color-4" href="javascript:;" title="Login to your account">Login</a></p>';
		}
		else
		{
			echo '<p ><a class="color-4" href="/scripts/processing/logout.php" title="Log out of your account" >Logout</a></p>';
		}
	echo '</div>';
	
	if(LOGGED_IN) {
		echo '<div class="right" ><p class="color-4">Welcome back ' . $USER['user_name'] .' |  </p></div>';
	}
	?>

</div>
