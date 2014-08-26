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
//  create return variables
$json_array = array('success' => false, 'message' => '', 'html' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  break up target
	$file = end(explode('/', $post['target']));
	$ext = end(explode('.', $file));
	//  switch on extension
	switch($ext) {
		//
		case 'php':
			include(DIR_TEMPLATES . $post['target']);
			break;
		//
		default:
		
			break;
	}
	//  ------------------------------------------
	$json_array['html'] = ob_get_contents();
}
else
{
	$json_array['html'] = '';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo json_encode($json_array);
?>