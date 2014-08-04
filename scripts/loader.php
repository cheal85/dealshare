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
require_once (DIR_PHP_CLASSES . '/class.CategoryManager.php');
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
$myCategoryManager = new CategoryManager();
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
//  check for remember_me cookie
$user_id = $_COOKIE['dealshare_user_id'];
$code = $_COOKIE['dealshare_user_code'];
//  check these details with our database
if($tmp = $myUserManager -> GetEntry($user_id)) {
	if($code == $tmp['remember_me']) {
		//  login this user
		$_SESSION[SITE_NAME]['LOGGED_ID'] = $user_id;
		//  reset remember_me code
		$myUserManager -> RememberMe($user_id);
		$myUserManager -> MemberCookie();
	}
}
//  ---------------------------------------------------------------
//  CHECK FOR LOGIN AND TRANSFER USER DATA TO LOCAL VARIABLE
if((isset($_SESSION[SITE_NAME]['LOGGED_ID'])) && ($_SESSION[SITE_NAME]['LOGGED_ID'] != ''))
{
	//  -----------------------------------------------------------
	//  LOGGED_IN will be used to test for a user
	define('LOGGED_IN', true);
	define('LOGGED_IN_ID', $_SESSION[SITE_NAME]['LOGGED_ID']);
	define('IS_MEMBER', true);
	//  -----------------------------------------------------------
	$USER = format($myUserManager -> GetEntry($_SESSION[SITE_NAME]['LOGGED_ID']));
	#print reputation($USER);
}
else
{
	define('LOGGED_IN', false);
	//  -----------------------------------------------------------
	//$USER = format($myUserManager -> GetUser(10));
	if($_COOKIE['dealshare_member'] && ($_COOKIE['dealshare_member'] == 'confirmed')) define('IS_MEMBER', true);
		else define('IS_MEMBER', false);
}
//  ---------------------------------------------------------------
//  set if user has agreed to cookie policy
if($_COOKIE['dealshare_allow_cookies'] && ($_COOKIE['dealshare_allow_cookies'] = 1)) {
	$ALLOW_COOKIES = true;
	//  set new cookie
	$past = (time() - (60*60*24));  //  yesterday
	setcookie('dealshare_allow_cookies', '', $past, '/'); //  remove existing
	//  -----------------------------------------------------------
	$six_months = (time() + (60*60*24*182));
	setcookie('dealshare_allow_cookies', 1, $six_months, '/'); //  set new cookie
	//  -----------------------------------------------------------
}
else {
	$ALLOW_COOKIES = false;
}
//  ---------------------------------------------------------------
?>