<?php
echo '<div class="span-12 left" >';
	//  --------------------------------------------------
	//  SIGNUP FORM
	echo '<form id="form-signup" class=" padding-20 res centre" method="post">';
	//  --------------------------------------------------
	echo '<h2 class="text-centre" >Signup</h2>';
	//  EMAIL, USERNAME AND PASSWORD INPUTS
		echo '<label class="clear">email</label>';
		echo '<p><input class="clear left js-required js-email js-clear-input" type="email" id="email" placeholder="enter your email address" name="email" rel="we need your email" value="" /></p>';
		echo'<label class="clear">user name</label>';
		echo '<p><input class="clear left js-required js-clear-input" type="text"  id="user_name" placeholder="choose a user name" name="user_name" value=""rel="give yourself a user name" /></p>';
		//  --------------------------------------------------
		echo '<label class="clear">password</label>';
		echo '<p><input class="clear left js-required js-clear-input" type="password" placeholder="enter a password" id="password" name="password" rel="give your account a password" value="" /></p>';
		//  --------------------------------------------------
		echo '<a class="clear full left js-checkbox on" rel="newsletter" ><img src="/web_graphics/icons/checkbox-on.png" class="checkbox" /><p class="checkbox" >Receive our newsletter</p></a>';
		echo '<input type="hidden"  name="newsletter" value="yes" />';
		//  --------------------------------------------------
		//  HIDDEN INPUTS
		echo '<input type="hidden" id="redirect" name="redirect" value="' . $redirect . '" ><br>';
		echo '<input type="hidden" name="submit" value="1" />';
		//  --------------------------------------------------
		echo '<p class="input" ><input class="clear left full" id="signup-submit" type="submit" name="button" value="sign up">';
	//  --------------------------------------------------
	echo '<div class="message success"></div>';
	echo '</form>';
	//  --------------------------------------------------
echo '</div>';
?>