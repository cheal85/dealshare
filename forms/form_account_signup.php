<?php
//  --------------------------------------------------
//  SIGNUP FORM
echo '<form id="form-signup" class="" method="post">';
//  --------------------------------------------------
//  EMAIL, USERNAME AND PASSWORD INPUTS
#echo '<label for="email">Email</label>';
echo '<p class="input" ><input class="clear left full js-required" type="email" id="email" placeholder="Email" name="email" rel="We need your email" value="" ></p>';
//  --------------------------------------------------
#echo '<label for="user_name">Username</label>';
#echo '<input type="text" id="user_name" name="user_name" value="" ><br>';
//  --------------------------------------------------
#echo '<label for="password">Password</label>';
echo '<p class="input" ><input class="clear left full js-required" type="password" id="password" placeholder="Password" name="password" rel="Give your account a password" value="" ></p>';
//  --------------------------------------------------
//  HIDDEN INPUTS
echo '<input type="hidden" id="redirect" name="redirect" value="/" ><br>';
echo '<input type="hidden" name="submit" value="1" ><br>';
//  --------------------------------------------------
echo '<p class="input" ><input class="clear left full" id="signup-submit" type="submit" name="button" value="Sign up">';
//  --------------------------------------------------
echo '<div class="message success"></div>';
echo '</form>';
//  --------------------------------------------------
?>