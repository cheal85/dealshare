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
//  create return variables
$json_array = array('success' => false, 'message' => '', 'id_merchant' => '', 'error_input' => '');
//  --------------------------------------------
//  sanitize $_POST data
$post = sanitize_post($_POST);
//  --------------------------------------------
//  validation checks
$authenticated = true;
//  test that link exists  ---------------------
	$file_headers = @get_headers($post['link']);
	if(strpos($file_headers[0], '404')) {
		$authenticated = false;
		$link_exists = false;
		$json_array['message'] = 'Invalid link.  Please ensure the url you have entered is correct.';
		$json_array['error_input'] = 'link';
	}
	else {
		$authenticated = true;	
		$link_exists = true;
	}
//  --------------------------------------------
if(!$post['link']) $authenticated = false;
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myMerchantManager;
	//
	$ignore = array('id', 'success', 'submit');
	//
	$link = $post['link'];

	$today = date('Y-m-d', time());
	//  --------------------------------------------
	$uploadPathDb		= '/web_uploads/images/' . $USER['id'] . '/' . $today . '/';
	//  --------------------------------------------
	$path[0]			= DIR_ROOT . '/web_uploads/images/' . $USER['id'] . '/';
	$path[1]			= $path[0] . $today . '/';
	//  --------------------------------------------
	$path[2]		= $path[1] . 'full/';  // Path for Original image
	//  --------------------------------------------
	if($merchant = $db_manager -> DiscoverMerchant($link)) {
		//  --------------------------------------------
		$json_array['id_merchant'] = $merchant['id'];
		$GLOBALS['myDbManager'] -> debug('Merchant: ' . $merchant['title']);
		if($image = $myMerchantManager -> GetImage($merchant, $link, $path)) {
			//	--------------------------------------------
			//  ADD TO DATABASE
			$json_array['success'] = true;
			$image['path'] = $uploadPathDb;
			$image['title'] = '';
			$id = $myImageManager -> CreateEntry();
			$image['id'] = $id;
			$image['success'] = true;
			$myImageManager -> BuildEntry($image['id'], $image, $ignore);
			//  --------------------------------------------
			//  Declare after BuildEntry so not to break it
			$image['full_path'] = $uploadPathDb . 'full/' . $image['filename'];
			$json_array['image'] = $image;
		}
		else {
			$json_array['success'] = false;
			#$message = 'No Image could be found for this Product';
		}
	}
	else {
		if($image = $myMerchantManager -> GetImage(false, $link, $path)) {
			//	--------------------------------------------
			//  ADD TO DATABASE
			$json_array['success'] = true;
			$image['path'] = $uploadPathDb;
			$image['title'] = '';
			$id = $myImageManager -> CreateEntry();
			$image['id'] = $id;
			$image['success'] = true;
			$myImageManager -> BuildEntry($image['id'], $image, $ignore);
			//  --------------------------------------------
			//  Declare after BuildEntry so not to break it
			$image['full_path'] = $uploadPathDb . 'full/' . $image['filename'];
			$json_array['image'] = $image;
		}
		else {
			$json_array['success'] = false;
			#$message = 'No Image could be found for this Product';
		}
	}
}
else {
	if($json_array['message'] == '') $json_array['message'] = 'No Details provided';	
}
//
ob_end_clean(); // prevent stray echo statements from breaking ajax
echo json_encode($json_array);
?>