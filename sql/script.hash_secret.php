<?php
set_time_limit(0);
//  -----------------------------------------------------
//  This script will assign a "hash secret" to all 
//  all content on the site for authentication needs
//  -----------------------------------------------------
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');

$execute = true;
if(1) {
	
	$query = array();
	$query[] = "ALTER TABLE  `data_deals` ADD  `hash_secret` VARCHAR( 64 ) NULL AFTER  `id`";
	$query[] = "ALTER TABLE  `data_users` ADD  `hash_secret` VARCHAR( 64 ) NULL AFTER  `id`";
	$query[] = "ALTER TABLE  `data_merchants` ADD  `hash_secret` VARCHAR( 64 ) NULL AFTER  `id`";
	$query[] = "ALTER TABLE  `data_comments` ADD  `hash_secret` VARCHAR( 64 ) NULL AFTER  `id`";
	$query[] = "ALTER TABLE  `data_affiliates` ADD  `hash_secret` VARCHAR( 64 ) NULL AFTER  `id`";
	
	for($i=0; $i<count($query); $i++) {
		if($execute) {
			$myDbManager -> ExecuteQuery($query[$i]);
		}
		else {
			echo $query[$i] . '<br />';	
		}
	}
	
	
	//  update deals with secret hash
	$data = $myDealManager -> GetAll();
	//
	for($i=0; $i<count($data); $i++) {
		$id = $data[$i]['id'];
		$hash = generate_hash(16, 'mixed');
		if($execute) {
			$result = $myDealManager -> UpdateEntry($id, 'hash_secret', $hash);
		}
		else {
			echo 'deal id: ' . $id . '<br />';
			echo 'hash: ' . $hash . '<br />';
		}
	}
	unset($data);
	//  update users with secret hash
	$data = $myUserManager -> GetAll();
	//
	for($i=0; $i<count($data); $i++) {
		$id = $data[$i]['id'];
		$hash = generate_hash(16, 'mixed');
		if($execute) {
			$myUserManager -> UpdateEntry($id, 'hash_secret', $hash);	
		}
		else {
			echo 'user id: ' . $id . '<br />';
			echo 'hash: ' . $hash . '<br />';
		}
	}
	unset($data);
	//  update merchants with secret hash
	$data = $myMerchantManager -> GetAll();
	//
	for($i=0; $i<count($data); $i++) {
		$id = $data[$i]['id'];
		$hash = generate_hash(16, 'mixed');
		if($execute) {
			$myMerchantManager -> UpdateEntry($id, 'hash_secret', $hash);	
		}
		else {
			echo 'merchant id: ' . $id . '<br />';
			echo 'hash: ' . $hash . '<br />';
		}
	}
	unset($data);
	//  update comments with secret hash
	$data = $myCommentManager -> GetAll();
	//
	for($i=0; $i<count($data); $i++) {
		$id = $data[$i]['id'];
		$hash = generate_hash(16, 'mixed');
		if($execute) {
			$myCommentManager -> UpdateEntry($id, 'hash_secret', $hash);	
		}
		else {
			echo 'comment id: ' . $id . '<br />';
			echo 'hash: ' . $hash . '<br />';
		}
	}
	unset($data);
	//  update affilliates with secret hash
	$data = $myAffilliateManager -> GetAll();
	//
	for($i=0; $i<count($data); $i++) {
		$id = $data[$i]['id'];
		$hash = generate_hash(16, 'mixed');
		if($execute) {
			$myAffilliateManager -> UpdateEntry($id, 'hash_secret', $hash);	
		}
		else {
			echo 'affilliate id: ' . $id . '<br />';
			echo 'hash: ' . $hash . '<br />';
		}
	}
	unset($data);
}

?>