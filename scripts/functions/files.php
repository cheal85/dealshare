<?php



function img($id) 
{
	$tmp = $GLOBALS['myImageManager'] -> GetWhere(array('id'), array($id));
	$image = $tmp[0];

	$fullPath = $image['path'] . 'full/' . $image['filename'];

	if(file_exists(DIR_ROOT . '/' . $fullPath))
	{
		return 	$fullPath;
	}
	else
	{
		return '';	
	}
	
}

function ImageDetails($id, $size = 'full')
{
	$image = format($GLOBALS['myImageManager'] -> GetEntry($id));
	
	$image['full_path'] = $image['path'] . $size . '/' . $image['filename'];
	$GLOBALS['myDbManager'] -> debug($image['full_path']);
	if(!file_exists(DIR_ROOT . '/' . $image['full_path']))
	{
		$image = array();
	}
	else
	{
		$image['full_path'] = $image['path'] . $size . '/' . $image['filename'];
	}

	return $image;
}

function fileExists($path){
    return (@fopen($path,"r")==true);
}
?>