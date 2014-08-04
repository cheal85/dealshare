<?php
echo '<div class="clear span-12 centre" >';
//  --------------------------------------------------
//  LOGIN FORM
echo '<form id="form-contact" class="span-12 " method="post">';
//  --------------------------------------------------
//  EMAIL AND PASSWORD INPUTS
echo '<p class="clear span-12 left" ><input class="clear span-12 js-required" type="text" id="name" placeholder="your name" name="name" rel="Please enter your name"  value="" ></p>';
echo '<div class="sep-10">&nbsp;</div>';
//  --------------------------------------------------
echo '<p class="clear span-12 left" ><input class="span-12 clear js-required " type="text" id="email" name="email" placeholder="your email address" rel="We require your email address" value="" ></p>';
echo '<div class="sep-10">&nbsp;</div>';
//  --------------------------------------------------
echo '<p class="clear span-12 left" ><textarea class="span-12 clear js-required tall" type="text" rel="You must include a message" placeholder="your message.." id="message" name="message"  ></textarea></p>';
//  --------------------------------------------------
//  HIDDEN INPUTS
echo '<input type="hidden" id="redirect" name="redirect" value="/" ><br>';
echo '<input type="hidden"  name="submit" value="1" ><br>';
//  --------------------------------------------------
echo '<p class="clear span-12  centre" ><input class="" id="contact-submit" type="submit" name="button" value="Send"></p>';
//  --------------------------------------------------
echo '</form>';
//  --------------------------------------------------
echo '</div>';
?>