<?php
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');

unset($_SESSION[SITE_NAME]['LOGGED_ID']);

if(isset($_GET['redirect'])) 
{
	$destination = $_GET['redirect'];
}
else
{
	$destination = '/';
}
header('location:' . $destination);
?>