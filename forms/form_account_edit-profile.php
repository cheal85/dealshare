<?php
//  --------------------------------------------------
//  EDIT DETAILS FORM
	//  --------------------------------------------------
	echo '<form id="form-edit-profile" class="clear left span-12" method="post">';
	$form = $USER;
	//  --------------------------------------------------
	//  EMAIL, USERNAME AND PASSWORD INPUTS
	echo '<p class="clear span-12 left" ><label class="clear ">email address</label><input class="clear span-12 js-required js-email" disabled=disabled type="email" id="email" name="email" rel="Your email address is required" value="' . $form['email'] . '" /></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">user name</label><input class="clear span-12 js-required" type="text" id="user_name" placeholder="username" name="user_name" rel="A username is required" value="' . $form['user_name'] . '" /></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">or your real name</label>';
	echo '<input class="clear span-6 left" type="text" id="first_name" placeholder="first name" name="first_name" value="' . $form['first_name'] . '" />';
	//  --------------------------------------------------
	echo '<input class="span-6 right" type="text" id="last_name" placeholder="last name" name="last_name" value="' . $form['last_name'] . '" /></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">about you</label><textarea class="clear span-12 tall" type="text" id="about" placeholder="about you!" name="about" >' . $form['about'] .'</textarea></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<a class="js-expand-button "><h3 class="color-7 text-right">Change your Password</h3></a>';
	echo '<div id="password-form" class="js-expand span-10 res right" >';
		echo '<div class="sep-5">&nbsp;</div>';
		//  --------------------------------------------------
		//  EMAIL, USERNAME AND PASSWORD INPUTS
		echo '<p class="clear span-12 left" ><label class="clear ">current password</label><input class="clear span-12 js-required js-clear-input" type="password" placeholder="your current password" id="old_password" rel="enter your current password" value="" /></p>';
		//
		echo '<div class="sep-5">&nbsp;</div>';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><label class="clear ">new password</label><input class="clear span-12 js-required js-password js-clear-input" type="password" placeholder="your new password" id="new_password_1" rel="enter your new password" value="" /></p>';
		//
		echo '<div class="sep-5">&nbsp;</div>';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><label class="clear ">verify your new password</label><input class="clear span-12 js-required js-password js-clear-input" type="password" placeholder="your new password" id="new_password_2" rel="enter your new password" value="" /></p>';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><input class="right" id="password-submit" type="submit" name="button" value="Save Password" /></p>';
		//  --------------------------------------------------
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//
	echo '</div>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">your website</label><input class="clear span-12" type="text" id="website" placeholder="website address.." name="website" value="' . $form['website'] . '" ></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">your twitter</label><input class="clear span-12" type="text" id="twitter" placeholder="twitter name" name="twitter" value="' . $form['twitter'] . '" ></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">your facebook</label><input class="clear span-12" type="text" id="twitter" placeholder="twitter name" name="twitter" value="' . $form['twitter'] . '" ></p>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
	//  --------------------------------------------------
	//  HIDDEN INPUTS
	echo '<input type="hidden" id="id" name="id" value="' . $form['id'] . '" />';
	echo '<input type="hidden" id="id_image" name="id_image" value="' . $form['id_image'] . '" />';
	echo '<input type="hidden" id="redirect" name="redirect" value="/account/edit-profile/" />';
	echo '<input type="hidden" id="hash" name="hash" value="' . $form['hash_secret'] . '" />';
	echo '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><input class="right" id="signup-submit" type="submit" name="button" value="Save" /></p>';
	//  --------------------------------------------------
	echo '</form>';
	//
	echo '<div class="sep-10">&nbsp;</div>';
//  --------------------------------------------------
?>