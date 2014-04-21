<?php
//  -----------------------------------------------------
//  This script will take the entered search phrase and 
//  pass it back to the page in the url
//  -----------------------------------------------------
//  We take the search phrase AND the active tab.  It
//  will then redirect to that tab automatically.
//  -----------------------------------------------------
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
if(!$post['search']) $authenticated = false;
//  --------------------------------------------
if($authenticated) {
	$destination = SITE_ROOT;
	$destination = '/';
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myAnalyticsManager;

	if($post['search']) $search = $post['search'];
	if($post['tab']) $tab = $post['tab'];
	
	if($search) {
		//  Add search query to url
		$destination .= '?search=' . urlencode(trim($search)); 
		if($tab) {
			$destination .= '#' . $tab; 
		}
		//  ---------------------------------
		//  RECORD ANALYTICS INFORMATION
		$analytics = array();
		$analytics['type'] = 'search';
		$analytics['search'] = addslashes($search);
		if(LOGGED_IN) {
			$analytics['id_user'] = $USER['id'];
		  	$analytics['user_name'] = $USER['name'];
		}
		$id = $db_manager -> CreateEntry();
		if($db_manager -> BuildEntry($id, $analytics, array('id'))) {

		}
		//  ---------------------------------
	}
	header('location: ' . $destination);
	exit();
}
else {
	header("location: /");
}

?>