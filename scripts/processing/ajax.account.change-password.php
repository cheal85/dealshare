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
	//  array of keys to ignore
	$ignore = array('id', 'redirect', 'old_password', 'new_password_1', 'new_password_2', 'hash', 'submit');
	
	if(HashPassword($post['old_password']) == $USER['password']) {
		$update = array();
		$update['password'] = HashPassword($post['new_password_1']);
		//  -----------------------------------------
		//  Create database entry
		if($db_manager -> BuildEntry($post['id'], $update, $ignore)) {
			$json_array['message'] = 'Password updated';
			$json_array['success'] = true;
		}
		else {
			$json_array['success'] = false;
			$json_array['message'] = 'Error encountered';	
		}
	}
	else {
		$json_array['message'] = 'Password incorrect';	
	}
}
else
{
	$json_array['message'] = 'Authentication Failed';	
}

#$GLOBALS['myDbManager'] -> debug(ob_get_contents());
ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>