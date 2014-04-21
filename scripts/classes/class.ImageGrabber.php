<?php

class ImagerGrabber
{
	protected $link 	= '';
		
	
	
    public function __construct()
    {

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
				
		foreach ($this -> size as $title => $int)
		{
			$thisPath = DIR_ROOT . '/' . $source['path'] . $title . '/';
			if(!file_exists($thisPath)) mkdir($thisPath);
			copy(DIR_ROOT . '/' . $source['path'] . 'full/' . $source['filename'],  $thisPath . $source['filename']);
			//  RESIZE IMAGE!!!!!!!!!!!  -------------------------
		}
				
	}
	//  ----------------------------------------------------------
}
