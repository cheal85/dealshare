<?php
	$body .= '<div >';
	$body .= '<p>Dear ' . $dataArray['user_name'] . ',</p>';
	$body .= '<p>Thank you for creating an account with Dealshare.ie.  You can activation your account by following the below link:</p>';
	$body .= '<p><a herf="' . $dataArray['activation_link'] . '" title="Activate your account" >Activate your account</a></p>';
	
	$body .= '<p>If the above link does not work, please copy and paste the below link into your address bar.</p>';
	$body .= '<p>' . $dataArray['activation_link'] . '</p>';
	
	$body .= '<p>NOTICE: If you are using Google Chrome, you may get a "phishing" warning when attempting to activate your account.  This is because Dealshare.ie is a new website and we are working with Google and various other similar services to verify our domain and update their records.  If you wish to have an account with Dealshare.ie then please follow the link and choose to "proceed" if prompted.</p>';
	
	$body .= '<br /><p>We want to make Dealshare.ie the premier Irish deals community and we appreciate any feedback you may have, so feel <br />free to contact us at any time to let us know what you think of our website.</p>';
	$body .= '<p>We look forward to hearing from you</p>';
	$body .= '<br /><p>Dealshare.ie</p>';
	$body .= '</div>';
?>