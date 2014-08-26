<?php
if($tmp = $myUserManager -> GetWhere(array('id', 'hash', 'active'), array($_GET['u_id'], $_GET['u_rc'], 'yes'))) {
	$user = format($tmp[0]);
	$myUserManager -> UpdateEntry($user['id'], 'newsletter', 'no');
	
	//  markup
	echo '<div  class="span-12 left" >';

		echo '<div class="padding-20" >';
			echo '<h2 class="centre ">Un-subscribe from Newsletter</h2>';
			
			echo '<p>We have removed you from our mailing list</p>';
		
		echo '</div>';
	echo '</div>';
}
else {
	echo '<div  class="span-12 left" >';

		echo '<div class="padding-20" >';
			echo '<h2 class="centre ">User Not Found</h2>';
			echo '<p class="color-5 medium">The Requested User could not be found.</p>';
		echo '</div>';
	echo '</div>';
}
?>




