<?php
ob_start();  // Output buffer
session_start();
//  --------------------------------------------
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
//  --------------------------------------------
//  AJAX SCRIPT BEST PRACTICE
//
//  This script will sanitize and save
//  data to the database.  This is a 
//  standard variation which will work
//  for a great number of purposes
//  --------------------------------------------
//  test script was posted to
if(!$_POST['submit']) header("location: /");
//  --------------------------------------------
//  sanitize $_POST data
$post = sanitize_post($_POST);
//  --------------------------------------------
//  validation checks
$authenticated = true;
//  test email has been submitted
if(!$post['email']) $authenticated = false;
//  create return variables
$json_array = array('success' => false, 'message' => '');
//  --------------------------------------------
if($authenticated) {
	//  -----------------------------------------
	//  CONTACT EMAIL
	if($myMailManager -> ContactEmail($post)) {
		$json_array['success'] = true;
		$json_array['message'] = 'Your message has been sent to the site administrator';	
	}
	else {
		$json_array['message'] = 'There was an error sending your email';	
	}

}
else
{
		$json_array['message'] = 'No Details provided';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>