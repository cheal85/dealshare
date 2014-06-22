<?php
ob_start();
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
require_once (DIR_PHP_CLASSES . '/class.Uploader.php');
//  --------------------------------------------
//  AJAX PROCESSING FOR UPLOAD
//
//  Upload an image to our server
//  --------------------------------------------
$GLOBALS['myDbManager'] -> debug('upload image');
//	GET params passed
$today				= date('Y-m-d', time());
$user 				= (isset($USER['id']) ? $USER['id'] : '19');
//  --------------------------------------------
$uploadPathDb		= '/web_uploads/images/' . $user . '/' . $today . '/';
//  --------------------------------------------
$pathStep1			= DIR_ROOT . '/web_uploads/images/' . $user . '/';
$uploadPath			= $pathStep1 . $today . '/';
//  --------------------------------------------
$uploadPathFull		= $uploadPath . 'full/';  // Path for Original image
$GLOBALS['myDbManager'] -> debug('path: ' . SITE_ROOT . $uploadPathDb . 'full/');
$GLOBALS['myDbManager'] -> debug('path: ' . $uploadPathFull);
//	-------------------------------------------------------------------------------------------------------
//  META VARIABLES ABOUT UPLOAD
$allowedExtensions = array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'JPG', 'JPEG', 'GIF', 'PNG', 'BMP');
$sizeLimit = 6 * 1024 * 1024;
$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
//	-------------------------------------------------------------------------------------------------------
//	CREATE DIRECTORY
if(!file_exists($pathStep1)) mkdir($pathStep1, 0777);
if(!file_exists($uploadPath)) mkdir($uploadPath, 0777);
if(!file_exists($uploadPathFull)) mkdir($uploadPathFull, 0777);


if(is_dir($uploadPathFull)) {
	$GLOBALS['myDbManager'] -> debug('directory exists');
}
else {
	$GLOBALS['myDbManager'] -> debug('directory doesn\'t exist');
}
if(is_writable($uploadPathFull)) {
	$GLOBALS['myDbManager'] -> debug('directory is writable');
}
else {
	$GLOBALS['myDbManager'] -> debug('directory is not writable');
}
//	-------------------------------------------------------------------------------------------------------
//	UPLOAD
$data = $uploader->handleUpload($uploadPathFull);
//	-------------------------------------------------------------------------------------------------------
//  ADD TO DATABASE
$id = $myImageManager -> CreateEntry();
//  -------------------------------------------------------------------------------------------------------
//  Set further data
$size = getimagesize(DIR_ROOT . $uploadPathDb . 'full/' . $data['filename']);
//  --------------------------------------------------
//  GET ORIENTATION
if($size[1] >= $size[0]) {
	$data['orientation'] = 'portrait';
}
else {
	$data['orientation'] = 'landscape';
}
//  --------------------------------------------------
$data['width'] 	= $size[0];
$data['height'] = $size[1];
$data['path'] 	= $uploadPathDb;
$data['id'] 	= $id;
//	-------------------------------------------------------------------------------------------------------
$myImageManager -> BuildEntry($id, $data, array('success', 'id'));
$GLOBALS['myDbManager'] -> debug(ob_get_contents());
ob_end_clean();
echo htmlspecialchars(json_encode($data), ENT_NOQUOTES);
$GLOBALS['myDbManager'] -> debug(htmlspecialchars(json_encode($data), ENT_NOQUOTES));
?>
