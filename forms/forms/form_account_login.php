<?php
//  --------------------------------------------------
//  LOGIN FORM
echo '<form id="form-login" class="" method="post">';
//  --------------------------------------------------
//  EMAIL AND PASSWORD INPUTS
echo '<label for="email">Email:*</label>';
echo '<input type="email" id="email" name="email" value="" ><br>';
//  --------------------------------------------------
echo '<label for="password">Password:*</label>';
echo '<input type="password" id="password" name="password" value="" ><br>';
//  --------------------------------------------------
//  HIDDEN INPUTS
echo '<input type="hidden" id="redirect" name="redirect" value="' . THIS_PAGE . '" ><br>';
echo '<input type="hidden" name="submit" value="1" ><br>';
//  --------------------------------------------------
echo '<input id="login-submit" type="submit" name="button" value="Login">';
//  --------------------------------------------------
echo '</form>';
//  --------------------------------------------------
?>