
<div class="span-6 res centre ">
	<div class="padding-20 left">

		<?php
			if($user = $myUserManager -> GetWhere(array('id', 'hash', 'active'), array($USER_ID, $USER_HASH, 'no'))) {
			#if(1) {
				
				$myUserManager -> UpdateEntry($USER_ID, 'active', 'yes');
				echo '<h2 class="text-centre" >Account Activated</h2>';
				
				echo '<div class="sep-20 left">&nbsp;</div>';
				
				echo '<p class="clear" >Your Account has been activated.  Please login below to start sharing and saving on dealshare.ie and remember to thank our members when you see a great deal. </p>';
				echo '<div class="sep-20 left">&nbsp;</div>';
				echo '<p class="clear" ><a href="/about/" title="Read more">Read more about dealshare.ie..</a></p>';
				
				echo '<div class="sep-20 left">&nbsp;</div>';
				#$account_email = $user[0]['email'];
				$account_email = $USER['email'];
				include(DIR_FORMS . '/form_account_login.php');
			}
			else {
				echo '<h2 class="text-centre" >Your Account could not be activated</h2>';
				
				echo '<div class="sep-20 left">&nbsp;</div>';
				echo '<p class="clear" >There was a problem verifying your account details.  Please ensure that you used the correct link to get to this page.</p>';
				echo '<div class="sep-20 left">&nbsp;</div>';
				echo '<p class="clear" >If this problem persists please <a href="/contact/" title="Contact us">Contact</a> us about the problem.</p>';
			}
		?>
			
	</div>
</div>



