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
$json_array = array('success' => false, 'message' => '', 'html' => '', 'image' => array());
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myImageManager;
	//
	//  -------------------------------------------------------------------------------------------------------
	//  PROCESS IMAGE AND PRODUCE THUMBNAILS
	$db_manager -> SetImage($post['id']);
	#$myDbManager -> debug($myImageManager -> id);
	if($db_manager -> ProcessImage()) {
		$json_array['success'] = true;
	}
	//  -------------------------------------------------------------------------------------------------------
	$json_array['image'] = ImageDetails($post['id'], 'large');
	//	-------------------------------------------------------------------------------------------------------
}
else
{
	$json_array['message'] = 'No image found';
}

ob_end_clean();
print array2json($json_array);
?>