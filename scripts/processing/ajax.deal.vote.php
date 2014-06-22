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
$json_array = array('success' => false, 'message' => '', 'goto' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myDealManager;
	if(LOGGED_IN) {
		$myDbManager -> debug('id exists: ' . $_POST['id']);
		$myDbManager -> debug('user exists: ' . $USER['id']);
		//  -----------------------------------------
		$deal = $db_manager -> GetEntry($post['id']);
		
		$voters = explode('__', $deal['voters']);
		//
		$alreadyVoted = false;
		for($i=1; $i<count($voters);$i++) {
			$myDbManager -> debug('voter: ' . $voters[$i]);
			if($voters[$i] == $USER['id']) {
				$myDbManager -> debug('exists');
				$alreadyVoted = true;	
			}
		}
	
		if($alreadyVoted !== true) {
			if($myDealManager -> Increment($post['id'], 'votes')) {
				$myDbManager -> debug('voters: ' . $voterString);
				$voterString = $deal['voters'];
				if($deal['voters'] == '') $voterString .= '__';
				$voterString .= $USER['id'] . '__';
				
				$db_manager -> UpdateEntry($post['id'], 'voters', $voterString);
				$json_array['success'] = true;	
				$json_array['message'] = 'Your gratitude is appreciated';
				//  assign thanks to users
				$myUserManager -> Increment($USER['id'], 'meta_thanks_given');
				$myUserManager -> Increment($deal['id_user'], 'meta_thanks_received');
			}
		}
		else {
			$json_array['message'] = 'You cannot vote on this deal again';
		}
	}
	else {
		$json_array['message'] = 'Only members can vote on deals';
	}
}
else
{
		$json_array['message'] = 'Request could not be authenticated.';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>