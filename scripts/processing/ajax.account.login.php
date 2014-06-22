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
//  check that we have an email
if(!$post['email']) $authenticated = false;
//  create return variables
$json_array = array('success' => false, 'message' => '', 'redirect' => '/');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myUserManager;
	//  Check that Account does exist
	if($db_manager -> AccountExists($post['email']))
	{
		//  Account does exist
		//  Test password
		if($user = $db_manager -> Login($post['email'], $post['password']))
		{
			$myUserManager -> MemberCookie(); //  remember that this user is a member
			$json_array['message'] = 'Login successful';
			$json_array['success'] = true;	
			if($user['user_type'] == 'admin') $json_array['redirect'] = '/admin-ds/';
			//
			if($post['remember_me']) $myUserManager -> RememberMe($post['id']); //  login automatically in future
				else $myUserManager -> RememberMe($post['id'], true); //  remove login cookie
		}
		else
		{
			$json_array['message'] = 'Password provided is incorrect';	
		}
	}
	else
	{
		$json_array['message'] = 'No Active account found';	
	}
}
else
{
	$json_array['message'] = 'No Details provided';	
}

ob_end_clean();
print array2json($json_array);
?>