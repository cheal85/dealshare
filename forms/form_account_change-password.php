<?php
//  --------------------------------------------------
//  SIGNUP FORM
echo '<div class="clear span-12 left " >';
	//  --------------------------------------------------
	echo '<a class="js-expand-button"><h3 class="color-5">Change your Password</h3></a>';
	echo '<div class="sep-10">&nbsp;</div>';
	echo '<div class="js-expand" >';
		echo '<form id="form-change-password" class="clear left span-12" method="post">';
		$form = $USER;
		//  --------------------------------------------------
		//  EMAIL, USERNAME AND PASSWORD INPUTS
		echo '<p class="clear span-12 left" ><label class="clear ">current password</label><input class="clear span-12 js-required js-clear-input" type="password" placeholder="your current password" id="old_password" name="old_password" rel="enter your current password" value="" /></p>';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><label class="clear ">new password</label><input class="clear span-12 js-required js-password js-clear-input" type="password" placeholder="your new password" id="new_password_1" name="new_password_1" rel="enter your new password" value="" /></p>';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><label class="clear ">verify your new password</label><input class="clear span-12 js-required js-password js-clear-input" type="password" placeholder="your new password" id="new_password_2" name="new_password_2" rel="enter your new password" value="" /></p>';
		//  --------------------------------------------------
		//  HIDDEN INPUTS
		echo '<input type="hidden" id="id" name="id" value="' . $form['id'] . '" />';
		echo '<input type="hidden" id="redirect" name="redirect" value="/account/edit-profile/" />';
	echo '<input type="hidden" name="hash" value="' . $form['hash_secret'] . '" />';
	echo '<input type="hidden" name="submit" value="1" >';
		//  --------------------------------------------------
		echo '<p class="clear span-12 left" ><input class="right" id="signup-submit" type="submit" name="button" value="Save Password" /></p>';
		//  --------------------------------------------------
		echo '</form>';
	echo '</div>';
echo '</div>';
//  --------------------------------------------------
?>