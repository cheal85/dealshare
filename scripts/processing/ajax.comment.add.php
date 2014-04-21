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
//  check that we have a deal id
if(!$post['id_deal']) $authenticated = false;
//  create return variables
$json_array = array('success' => false, 'message' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myCommentManager;
	//  -----------------------------------------
	//  define elements of form that will not
	//  be added to the database
	$ignore = array('id', 'redirect', 'submit');
	//  -----------------------------------------
	//  Check is this a new deal or existing
	$myDbManager -> debug('deal new');
		//  Create database entry
		$id = $db_manager -> CreateEntry();
		if($db_manager -> BuildEntry($id, $post, $ignore)) {
			$json_array['message'] = 'Your comment has been saved.';
			$json_array['success'] = true;
			$myDealManager -> Increment($post['id_deal'], 'meta_comments');
			$myUserManager -> Increment($USER['id'], 'meta_comments');
		}
	$myDbManager -> debug('comment after');
}
else
{
		$json_array['message'] = 'Comment could not be authenticated.  Please reload and try again.';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo json_encode($json_array);
?>