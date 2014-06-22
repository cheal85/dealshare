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
	//  LOAD DEAL CONTENT
	ob_clean();
	if($data = format($db_manager -> GetEntry($post['id']))) {
		include(DIR_TEMPLATES . '/lightbox/temp_view_deal.php');
		$json_array['success'] = true;
	}
	else {
		$json_array['message'] = 'Unable retreive requested deal';	
	}
	//  ------------------------------------------
	//  COMPONENT TO DISPLAY DEAL CONTENT
	$json_array['html'] = ob_get_contents();
}
else
{
	$json_array['message'] = 'Unable retreive requested deal';		
}
ob_end_clean(); // prevent stray echo statements from breaking ajax
echo json_encode($json_array);
?>