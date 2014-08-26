<?php
//	-----------------------------------------------
define('ROUTE_TO_ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROUTE_TO_ROOT . '/php_scripts/config.inc.php');
require_once(INC_PATH_PHP . '/top.inc.php');
//	-----------------------------------------------
$isoLastModifiedSite = "";
$newLine = "\n";
$indent = " ";
//	set root
if (!$rootUrl) $rootUrl = WEB_ROOT;
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
function makeIso8601TimeStamp ($dateTime) {
    if (!$dateTime) {
        $dateTime = date('Y-m-d H:i:s');
    }
    if (is_numeric(substr($dateTime, 11, 1))) {
        $isoTS = substr($dateTime, 0, 10) ."T"
                 .substr($dateTime, 11, 8) ."+00:00";
    }
    else {
        $isoTS = substr($dateTime, 0, 10);
    }
    return $isoTS;
}
//	makes url tag
function makeUrlTag ($url, $modifiedDateTime, $changeFrequency, $priority) {
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
    if ($modifiedDateTime) {
     $urlValue .= $lastmodOpen .makeIso8601TimeStamp($modifiedDateTime) .$lastmodClose;
     if (!$isoLastModifiedSite) { // last modification of web site
         $isoLastModifiedSite = makeIso8601TimeStamp($modifiedDateTime);
     }
    }
    if ($changeFrequency) {
     $urlValue .= $changefreqOpen .$changeFrequency .$changefreqClose;
    }
    if ($priority) {
     $urlValue .= $priorityOpen .$priority .$priorityClose;
    }
    $urlTag .= $urlValue;
    $urlTag .= $urlClose;
    return $urlTag;
}
//	-------------------------------------------------------------------------
//	add shop page
$rootPages[] = array('id' => 0, 'lang' => 'en', 'slug' => 'catalogue', 'title' => 'Shop', 'last_modified' => date('Y-m-d H:i:s'));
#$rootPages[] = array('id' => 0, 'lang' => 'en', 'slug' => 'catalogue', 'title' => 'Shop', 'last_modified' => date('Y-m-d H:i:s'));
//	-------------------------------------------------------------------------
//	loop through
for ($i=0; $i<count($rootPages); $i++)
{
	//	-------------------------------------------------------------------------
	$rootSlug		= $rootPages[$i]['slug'];
	$lang			= $rootPages[$i]['lang'];
	$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/' . $rootSlug . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);
	//	get sub pages
	//	-------------------------------------------------------------------------
	if($rootPages[$i]['slug'] == 'catalogue')
	{
		//  Get root catagories
		$catPages = $myBoProductCatalog -> GetRootCategories();
		
		//  loop root categories
		for($ii=0; $ii<count($catPages); $ii++)
		{
			$catSlug		= $catPages[$ii]['slug'] . '-c_' . $catPages[$ii]['id'] . '-'; //  slug construction
			$lang			= $catPages[$ii]['lang'];
			
			//  Create page block info
			$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/' . $rootSlug . '/' . $catSlug . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);
			
			//  Is Category a parent?
			if($myBoProductCatalog -> IsParentCategory($catPages[$ii]['id']))
			{
				//  Get sub Categories
				$catSubPages = $myBoProductCatalog -> GetCategorySubCategories($catPages[$ii]['id']);
				
				//  Loop Sub Categories
				for($iii=0; $iii<count($catSubPages); $iii++)
				{
					$subCatSlug		= $catSubPages[$iii]['slug'] . '-c_' . $catSubPages[$iii]['id'] . '-'; // slug construction
					$lang			= $catSubPages[$iii]['lang'];
					//  Create page block info
					$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/' . $rootSlug . '/' . $catSlug . '/' . $subCatSlug . '-' . $catSubPages[$iii]['slug'] . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);
					
					//  Get products for this category
					$productPages = $myBoProductCatalog -> GetProductsByCategoryId($catSubPages[$iii]['id']);
					
					//  loop products
					for($iiii=0; $iiii<count($productPages); $iiii++)
					{
						$productSlug	= $productPages[$iiii]['slug'] . '-p_' . $productPages[$iiii]['id'] . '-';
						$lang			= $productPages[$iiii]['lang'];
						//  Create page block info
						$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/' . $rootSlug . '/' . $catSlug . '/' . $subCatSlug . '/' . $productSlug . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);
					}
				}
			}
			else
			{
				//  No sub category
				//  Get products
				$productPages = $myBoProductCatalog -> GetProductsByCategoryId($catPages[$ii]['id']);	
					
				//  loop products
				for($iii=0; $iii<count($productPages); $iii++)
				{
					$productSlug	= $productPages[$iii]['slug'] . '-p_' . $productPages[$iii]['id'] . '-';
					$lang			= $productPages[$iii]['lang'];
					//  Create page block info
					$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/' . $rootSlug . '/' . $catSlug . '/' . $productSlug . '/', $rootPages[$i]['last_modified'], 'monthly', 1.0);
				}
			}
		}
	}
}
$rootPages[0]['last_modified'] = date('Y-m-d H:i:s');
//  HARDCODE SITE MAP
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/special/', $rootPages[0]['last_modified'], 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/contact/', $rootPages[0]['last_modified'], 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/legal/shipping_and_returns/', $rootPages[0]['last_modified'], 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/legal/terms_and_conditions/', $rootPages[0]['last_modified'], 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/legal/privacy_policy/', $rootPages[0]['last_modified'], 'monthly', 1.0);
$urlsetValue 	.= makeUrlTag (WEB_ROOT . '/legal/disclaimer/', $rootPages[0]['last_modified'], 'monthly', 1.0);

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
?>