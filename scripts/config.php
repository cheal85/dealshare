<?php
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');
//  --------------------------------------------
//  SITE CONFIGURATION
define('ONLINE', false);
define('DEBUG', false);
//  --------------------------------------------
//  DATABASE CONNECTION
if(ONLINE) {
	define('HOST', 'mysql.host.ie');
	define('DB_NAME', 'strulin_deal7s');
	define('DB_USER', 'strulin_s89Ar3e');
	define('PASSWORD', 'jwcvptBDB');
	
	//  turn off error reporting
	error_reporting(0);
	define('SEND_EMAIL', true);
}
else {
	define('HOST', 'localhost');
	define('DB_NAME', 'deal7&s_s89!Ar3e');
	define('DB_USER', 'uSer7&s_s89!Ar3e');
	define('PASSWORD', 'jwcvptBDBduL29Hq');
	
	if(DEBUG) {
		error_reporting(E_ALL ^ E_NOTICE);
	}
	else {
		error_reporting(0);
	}
	define('SEND_EMAIL', false);
}
//  --------------------------------------------
//  CREATE DIRECTORY STRINGS
//  WEB RELATIONAL STRINGS
define('SITE_ROOT', $_SERVER['SERVER_NAME']);
define('SITE_PHP', SITE_ROOT . '/scripts');
define('SITE_PHP_FUNCTIONS', SITE_PHP . '/functions');
define('SITE_PHP_CLASSES', SITE_PHP . '/classes');
define('SITE_TEMPLATES', SITE_ROOT . '/templates');
define('SITE_FORMS', SITE_ROOT . '/forms');
define('SITE_JS', SITE_ROOT . '/java');
define('SITE_STYLES', SITE_ROOT . '/styling');
define('SITE_GRAPHICS', SITE_ROOT . '/web_graphics');
//  --------------------------------------------
//  DIRECTORY RELATIONAL STRINGS
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR_PHP', DIR_ROOT . '/scripts');
define('DIR_PHP_FUNCTIONS', DIR_PHP . '/functions');
define('DIR_PHP_CLASSES', DIR_PHP . '/classes');
define('DIR_TEMPLATES', DIR_ROOT . '/templates');
define('DIR_FORMS', DIR_ROOT . '/forms');
define('DIR_JS', DIR_ROOT . '/java');
define('DIR_STYLES', DIR_ROOT . '/styling');
define('DIR_GRAPHICS', DIR_ROOT . '/web_graphics');
//  --------------------------------------------
//  SITE VARIABLES
define('EMAIL_NAME', 'Dealshare.ie');
define('EMAIL_ADDRESS', 'info@dealshare.ie');
define('SITE_NAME', 'Dealshare.ie');
define('SITE_OWNER', 'Anthony Clements');
define('PAGE_KEYWORDS', 'Promotions, Sharing, Free, Save, Saving, Printable, Deal, Offer, Voucher, Buynow, Share, Dealshare, Discount, Shopping, Shop, Online, Freebie, Vouchers, Vouchercodes, Coupon, Couponcode, Community Social, Socialcodes');
//  --------------------------------------------
define('SALT', 'mOlDsqc6tqirYy36ekQfZ3bXHZED8RPDMNlqMIj1rvvxfhAQP9MvCOtUd9ukFBrZ');
define('THIS_PAGE', $_SERVER['PHP_SELF']);
//  --------------------------------------------
//  BROWSING VARIABLES
define('CONTENT_COUNT', 6);
//  --------------------------------------------
//  pagination
if(isset($_GET['page']) && ($_GET['page'] > 0)) $PAGE = $_GET['page'];
	else $PAGE = 0;
//  --------------------------------------------
?>