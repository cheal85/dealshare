<?php
//  ---------------------------------------------------------------
//  SPLIT URL
if (isset($_GET['url'])) {
	$url = $_GET['url'];
	//	set the page type
	$PAGE_TYPE	= $_GET['page-type'];
	//	explode the request array
	$urlArray	= explode('/', $_GET['url']);

	switch ($PAGE_TYPE)
	{
		case 'user-deals' :
			$USER_HASH		= $urlArray[0];
			$USER_ID		= $urlArray[1];
			break;
		case 'view-deal' :
			$URL_TITLE 			= $urlArray[0];
			$DEAL_HASH			= $urlArray[1];
			$DEAL_ID			= $urlArray[2];
			break;
		case 'account-activation' :
			$USER_HASH			= $urlArray[0];
			$USER_ID			= $urlArray[1];
			break;
		default:
			$RANDOM_CODE		= $urlArray[0];
			break;
	}
}
//  ---------------------------------------------------------------
//  SEARCH AND BROWSING OPTIONS
$search = $_GET['search'];

//  ---------------------------------------------------------------
//  INITATE DB CONNECTION
require_once (DIR_PHP_CLASSES . '/class.DbManager.php');
//  CONNECT
$myDbManager = new DbManager(HOST, DB_NAME, DB_USER, PASSWORD);
//  ---------------------------------------------------------------
//  LOAD FILES
require_once (DIR_PHP_FUNCTIONS . '/load.styles.php');
require_once (DIR_PHP_FUNCTIONS . '/jsonEncode.php');
require_once (DIR_PHP_FUNCTIONS . '/files.php');
require_once (DIR_PHP_FUNCTIONS . '/formatting.php');
require_once (DIR_PHP_FUNCTIONS . '/randomCode.php');
require_once (DIR_PHP_FUNCTIONS . '/hashing.php');
//  ---------------------------------------------------------------
//  LOAD CLASSES
require_once (DIR_PHP_CLASSES . '/class.DataManager.php');
require_once (DIR_PHP_CLASSES . '/class.AnalyticsManager.php');
require_once (DIR_PHP_CLASSES . '/class.ImageManager.php');
require_once (DIR_PHP_CLASSES . '/class.UserManager.php');
require_once (DIR_PHP_CLASSES . '/class.DealManager.php');
require_once (DIR_PHP_CLASSES . '/class.CommentManager.php');
require_once (DIR_PHP_CLASSES . '/class.MerchantManager.php');
require_once (DIR_PHP_CLASSES . '/class.AffiliateManager.php');
require_once (DIR_PHP_CLASSES . '/class.EmailManager.php');

//  ---------------------------------------------------------------
//  INITIATE CLASSES - UNIVERSAL
$myDataManager = new DataManager();
//  ---------------------------------------------------------------
$myAnalyticsManager = new AnalyticsManager();
//  ---------------------------------------------------------------
$myImageManager = new ImageManager();
//  ---------------------------------------------------------------
$myUserManager = new UserManager();
//  ---------------------------------------------------------------
$myDealManager = new DealManager();
//  ---------------------------------------------------------------
$myCommentManager = new CommentManager();
//  ---------------------------------------------------------------
$myMerchantManager = new MerchantManager();
//  ---------------------------------------------------------------
$myAffilliateManager = new AffiliateManager();
//  ---------------------------------------------------------------
$myMailManager = new MailManager();
//  ---------------------------------------------------------------
//  Load arrys
require_once (DIR_PHP . '/arrays.php');




//  ---------------------------------------------------------------
//  CHECK FOR LOGIN AND TRANSFER USER DATA TO LOCAL VARIABLE
if((isset($_SESSION[SITE_NAME]['LOGGED_ID'])) && ($_SESSION[SITE_NAME]['LOGGED_ID'] != ''))
{
	//  -----------------------------------------------------------
	//  LOGGED_IN will be used to test for a user
	define('LOGGED_IN', true);
	define('LOGGED_IN_ID', $_SESSION[SITE_NAME]['LOGGED_ID']);
	//  -----------------------------------------------------------
	$USER = format($myUserManager -> GetEntry($_SESSION[SITE_NAME]['LOGGED_ID']));
}
else
{
	define('LOGGED_IN', false);
	//  -----------------------------------------------------------
	$USER = format($myUserManager -> GetUser(10));
}
//  ---------------------------------------------------------------


?>