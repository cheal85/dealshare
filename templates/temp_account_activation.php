
<div class="span-12 left ">
	<div class="padding-10 ">
		<div class="">

			<div id="account-main-top"  class="back-color-2 span-12 shadow" >
			   	<div class="padding-10">
					<h2 class="color-6">Dealshare.ie Account Activation</h2>
					<p class="color-6 medium">It is necesary to verify your email before activating your account</p>
			    </div>
			</div>
			
			<div class="sep-20">&nbsp;</div>
			
			<div class="span-12 shadow clear left" >
				<div class="padding-20 " >
                <?php
					if($user = $myUserManager -> GetWhere(array('id', 'hash', 'active'), array($USER_ID, $USER_HASH, 'no'))) {
						
						$myUserManager -> UpdateEntry($USER_ID, 'active', 'yes');
						echo '<h2 class="color-2" >Thank you for Activating your account</h2>';
						
						echo '<p>Your Account has been activated.  You can now <a id="login-link" href="javascript:;" title="Login to your account" >Login</a> to your account</p>';
					}
					else {
						echo '<h2 class="color-2" >Your Account could not be activated</h2>';
						
						echo '<p>There was a problem verifying your account details.</p>';
					}
				?>
			    </div>
			</div>
			
		</div>
	</div>
</div>



