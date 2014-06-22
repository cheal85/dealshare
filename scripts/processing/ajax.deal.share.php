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
$json_array = array('success' => false, 'message' => '', 'html' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myDealManager;
	//  ------------------------------------------
	//  INCREMENT SHARES
	if($db_manager -> Increment($post['id'], 'meta_shares')) {
		if(LOGGED_IN) $myUserManager -> Increment($USER['id'], 'meta_shares_external');
		$json_array['success'] = true;
	}
	//  ------------------------------------------
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>