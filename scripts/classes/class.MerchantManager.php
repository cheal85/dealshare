<?php

class MerchantManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_merchants ";
	protected $from 	= "FROM data_merchants d ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.date_added DESC, d.id DESC ";
	protected $limit 	= "";
	
	
    public function __construct()
    {
		#parent::__contruct();
    }
	//  ----------------------------------------------------------
	//  TEMPLATE CODE FOR DEBUGGING TO DATABASE
		#$GLOBALS['myDbManager'] -> ExecuteQuery("INSERT INTO `debug` (`msg`) VALUES('" . $array[0]['email'] . "')");
	//  ----------------------------------------------------------

	//  ----------------------------------------------------------
	//  GET FUNCTIONS
	//  ----------------------------------------------------------
	
	//  ----------------------------------------------------------
	//  GET PAGE OF CONTENT
	//  ----------------------------------------------------------
	//  ----------------------------------------------------------

	//  ----------------------------------------------------------
	//  ----------------------------------------------------------
	//  SPECIAL FUNCTIONS
	//  ----------------------------------------------------------
	//  HERE WE WILL FIND THE MERCHANT WE ARE DEALING WITH
	public function DiscoverMerchant($url) {
		$arr = $this -> GetAll();
		$GLOBALS['myDbManager'] -> debug('url: ' . $url);
				
		
		for($i=0; $i<count($arr); $i++) {
			if(strpos($url, $arr[$i]['keyword'])) {
				$merchant = $arr[$i];
			}
		}
		
		if(isset($merchant)) {
			return $merchant;
		}
		else {
			return false;
		}
	}
	//  ----------------------------------------------------------
	//  SET AFFILIATE LINKS
	public function SetAffiliate($url, $id, $key) {
		//  Get merchant details
		$q = 	$this -> select . //CONCATENATE STRING
		"FROM data_affiliates d " . 
		"WHERE id = '" . $id . "' " .
		$GLOBALS['myDbManager'] -> debug('query: ' . $q);
		
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
		$affiliate_link = $array[0]['code'];
		$GLOBALS['myDbManager'] -> debug('affiliate link: ' . $array[0]['code']);
		if($affiliate_link != '') {
			if($key != '') {
				$affiliate_link = str_replace('__MERCHANT__', $key, $affiliate_link);	
				$affiliate_link = str_replace('__URL__', $url, $affiliate_link);
			}
			else {
				$affiliate_link = false;
			}
		}
		else {
			$affiliate_link = false;
		}
		//  Return this array or, if 'false', return empty array
		return $affiliate_link;

	}
	//  ----------------------------------------------------------
	//  THIS IS THE FUNCTION FOR GRABBING IMAGES FROM 
	//  THE REMOTE SERVER
	// 
	//  How we get the image will be dependent on the merchant
	//  site we are attempting to connect to.  
	public function GetImage($merchantArray, $link, $path) {
		$success = false;
		//
		if($merchantArray) {
			$GLOBALS['myDbManager'] -> debug('Get Image');
			$merchant = $merchantArray['title'];
			//  ---------------------------------------------------------------
			require_once (DIR_PHP_CLASSES . '/class.Parser.php');
			//  ---------------------------------------------------------------
			#$parse = new simple_html_dom_node();
			//  ---------------------------------------------------------------
			$GLOBALS['myDbManager'] -> debug('link: ' . $link);
			$html = file_get_html($link);
			//  ---------------------------------------------------------------
			$GLOBALS['myDbManager'] -> debug('Merchant: ' . $merchant);
			$images = '';
			$GLOBALS['myDbManager'] -> debug('looop html to find divs');
			$GLOBALS['myDbManager'] -> debug('images: ' . $images);
			//  ---------------------------------------------------------------
			switch($merchant) {
				case 'Pixmania' :
					foreach($html->find('meta') as $element) {
						//  --------------------------------------------------
						//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
						if(($element -> property == 'og:image') && ($element -> content != '')) {
							$remote = $element -> content;
							if(fileExists($remote)) {
								$success = true;
								break;
							}
						}
					}
					break;
				//  ----------------------------------------------------------
				case 'Amazon' :
					foreach($html->find('img') as $element) {
						//  --------------------------------------------------
						//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
						if(($element -> id == 'main-image') && ($element -> src != '')) {
							$remote = $element -> src;
							if(fileExists($remote)) {
								$success = true;
								break;
							}
						}
					}
					break;
				//  ----------------------------------------------------------
				/*
				case 'M & S' :  // DOESN'T WORK
					foreach($html->find('p.productimage') as $element) {
						//  Get a
						#$link = $element -> find('a');
						//  Get img
						$image = $element -> find('img');
						//  --------------------------------------------------
						//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
						$remote = $image -> src;
						$GLOBALS['myDbManager'] -> debug('image address: ' . $remote);
						if(fileExists($remote)) {
							$success = true;
							break;
						}
					}
					break;
				//  ----------------------------------------------------------
				case 'Currys' :
					$GLOBALS['myDbManager'] -> debug('get image');
					foreach($html->find('div.detailimagecontainer') as $element) {
						$GLOBALS['myDbManager'] -> debug('loop');
						//  --------------------------------------------------
						//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
						$image = $element -> find('img');
						$remote = $image -> src;
						$GLOBALS['myDbManager'] -> debug('image address: ' . $remote);
						if(fileExists($remote)) {
							$success = true;
							#break;
						}
					}
					break;
				//  ----------------------------------------------------------
				case 'Harvey Norman' :
					$GLOBALS['myDbManager'] -> debug('get image');
					foreach($html->find('meta') as $element) {
						//  --------------------------------------------------
						//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
						if(($element -> property == 'og:image') && ($element -> content != '')) {
							$remote = $element -> content;
							if(fileExists($remote)) {
								$success = true;
								break;
							}
						}
					}
					break;
				*/
				//  ----------------------------------------------------------
				default :
					//return false;
					break;	
			}
		}
			//  ------------------------------------------------------
			if($success == true) {
				return $this -> ProcessImage($remote, $path);
			}
			else {
				//  USE DEFAULT IMAGE
				$GLOBALS['myDbManager'] -> debug('get any image');
				$url = $link;
				$GLOBALS['myDbManager'] -> debug($link);
				$ch = curl_init();
				$timeout = 10;
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
				
				# Iterate over all the <img> tags
				$sizes = array(150, 220, 350, 150, 220, 350);
				$images = array();
				foreach($dom -> getElementsByTagName('img') as $element) {
					# Show the <a href>
					if($element -> getAttribute('src') != '') {
						$tmp = $element -> getAttribute('src');
						$GLOBALS['myDbManager'] -> debug($remote);
						if(strpos($remote, 'http') === false) {
							$GLOBALS['myDbManager'] -> debug('add domain');
							$remote_url[] = 'http://www.' . $merchantArray['keyword'] . $remote;
							$remote_url[] = 'https://www.' . $merchantArray['keyword'] . $remote;
							$remote_url[] = 'http://' . $merchantArray['keyword'] . $remote;
							$remote_url[] = 'https://' . $merchantArray['keyword'] . $remote;
							$GLOBALS['myDbManager'] -> debug('fixed image: ' . $remote);
						}
						else {
							$remote_url[] = $tmp;
						}
					}
					
					for($r=0; $r<count($remote_url); $r++) {
						if(fileExists($remote_url[$r])) {
							$GLOBALS['myDbManager'] -> debug('get image size');
							$size = getimagesize($remote_url[$r]);
							
							$GLOBALS['myDbManager'] -> debug('width: ' . $size[0]);
							$GLOBALS['myDbManager'] -> debug('height: ' . $size[1]);
							if(($size[0] > $sizes[0]) || ($size[1] > $sizes[0])) {
								$GLOBALS['myDbManager'] -> debug('record image: ' . $remote_url[$r]);
								$images[] = $remote_url[$r];
							}
							$r = (count($remote_url) + 5);  //  end loop
						}	
					}
									
				}
				//  loop through the set of images 3 times
				//  attempting to recover the best quality
				for($i=0; $i<count($sizes); $i++) {
					$image_size = $sizes[$i];
					for($ii=0; $ii<count($images); $ii++) {
						$image_source = $images[$ii];	
						$size = getimagesize($image_source);
						//  test size
						if($i > 2) {
							if(($size[0] > $image_size) || ($size[1] > $image_size)) {
								$GLOBALS['myDbManager'] -> debug('selected image: ' . $image_source);
								return $this -> ProcessImage($image_source, $path);
							}
						}
						else {
							if(($size[0] > $image_size) && ($size[1] > $image_size)) {
								$GLOBALS['myDbManager'] -> debug('selected image: ' . $image_source);
								return $this -> ProcessImage($image_source, $path);
							}
						}
					}
				}
				/*
				foreach($html->find('img') as $element) {
					$GLOBALS['myDbManager'] -> debug('image loop');
					//  --------------------------------------------------
					//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
					if($element -> src != '') {
						$remote = $element -> src;
						$GLOBALS['myDbManager'] -> debug('image: ' . $remote);
						if(!preg_match('http', $remote)) {
							$remote = 'http://www.' . $merchantArray['keyword'] . $remote;
							$GLOBALS['myDbManager'] -> debug('fixed image: ' . $remote);
						}
						
						
						
					}
					
				}
				*/
				/*
				//  --------------------------------------------------
				foreach($html->find('img') as $element) {
					$GLOBALS['myDbManager'] -> debug('image loop');
					//  --------------------------------------------------
					//  GET REMOTE IMAGE ASSOCIATED WITH THIS LINK
					if($element -> src != '') {
						$remote = $element -> src;
						$GLOBALS['myDbManager'] -> debug('image: ' . $remote);
						if(!preg_match('http', $remote)) {
							$remote = 'http://www.' . $merchantArray['keyword'] . $remote;
							$GLOBALS['myDbManager'] -> debug('fixed image: ' . $remote);
						}
						
						if(fileExists($remote)) {
							$GLOBALS['myDbManager'] -> debug('get image size');
							$size = getimagesize($remote);
							if(($size[0] > 200) || ($size[1] > 200)) {
								$GLOBALS['myDbManager'] -> debug('large image');
								return $this -> ProcessImage($remote, $path);
							}
						}
						
					}
					//  --------------------------------------------------
				}
				*/
				//  --------------------------------------------------
				return false;
			}
		//  ------------------------------------------------------
	}
	//  ------------------------------------------------------
	
	//  ------------------------------------------------------
	public function ProcessImage($remote, $path) {
		$GLOBALS['myDbManager'] -> debug('image url: ' . $remote);
		//  --------------------------------------------------
		$image = array();
		if(!file_exists($path[0])) mkdir($path[0], 0777);
		if(!file_exists($path[1])) mkdir($path[1], 0777);
		if(!file_exists($path[2])) mkdir($path[2], 0777);
		
		$image['ext'] = substr($remote, -3);
		$image['filename'] = generate_hash(16) . '.' . $image['ext'];
		#echo 'extension: ' . $image['ext'];
		#echo '<br />full: ' . $uploadPath . $image['filename'] . '.' . $image['ext'];
		$fullPath = $path[2] . $image['filename'];
		copy($remote, $fullPath);
		//
		$size = getimagesize($remote);
		//  --------------------------------------------------
		//  GET ORIENTATION
		$image['width'] = $size[0];
		$image['height'] = $size[1];
		if($image['height'] > $image['width']) {
			$image['orientation'] = 'portrait';
		}
		else {
			$image['orientation'] = 'landscape';
		}
		
		return $image;

	}
}


?>