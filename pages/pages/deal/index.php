<?php
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
//  -----------------------------------------------------
//  Get Requested Deal so we can use meta data
if($data = $myDealManager -> GetDeal($DEAL_HASH, $DEAL_ID)) {
	$data = format($data);
	$PAGE_ERROR = false;
	//  --------------------------------------------------
	//  Get Image
	$image = $myImageManager -> GetImage($data['id_image'], 'large');
	$user = format($myUserManager -> GetEntry($data['id_user']));
	$user['image'] = $myImageManager -> GetImage($user['id_image'], 'small');
	//  FOR SEO
	$full_image = $myImageManager -> GetImage($data['id_image'], 'full');
	//  -----------------------------------------------------
	//  PAGE SPECIFIC DATA
	define('PAGE_TITLE', $data['title'] . ' | Dealshare.ie');
	define('PAGE_DESCRIPTION', 'Dealshare.ie | ' . short($data['description'], 30));
	//  -----------------------------------------------------
}
else {
	$PAGE_ERROR = true;	
	//  -----------------------------------------------------
	//  PAGE SPECIFIC DATA
	define('PAGE_TITLE', 'Deal not Found| Dealshare.ie');
	define('PAGE_DESCRIPTION', 'Dealshare Website');
	//  -----------------------------------------------------
}
//  -----------------------------------------------------
//  SET PAGE AND NAV SELECTION
$nav = 'deal-page';
$page = 'deal-page';

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
    <meta property="og:image" content="<?php echo SITE_ROOT . $full_image['full_path']; ?>" />     
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <?php LoadStyles(); ?>
  	<!-- WGCCxxx -->
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <script type="text/javascript">var JS_ROOT	= '<?php echo SITE_ROOT; ?>';</script>
    <script type="text/javascript">var JS_USER	= '<?php echo $USER['id']; ?>';</script>
    <script src="/java/jquery-1.8.0.min.js"></script>
    <script src="/java/vendor/modernizr-2.6.2.min.js"></script>
    <script src="/java/loader.js"></script>
    <script type='text/javascript' src='/java/jquery/jquery.user.upload.js'></script>

</head>

<body>
    <?php if(ONLINE) include_once(DIR_ROOT . '/analytics.php');?>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    

            
        <div class="header-wrapper back-color-4">
            <?php 
            include(DIR_TEMPLATES . '/temp_header.php'); 
			?>
        </div>

        <div class="content-container clear">
            
            <div class="content-wrapper ">
            	<?php include(DIR_TEMPLATES . '/temp_mobile_sidebar.php'); ?>
        		<div class="central-block">
                	<?php 
					include(DIR_TEMPLATES . '/temp_deal_detail.php'); 
					?>
               	</div>
            </div>

        </div>

        <div class="footer-container">
            <?php include(DIR_TEMPLATES . '/temp_footer.php'); ?>
        </div>
        
    </body>
</html>
