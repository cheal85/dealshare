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
//  check that the posted hash matches our database hash
if(!$post['id']) {  //  if existing content
	$authenticated = false;
}
else {
	if($user = format($myUserManager -> GetEntry($post['id']))) {
		$db_secret = $user['hash_secret'];
		$post_secret = $post['hash'];
		//  hash secrets do not match
		if($db_secret != $post_secret) $authenticated = false;
	}
	else {  // no db entry found
		$authenticated = false;
	}
}
//  test that currently looged in
if(LOGGED_IN_ID != $post['id']) $authenticated = false;
//  create return variables
$json_array = array('success' => false, 'message' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myUserManager;
	//  -------------------------------------------
	//  test that selected user name is available
	//  if changed
	$name_available = true;
	if($post['user_name'] != $user['user_name']) {
		$name_available = $db_manager -> UsernameAvailable($post['user_name']);
	}
	
	if($name_available) {
		//  -----------------------------------------
		//  define elements of form that will not
		//  be added to the database
		$ignore = array('id', 'redirect', 'hash', 'submit');
		//  -----------------------------------------
		$myDbManager -> debug('Save user');
		//  -----------------------------------------
		//  update the select 'name' to use f.name
		//  and l.name unstead of username if they
		//  have been provided
		if(($post['first_name'] != '') && ($post['last_name'] != '')) {
			$post['name'] = $post['first_name'] . ' ' . $post['last_name'];
		}
		else {
			$post['name'] = $post['user_name'];
		}
		//  Create database entry
		if($db_manager -> BuildEntry($post['id'], $post, $ignore)) {
			$json_array['message'] = 'Your Account details have been successfully amended.';
			$json_array['success'] = true;
		}
		else {
			$json_array['success'] = false;
			$json_array['message'] = 'There was an error updating your details.  Some information may not have been saved.';	
		}
		$myDbManager -> debug('After Build');
	}
	else {
		$json_array['message'] = 'The requested username is not available';	
	}
}
else
{
	$json_array['message'] = 'Could not Authenticate Account details.  Please reload and try again.';	
}

$GLOBALS['myDbManager'] -> debug(ob_get_contents());
ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>