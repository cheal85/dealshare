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
$json_array = array('success' => false, 'message' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myUserManager;
	//  -----------------------------------------
	//  Check that Account does not exist
	if(!$db_manager -> AccountExists($post['email']))
	{
		if($db_manager -> UsernameAvailable($post['user_name'])) {
			//  Account does not exist
			//  Create Ignore Array
			$ignoreArray	= array('button', 'redirect', 'submit');
			//  Create row in database
			$post['hash_secret'] = generate_hash(16, 'mixed');
			$post['hash'] = generate_hash(8, 'mixed-upper');
			$post['password'] = HashPassword($post['password']);
			//  -----------------------------------------
			$post['name'] = $post['user_name'];
			//  -----------------------------------------
			if($newId = $db_manager -> CreateEntry())
			{
				$post['active'] = 'no'; //  FOR TESTING!
				//  ----------------------------------------
				//  Build Entry
				if($db_manager -> BuildEntry($newId, $post, $ignoreArray)) {
					$post['id'] = $newId;
					//  ----------------------------------------
					//  EMAIL FUNCTIONALITY
					//  Create Activation Link
					$post['activation_link'] = SITE_ROOT . '/account/activation/' . $post['hash'] . '/' . $post['id'] . '/';
					//
					if($myMailManager -> SendActivationEmail($post)) {
						$json_array['success'] = true;
						$json_array['message'] = 'We have emailed you instructions for activating your account';	
					}
					else {
						$json_array['message'] = 'There was an error sending your Activation email';	
					}
					//  ----------------------------------------
				}
				else {
					$json_array['message'] = 'There was an error saving your information';	
				}
				//  ----------------------------------------
			}
			else
			{
				$myDbManager -> debug('id: ' . var_dump($newId));
				$json_array['message'] = 'Failed to create your account';
			}
		}
		else {
			$json_array['message'] = 'The requested username is not available';	
		}
	}
	else
	{
		$json_array['message'] = 'This account already exists';	
	}
}
else
{
		$json_array['message'] = 'No Details provided';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>