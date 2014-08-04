<?php
ob_start();  // Output buffer
session_start();
//  --------------------------------------------
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
$GLOBALS['myDbManager'] -> debug('directory: ' . DIR_PHP);
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
//  create return variables
$json_array = array('success' => false, 'message' => '', 'more' => true, 'html' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myDealManager;
	//  ----------------------------------------
	//  create array of details for data
	$array = array(
					'count' 	=> $post['count'],
					'category' 	=> $post['category']
					);
	//
	$search = $post['search'];
	if($search != '') $array['search'] = $search;
	//  ------------------------------------------
	//  LOAD DEAL CONTENT
	$GLOBALS['myDbManager'] -> debug('Ajax get entries - category: ' . $post['category']);
	if($deals = $db_manager -> GetEntries($post['page'], $array)) {
	  	$json_array['success'] = true;
		$myDbManager -> debug('deals got');
		//  ----------------------------------------------
		//  Format data before sending it back
		ob_clean();		
		for($i=0; $i<count($deals); $i++) {
			$data = format($deals[$i]);
			//  Create markup
			include(DIR_TEMPLATES . '/temp_deals_item.php');
			//  ---------------------------------------------
		}
		$json_array['html'] = ob_get_contents();
		#$GLOBALS['myDbManager'] -> debug('html: ' . ob_get_contents());
		//  ----------------------------------------------
  	}
	else {
		if((int)$post['page'] > 1) $json_array['success'] = false;	
		  else $json_array['success'] = true;
	}
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
#header("Content-type: application/json");
$myDbManager -> debug(json_encode($json_array));
echo json_encode($json_array);
?>