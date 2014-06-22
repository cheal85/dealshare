<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
#define('ROOT', 'D:\hshome\stru\dealshare.myirishdiscounts.com');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
if(ONLINE) header("location: /");
//  -----------------------------------------------------
//  PAGE SPECIFIC DATA
define('PAGE_TITLE', 'Dealshare - home');
define('PAGE_DESCRIPTION', 'Dealshare Website');
//  -----------------------------------------------------
//  SET PAGE AND NAV SELECTION
$nav = 'homepage';
$page = 'homepage';
//  -----------------------------------------------------
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <?php
		#print '<link href = "styling/main.css" rel = "stylesheet" type="text/css" />';

		LoadStyles();
		?>
  	<!-- WGCCxxx -->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <script type="text/javascript">var JS_SITE_ROOT	= '<?php echo(SITE_ROOT); ?>';</script>
        <script src="/java/jquery-1.8.0.min.js"></script>
        <script src="/java/loader.js"></script>
        <script src="/java/vendor/modernizr-2.6.2.min.js"></script>
    </head>
<body>
    <?php if(ONLINE) include_once(DIR_ROOT . '/analytics.php');?>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <?php
        		
		//  ----------------------------------------------------------
		//  BUILD STRUCTURE
		//  ----------------------------------------------------------
		//  SEND EMAIL
		/*
		echo '<p>Send e-mail</p>';
		$arr = array('email' => 'cathal.healy@gmail.com', 'user_name' => 'Cathal', 'activation_link' => 'http://www.dealshare.ie/account/activation/HASH/ID/');
		
		if($myMailManager -> SendActivationEmail($arr)) {
			echo '<p>email sent</p>';
		}
		else {
			echo '<p>email not sent</p>';	
		}
		*/
		//  GET IMAGE
		require_once (DIR_PHP_CLASSES . '/class.Parser.php');
		echo 'GET IMAGES';
		
		/*
		$tmp = file_get_html('http://www.google.com/');

		// Find all images 
		foreach($tmp->find('img') as $element) 
		       echo $element->src . '<br>';
			   */
			   
		$link = 'http://www.currys.ie/Product/JVC-LT32TW51J-Smart-32-LED-TV/319241/6.9.0';
		# Use the Curl extension to query Google and get back a page of results
		$url = $link;
		$ch = curl_init();
		$timeout = 5;
		$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';

		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$html = curl_exec($ch);

		curl_close($ch);
		
		# Create a DOM parser object
		$dom = new DOMDocument();
		
		# Parse the HTML from Google.
		# The @ before the method call suppresses any warnings that
		# loadHTML might throw because of invalid HTML in the page.
		@$dom->loadHTML($html);
		
		# Iterate over all the <a> tags
		foreach($dom->getElementsByTagName('img') as $link) {
		        # Show the <a href>
		        echo $link->getAttribute('src');
		        echo "<br />";
		}
		/*
		$html = file_get_html($link);
		//
		foreach($html->find('a') as $element) {
			//  --------------------------------------------------
			//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
			echo $element->id . '<br />';
			echo $element->href . '<br />';
		}
		foreach($html->find('img') as $element) {
			//  --------------------------------------------------
			//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
			echo $element->id . '<br />';
			echo $element->src . '<br />';
		}
		//base url
		/*
	    $base = 'https://play.google.com/store/apps';
	
	    //home page HTML
	    $html_base = file_get_html( $base );
	
	    //get all category links
	    foreach($html_base->find('a') as $element) {
	        echo "<pre>";
	        print_r( $element->href );
	        echo "</pre>";
	    }
	
	    $html_base->clear(); 
	    unset($html_base);
		*/
		//  ----------------------------------------------------------
		//  BUILD STRUCTURE
		//  ----------------------------------------------------------
		?>

		<?php
		/*
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
		*/
        ?>
    </body>
</html>
