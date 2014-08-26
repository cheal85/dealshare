<?php
echo '<div class="span-12 left" >';
	//  --------------------------------------------------
	//  LOGIN FORM
	echo '<form id="form-login" class=" padding-20 res centre" method="post">';
	//
	echo '<h2 class="text-centre" >Login</h2>';
	//  --------------------------------------------------
	//  EMAIL AND PASSWORD INPUTS
		echo '<label class="clear">email</label>';
		if($account_email) {
			echo '<p><input class="clear left js-required js-clear-input js-email" type="email" id="email" placeholder="enter your email address" name="email" disabled="disabled" value="' . $account_email . '" rel="please enter a valid email" style="color: #6a6a6a;"/></p>';
		} else {
			echo '<p><input class="clear left js-required js-clear-input js-email" type="email" id="email" placeholder="enter your email address" name="email" value="" rel="please enter a valid email" /></p>';
		}

		echo '<label class="clear">password</label>';
		echo '<p><input class="clear left js-required js-clear-input" type="password" id="password" placeholder="enter a password" name="password" value="" rel="please enter your password" /></p>';
		//  --------------------------------------------------
		echo '<a class="clear full left js-checkbox " rel="remember_me" ><img src="/web_graphics/icons/checkbox-off.png" class="checkbox" /><p class="checkbox" >Remember me</p></a>';
		echo '<input type="hidden"  name="remember_me" value="no" />';
		//  --------------------------------------------------
		//  HIDDEN INPUTS
		echo '<input type="hidden" id="redirect" name="redirect" value="'.  $redirect . '" />';
		echo '<input type="hidden" name="submit" value="1" />';
		//  --------------------------------------------------
		echo '<p><input class="clear left " id="login-submit" type="submit" name="button" value="login"></p>';
		echo '<br /><a class="clear left" href="/account-recovery/" >Forgot your password?</a>';
	//  --------------------------------------------------
	echo '</form>';
	//  --------------------------------------------------
echo '</div>';
?>