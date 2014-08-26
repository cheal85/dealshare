<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
#define('ROOT', 'D:\hshome\stru\dealshare.myirishdiscounts.com');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
//  -----------------------------------------------------
//  PAGE SPECIFIC DATA
define('PAGE_TITLE', 'test | Dealshare.ie');
define('PAGE_DESCRIPTION', 'Dealshare.ie | The Latest Great Deals and Offers for you to use and share!  Sign up and share your favourite deals with our other users.');
//  -----------------------------------------------------
//  SET PAGE AND NAV SELECTION
$nav = 'homepage';
$page = 'homepage';
//  -----------------------------------------------------
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" /> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
    <link rel="shortcut icon" href="/web_graphics/favicon.ico" type="image/x-icon" />
    <title><?php echo PAGE_TITLE; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="<?php echo PAGE_DESCRIPTION; ?>" />
    <meta name="keywords" content="<?php echo PAGE_KEYWORDS; ?>" />
    <meta name="owner" content="<?	echo SITE_OWNER?>" />
    <meta name="author" content="Cathal Healy" />
    <meta name="rating" content="General" />
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1 day" />
    <meta name="viewport" content="width=device-width" />  
    <meta property="og:title" content="<?php echo PAGE_TITLE; ?>" /> 
    <meta property="og:description" content="<?php echo PAGE_DESCRIPTION; ?>" /> 
    <meta property="og:image" content="<?php echo '/web_graphics/logo-HD.jpg'; ?>" />     
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <?php #LoadStyles(); ?>
  	<!-- WGCCxxx -->
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <script type="text/javascript">var JS_ROOT	= '<?php echo SITE_ROOT; ?>';</script>
    <script type="text/javascript">var JS_THIS_PAGE	= '<?php echo $page; ?>';</script>
    <script type="text/javascript">var JS_SHOW_PRIZE	= <?php echo $show_prize; ?>;</script>
    <script type="text/javascript">var JS_CATEGORY	= '<?php echo ($_GET['cat']? (int)$_GET['cat'] : ''); ?>';</script>
    <script type="text/javascript">var JS_AJAX	= true;</script>
    <script src="/java/jquery-1.8.0.min.js"></script>
    <script src="/java/vendor/modernizr-2.6.2.min.js"></script>
    <script src="/java/loader.js"></script>
</head>

<body>
	<?php
	$user = $myUserManager -> GetEntry(35);
	$myMailManager -> SendActivationEmail($user);
	#include( DIR_TEMPLATES . '/email/temp_test.php');
	?>
</body>
    

</html>
