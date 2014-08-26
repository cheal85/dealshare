
<div class="span-12 left ">
	<div class="padding-20 res centre">

		<?php
			if(!LOGGED_IN) {
				echo '<div class="span-5 res left" >';

					
					include(DIR_FORMS . '/form_account_login.php');
				echo '</div>';
				
				echo '<div class="span-2 left res-des" ><img src="/web_graphics/backgrounds/vertical-or.png" class="span-2 centre block" style="margin-top: 10px;" /></div>';
				echo '<div class="span-10 centre res-tab clear" ><img src="/web_graphics/backgrounds/horizontal-or.png" style="max-width:100%" /></div>';
				echo '<div class="span-10 centre res-mob clear" ><img src="/web_graphics/backgrounds/horizontal-or-mob.png" style="max-width:100%" /></div>';
				
				echo '<div class="span-5 res right" >';

					
					include(DIR_FORMS . '/form_account_signup.php');
				echo '</div>';
			}
			else {
				echo '<div class="span-6 res centre" >';
					echo '<h2 class="text-centre" >Your are already logged into your account</h2>';
					
					echo '<div class="sep-20 left">&nbsp;</div>';
					echo '<p class="clear" >You cannot login or singup for an account while being logged into an account.</p>';
					echo '<div class="sep-20 left">&nbsp;</div>';
					echo '<p class="clear" >If you are not logged in then please <a href="/contact/" title="Contact us">Contact</a> us about this error.</p>';
				echo '<div>';
			}
		?>
			
	</div>
</div>
