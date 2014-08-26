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

$girls = array();

$girls[0] = array();

$girls[0]['name'] = 'Kaitlyn';
$girls[0]['age'] = 9;

$girls[1] = array();

$girls[1]['name'] = 'Morgan';
$girls[1]['age'] = 2;


for($i=0; $i<count($girls); $i++) {
	print $girls[$i]['name'] . ' is ' . $girls[$i]['age'] . ' years old.<br />';
}


?>