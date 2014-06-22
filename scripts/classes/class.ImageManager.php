<?php

class ImageManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $from 	= "FROM data_images d ";
	protected $table 	= "data_images ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.id ";
	protected $limit 	= "";
	
	protected $id 		= 0;
	
	protected $size	= array();
	
	
    public function __construct()
    {
		#$GLOBALS['myDbManager'] -> debug('image construct');
		#parent::__contruct();
		$this -> size['tiny'] = 80;
		$this -> size['small'] = 100;
		$this -> size['medium'] = 250;
		$this -> size['large'] = 450;
		$this -> size['v_large'] = 800;
		$this -> size['huge'] = 1000;
    }
	//  ----------------------------------------------------------
	public function SetImage($id)
	{
		$this -> id = $id;
	}	
	
	//  ----------------------------------------------------------
	public function ProcessImage()
	{
		//  ---------------------------------------------------
		//  GET IMAGE
		$tmp = $this -> GetWhere(array('id'), array($this -> id));
		$source = $tmp[0];
		
		switch($tmp[0]['ext']) {
			case 'jpg':
			case 'JPG':
				$source_img = imagecreatefromjpeg( DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename']);
				break;
		
			case 'png':
			case 'PNG':
				$source_img = imagecreatefrompng( DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename']);
				break;
		
			case 'gif':
			case 'GIF':
				$source_img = imagecreatefromgif( DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename']);
				break;
			
			default:
				break;
		}
		#$source_img = DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename'];
				
		$width = $source['width'];
		$height = $source['height'];
			
		foreach ($this -> size as $title => $int)
		{
			$thisPath = DIR_ROOT . '/' . $source['path'] . $title . '/';
			$dest_img = $thisPath . $source['filename'];
		
			if(!file_exists($thisPath)) mkdir($thisPath, 0777);
			
			$ratio =  $int / $height;
			$new_height = $height * $ratio;
			$new_width = $width * $ratio;
			
			if($source['orientation'] == 'portrait') {
				$ratio =  $int / $width;
				$new_height = $height * $ratio;
				$new_width = $width * $ratio;
			}
			#copy(DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename'],  $thisPath . $source['filename']);
			//  RESIZE IMAGE!!!!!!!!!!!  -------------------------
			// create a new temporary image
			$tmp_img = imagecreatetruecolor( $new_width, $new_height );
			// copy and resize old image into new image 
			if(!imagecopyresampled($tmp_img, $source_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height )) {
				$GLOBALS['myDbManager'] -> debug('Error processing image: ' . $this -> id);
			}
			// save thumbnail into a file
			
			switch($tmp[0]['ext']) {
				case 'jpg':
				case 'JPG':
					imagejpeg( $tmp_img, $dest_img );
					break;
			
				case 'png':
				case 'PNG':
					imagepng( $tmp_img, $dest_img );
					break;
			
				case 'gif':
				case 'GIF':
					imagegif( $tmp_img, $dest_img );
					break;
				
				default:
					break;
			}
		}
						
	}
	//  ----------------------------------------------------------
	public function GetImage($id, $size = 'huge') 
	{
		$image = format($this -> GetEntry($id));
		
		$image['full_path'] = $image['path'] . $size . '/' . $image['filename'];
		//  Creat Full Path
		$GLOBALS['myDbManager'] -> debug($image['full_path']);
		
		if(!file_exists(DIR_ROOT . '/' . $image['full_path'])) {
			//  Doesn't exists - use original
			$image['full_path'] = $image['path'] . 'full/' . $image['filename'];
			if(!file_exists(DIR_ROOT . '/' . $image['full_path'])) {
				//  Doesn't exist - use placeholder
				$image = format($this -> GetEntry('1'));
				$image['full_path'] = $image['path'] . $size . '/' . $image['filename'];
			}
		}
		return $image;
	}
}

?>