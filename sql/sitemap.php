<?php
//	-----------------------------------------------
define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
//	-----------------------------------------------
$isoLastModifiedSite = "";
$newLine = "\n";
$indent = " ";
//	set root
if (!$rootUrl) $rootUrl = SITE_ROOT;
//	start headers
$xmlHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>$newLine";
$urlsetOpen = "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">$newLine";
$urlsetValue = "";
$urlsetClose = "</urlset>$newLine";
//	encode url string
function makeUrlString ($urlString) {
    return htmlentities($urlString, ENT_QUOTES, 'UTF-8');
}
//	makes timestamp
function makeIso8601TimeStamp ($date_time) {
    if (!$date_time) {
        $date_time = date('Y-m-d H:i:s');
    }
    if (is_numeric(substr($date_time, 11, 1))) {
        $isoTS = substr($date_time, 0, 10) ."T"
                 .substr($date_time, 11, 8) ."+00:00";
    }
    else {
        $isoTS = substr($date_time, 0, 10);
    }
    return $isoTS;
}
//	makes url tag
function makeUrlTag ($url, $modifieddate_time, $change_frequency, $priority) {
    GLOBAL $newLine;
    GLOBAL $indent;
    GLOBAL $isoLastModifiedSite;
    $urlOpen = "$indent<url>$newLine";
    $urlValue = "";
    $urlClose = "$indent</url>$newLine";
    $locOpen = "$indent$indent<loc>";
    $locValue = "";
    $locClose = "</loc>$newLine";
    $lastmodOpen = "$indent$indent<lastmod>";
    $lastmodValue = "";
    $lastmodClose = "</lastmod>$newLine";
    $changefreqOpen = "$indent$indent<changefreq>";
    $changefreqValue = "";
    $changefreqClose = "</changefreq>$newLine";
    $priorityOpen = "$indent$indent<priority>";
    $priorityValue = "";
    $priorityClose = "</priority>$newLine";

    $urlTag = $urlOpen;
    $urlValue     = $locOpen .makeUrlString("$url") .$locClose;
    if ($modifieddate_time) {
     $urlValue .= $lastmodOpen .makeIso8601TimeStamp($modifieddate_time) .$lastmodClose;
     if (!$isoLastModifiedSite) { // last modification of web site
         $isoLastModifiedSite = makeIso8601TimeStamp($modifieddate_time);
     }
    }
    if ($change_frequency) {
     $urlValue .= $changefreqOpen .$change_frequency .$changefreqClose;
    }
    if ($priority) {
     $urlValue .= $priorityOpen .$priority .$priorityClose;
    }
    $urlTag .= $urlValue;
    $urlTag .= $urlClose;
    return $urlTag;
}
//	-------------------------------------------------------------------------
//	add deal pages
//	-------------------------------------------------------------------------
$lang			= 'en';
$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);

//  Get root catagories
if($pages = $myDealManager -> GetAll()) {
	#print 'test <br />';
	$root = 'deal';
	//  loop root categories
	for($ii=0; $ii<count($pages); $ii++)
	{
		$slug			= $pages[$ii]['url_safe'] . '/' . $pages[$ii]['hash'] . '/' . $pages[$ii]['id'] . '/'; 
		$lang			= 'en';
		
		//  Create page block info
		$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/' . $slug, date('Y-m-d H:i:s'), 'monthly', 1.0);
	}
}
#print $urlsetValue;

//
if($pages = $myUserManager -> GetAll()) {
	$root = 'user-deals';
	//  loop root categories
	for($ii=0; $ii<count($pages); $ii++)
	{
		$slug			= $root . '/' . $pages[$ii]['hash'] . '/' . $pages[$ii]['id'] . '/'; //  slug construction
		$lang			= 'en';
		
		//  Create page block info
		$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/' . $slug, date('Y-m-d H:i:s'), 'monthly', 1.0);
	}
}
#print $urlsetValue;
//  HARDCODE SITE MAP
$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/about/', date('Y-m-d H:i:s'), 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/contact/', date('Y-m-d H:i:s'), 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (SITE_ROOT . '/help-browser/', date('Y-m-d H:i:s'), 'monthly', 1.0);

//	-------------------------------------------------------------------------
#if (!$isoLastModifiedSite) { // last modification of web site
#    $isoLastModifiedSite = makeIso8601TimeStamp(date('Y-m-d H:i:s'));
#}
#$urlsetValue .= makeUrlTag ("$rootUrl/what-is-new.htm", $isoLastModifiedSite, "daily", "1.0");
#Dealing with a larger amount of pages, you should print the <url> tag on each iteration followed by a flush(). If you publish tens of thousands of pages, you should provide multiple sitemaps and a sitemap index. Each sitemap file that you provide must have no more than 50,000 URLs and must be no larger than 10MB.
//	start headers
header('Content-type: application/xml; charset="utf-8"',true);
//	print code
print "$xmlHeader $urlsetOpen $urlsetValue $urlsetClose";
