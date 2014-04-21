<?php
//  --------------------------------------------------
//  SIGNUP FORM
echo '<div class="clear span-12 left " >';
	//  --------------------------------------------------
	echo '<h2 class="color-5">Edit your Profile</h2>';
	echo '<div class="sep-10">&nbsp;</div>';
	echo '<form id="form-edit-profile" class="clear left span-12" method="post">';
	$form = $USER;
	//  --------------------------------------------------
	//  EMAIL, USERNAME AND PASSWORD INPUTS
	echo '<p class="clear span-12 left" ><label class="clear ">email address</label><input class="clear span-12 js-required js-email" disabled=disabled type="email" id="email" name="email" rel="Your email address is required" value="' . $form['email'] . '" /></p>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">user name</label><input class="clear span-12 js-required" type="text" id="user_name" placeholder="username" name="user_name" rel="A username is required" value="' . $form['user_name'] . '" /></p>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">or your real name</label>';
	echo '<input class="clear span-6 left" type="text" id="first_name" placeholder="first name" name="first_name" value="' . $form['first_name'] . '" />';
	//  --------------------------------------------------
	echo '<input class="span-6 right" type="text" id="last_name" placeholder="last name" name="last_name" value="' . $form['last_name'] . '" /></p>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><label class="clear ">about you</label><textarea class="clear span-12" type="text" id="about" placeholder="about you!" name="about" >' . $form['about'] .'</textarea></p>';
	//  --------------------------------------------------
	#echo '<p class="clear span-12 left" ><label class="clear ">your website</label><input class="clear span-12" type="text" id="website" placeholder="website address.." name="website" value="' . $form['website'] . '" ></p>';
	//  --------------------------------------------------
	#echo '<p class="clear span-12 left" ><label class="clear ">your twitter</label><input class="clear span-12" type="text" id="twitter" placeholder="twitter name" name="twitter" value="' . $form['twitter'] . '" ></p>';
	//  --------------------------------------------------
	//  HIDDEN INPUTS
	echo '<input type="hidden" id="id" name="id" value="' . $form['id'] . '" />';
	echo '<input type="hidden" id="id_image" name="id_image" value="' . $form['id_image'] . '" />';
	echo '<input type="hidden" id="redirect" name="redirect" value="/account/edit-profile/" />';
	echo '<input type="hidden" name="hash" value="' . $form['hash_secret'] . '" />';
	echo '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><input class="right" id="signup-submit" type="submit" name="button" value="Save" /></p>';
	//  --------------------------------------------------
	echo '</form>';
echo '</div>';
//  --------------------------------------------------
?>