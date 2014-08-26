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
//  test that link exists  ---------------------
	$file_headers = @get_headers($_POST['link']);
	if(strpos($file_headers[0], '404')) {
		$authenticated = false;
		$link_exists = false;
	}
	else {
		$authenticated = true;	
		$link_exists = true;
	}
	//  authenticate content permissions
	if($post['id']) {  //  if existing content
		if($user = format($myDealManager -> GetEntry($post['id']))) {
			$db_secret = $user['hash_secret'];
			$post_secret = $post['hash_secret'];
			//  hash secrets do not match
			if($db_secret != $post_secret) $authenticated = false;
		}
		else {  // no db entry found
			$authenticated = false;
		}
	}
//  --------------------------------------------
//  create return variables
$json_array = array('success' => false, 'message' => '', 'goto' => '/', 'error_input' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myDealManager;
	//
	if(!$link_exists) {
		$json_array['message'] = 'Invalid link.  Please ensure the url you have entered is correct.';
		$json_array['error_input'] = 'link';
	}
	//  -----------------------------------------
	//  define elements of form that will not
	//  be added to the database
	$ignore = array('id', 'redirect', 'submit' );
	//  -----------------------------------------
	//  test if we have a merchant
	if($post['id_merchant'] != '') {
		//  Get the Merchant name (Phase 2)
		$merchant = $myMerchantManager -> GetEntry($post['id_merchant']);
		#$post['merchant_title'] = $merchant['title'];
	}
	else {
		if($merchant = $myMerchantManager -> DiscoverMerchant($post['link'])) {
			$post['id_merchant'] = $merchant['id'];
			#$post['merchant_title'] = $merchant['title'];
		}
	}
	//  -----------------------------------------
	//  Set Affiliate Link
	$GLOBALS['myDbManager'] -> debug('set affiliate');
	if($link = $myMerchantManager -> SetAffiliate($post['link'], $merchant['id_affiliate'], $merchant['merchant_key'])) {
		//  test affiliate link exists
		$file_headers = @get_headers($link);
		if(strpos($file_headers[0], '404')) {
		}
		else {
			$post['link'] = $link;
		}
	}
	//  -----------------------------------------
	//  Check is this a new deal or existing
	if($post['id'] != '')
	{  //  existing deal 
		$myDbManager -> debug('deal existing');
		$id = $post['id'];
		$json_array['message'] = 'Your Deal has been successfully updated.';
	}
	else
	{  //  new deal
		//  create item hash
		$post['hash_secret'] = generate_hash(16, 'mixed');
		$post['hash'] = generate_hash(8, 'mixed-upper');
		//  Create database entry
		$myDbManager -> debug('title: ' . $post['title']);
		$id = $db_manager -> CreateEntry();
		$myDbManager -> debug('title: ' . $post['title']);
		//  create url safe version of title
		$post['url_safe'] = sanitize_url(substr($post['title'], 0, 50));
		$json_array['message'] = 'Your Deal has been successfully added to dealshare.ie';
	}
	//  ----------------------------------------
	//  Process information
	if(!$post['id_image']) {
		$post['id_image'] = '2';	
	}
	//  ----------------------------------------
	if( $post['date_expiry'] ) {
		$post['date_expiry'] = reformat_date( $post['date_expiry'] );
	}
	//  ----------------------------------------
	if(!$post['id_user']) {
		$post['id_user'] = LOGGED_IN_ID;	
	}
	//  ----------------------------------------
	$myDbManager -> debug('title: ' . $post['title']);
	//
	if($db_manager -> BuildEntry($id, $post, $ignore)) {
		$myUserManager -> Increment($post['id_user'], 'meta_shared_deals');
		$json_array['success'] = true;
		$json_array['goto'] .= '#' . $post['deal_type'] . 's';
	}
	
	//  ----------------------------------------
}
else
{
	if($json_array['message'] == '') $json_array['message'] = 'No Details provided';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json($json_array);
?>