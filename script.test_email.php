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

$template = 'temp_test.php';

if($myMailManager -> TestEmail($post, $template)) {

}

?>