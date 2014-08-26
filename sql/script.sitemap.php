<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
#define('ROOT', 'D:\hshome\stru\dealshare.myirishdiscounts.com');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
require_once(DIR_PHP_FUNCTIONS . '/generate-sitemap.php');

GenerateSitemap();

?>