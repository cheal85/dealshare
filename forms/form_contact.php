<?php
echo '<div class="clear span-12 centre" >';
//  --------------------------------------------------
//  LOGIN FORM
echo '<form id="form-contact" class="span-6 res centre" method="post">';
//  --------------------------------------------------
echo '<h2 class="color-5">Contact us!</h2>';
//  --------------------------------------------------
//  EMAIL AND PASSWORD INPUTS
echo '<p class="clear span-12 left" ><input class="span-12 left js-required " type="text" id="name" name="name" placeholder="your name" rel="Please enter your name" value="" ></p>';
//  --------------------------------------------------
echo '<p class="clear span-12 left" ><input class="span-12 left js-required " type="text" id="email" name="email" placeholder="your email" rel="We require your email address" value="" ></p>';
//  --------------------------------------------------
echo '<p class="clear span-12 left" ><textarea class="span-12 left js-required tall" type="text" rel="You must include a message" placeholder="your message.." id="message" name="message"  ></textarea></p>';
//  --------------------------------------------------
//  HIDDEN INPUTS
echo '<input type="hidden" id="redirect" name="redirect" value="/" ><br>';
echo '<input type="hidden"  name="submit" value="1" ><br>';
//  --------------------------------------------------
echo '<p class="clear span-12 left" ><input class="" id="contact-submit" type="submit" name="button" value="Send"></p>';
//  --------------------------------------------------
echo '</form>';
//  --------------------------------------------------
echo '</div>';
?>