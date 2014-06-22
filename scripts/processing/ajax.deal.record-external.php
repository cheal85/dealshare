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
//  test deal association
if(!$post['id']) $authenticated = false;
//  create return variables
$json_array = array('success' => false);
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myDealManager;
	//
	if($db_manager -> Increment($post['id'], 'meta_click_through')) {
		
		if(LOGGED_IN) {
			$deal = $db_manager -> GetEntry($post['id']);
			$previous_clicks = explode('__', $deal['user_clicks']);
			//  test if this user has already clicked through
			$alreadyClicked = false;
			for($i=1; $i<count($previous_clicks);$i++) {
				$myDbManager -> debug('voter: ' . $previous_clicks[$i]);
				if($previous_clicks[$i] == $USER['id']) {
					$myDbManager -> debug('exists');
					$alreadyClicked = true;	
				}
			}

			if(!$alreadyClicked) {
				//  create string
				$new_string = $deal['user_clicks'];
				if($new_string != '') $new_string .= '__';
				$new_string .= $USER['id'];
				//  update database
				$db_manager -> Update($post['id'], 'user_clicks', $new_string);
				$myUserManager -> Increment($USER['id'], 'meta_click_through');
			}
		}
		$json_array['success'] = true;
	}
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>