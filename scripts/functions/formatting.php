<?php


//  -----------------------------------------------
//  REPUTATION FUNCTIONALITY
//  -----------------------------------------------
function reputation($arr)
{
	$rep = 0;
	//  add meta data to reputation
	$rep += (int)($arr['meta_shared_deals'] * 10);
	//
	$rep += (int)($arr['meta_thanks_given']);
	//
	$rep += (int)($arr['meta_thanks_received'] * 6);
	//
	$rep += (int)($arr['meta_shares_external'] * 8);
	//
	$rep += ((int)$arr['meta_comments'] * 3);
	//
	//  decide reputational string
	$rep_string = '';
	//
	if($rep >= 100) {
		if($rep >= 300) {
			if($rep >= 800) {
				if($rep >= 1500) {
					if($rep >= 2500) {
						if($rep >= 4000) {
							if($rep >= 6000) {
								$rep_string = 'Super Scrimper';
							}
							else {
								$rep_string = 'Scrimper';
							}
						}
						else {
							$rep_string = 'Fastidious Shopper';
						}
					}
					else {
						$rep_string = 'Shrewd Shopper';
					}
				}
				else {
					$rep_string = 'thrifty';
				}
			}
			else {
				$rep_string = 'Frugal';
			}
		}
		else {
			$rep_string = 'Careful Saver';
		}
	}
	else {
		$rep_string = 'Saver';
	}
	//
	return $rep_string;
}
//  -----------------------------------------------
//  Format date for display
//  -----------------------------------------------
function format($arr)
{
	$ret = array();
	
	foreach ($arr as $key => $value)
	{
		if($key == 'date_added') {
			$ret['nice_date'] = 	FriendlyDate($value);
		}
		$value = mb_convert_encoding($value, "ISO-8859-1");
		#$value = mb_convert_encoding($value, "UTF-8");
		$ret[$key] = htmlentities(stripslashes($value));
	}
	return $ret;
}
//------------------------------------------------

//  -----------------------------------------------
//  Create variable length string for display
//  -----------------------------------------------
function short($string, $length = 30)
{
	if(strlen($string)>$length)
	{ 
		$shortString = substr($string, 0, $length-3) . '..';
	}
	else
	{
		$shortString = $string;
	}
		
	return $shortString;
}
//  ---------------------------------------------
//  Clean out un wanted characters
function clean($str) {
	//  allowed characters
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = str_replace('.', '-', $string); // Replaces all spaces with hyphens.
	$string = str_replace('&', '-', $string); // Replaces all spaces with hyphens.
	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	//
	return $string;
}
//  ---------------------------------------------
//  Sanitize user inputs
function sanitize_v2($array) {
	//  -----------------------------------------
	//  Move $_POST to local Array
	foreach ($_POST as $key => $string)
	{
	    if (is_array($string)) {
	        foreach($string as $key => $string) {
	            $output[$key] = sanitize($string);
	        }
	    }
	    else {
	       if($clean) $string  = cleanInput($string);
	        $output = stripslashes(trim($string));
			$output = htmlentities($output);
	    }
	}
	//  -----------------------------------------
    return $output;
}
//  ---------------------------------------------
//  Old sanitizer Sanitize user inputs
function sanitize_url($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = str_replace('.', '-', $string); // Replaces all spaces with hyphens.
	$string = str_replace('&', '-', $string); // Replaces all spaces with hyphens.
	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	$string = str_replace('--', '-', $string); // Replaces all spaces with hyphens.
	$string = strtolower($string); // change to lower case.
	//
	return $string;
}
//
function sanitize_post($arr) {
	$clean = array();
    foreach ($arr as $key => $string)
	{
		$clean[$key]	= trim(stripslashes($string));
	}
	return $clean;
}
//  ---------------------------------------------
//  Sanitize Database entries
function sanitize_db($string) {
	//  ---------------------------------
	//  replace pound and euro symbols
	$clean = ($string);
	//
	$clean = addslashes(trim($clean));
	return $clean;
}
//-----------------------------------------------
//  FORMAT DATETIME STRING
//  returns array with key 'date' and 'time'
function FormatDate($datetime)
{
	if (!$timestamp = strtotime($datetime)) {
		$retArray['date'] = '- ';
		$retArray['time'] = '- ';
	}
	else {
		$retArray['date'] = date('d.m.Y', $timestamp);
		$retArray['time'] = date('H:i ', $timestamp);
	}
	return $retArray;
}
//-----------------------------------------------
//  RE-FORMAT TO DATETIME
function reformat_date($date)
{
	$tmp = explode('.', $date);
	$ret =  date( 'Y-m-d 00:00:00', strtotime($tmp[0] . '-' . $tmp[1] . '-' . $tmp[2])) ;
	
	return $ret;
}
//  ----------------------------------------------
function FriendlyDate($datetime)
{
	return date('M jS', strtotime($datetime));
}
//  ----------------------------------------------
//  FORMAT TIMES TO STRING 
//  ----------------------------------------------
function TimeToStr($date)
{
	$retString = '';
	$time1		= strtotime(date('Y-m-d H:i:s', time()));
	$time2      = strtotime($date);

	if($time1 > $time2) {
		$timeDif = $time1-$time2;

		if($timeDif > 59) // seconds
		{
			if($timeDif > 3599) //  minutes
			{
				if($timeDif > 86399) //  hours
				{
					if($timeDif > 2678400) //  days
					{
						if($timeDif > 15552000) // months
						{
							if($timeDif > 31535999) //  years
							{
								$retString =  'over a year ago';
							} 
							else
							{
								$retString = 'over 6 month ago';	
							}
						}
						else
						{
							$retString = round(($timeDif /= (30*24*60*60)),0,PHP_ROUND_HALF_DOWN) . ' month(s) ago';	
						}
					}
					else
					{
						$retString = round(($timeDif /= (24*60*60)),0,PHP_ROUND_HALF_DOWN) . ' days ago';	
					}
				}
				else
				{
					$retString = round(($timeDif /= (60*60)),0,PHP_ROUND_HALF_DOWN) . ' hours ago';	
				}
			}
			else
			{
				$retString = round(($timeDif /= 60),0,PHP_ROUND_HALF_DOWN) . ' minutes ago';	
			}
		}
		else
		{
			$retString = round($timeDif,0,PHP_ROUND_HALF_DOWN) . ' seconds ago';
		}
	}
	else {
		$timeDif = $time2-$time1;

		if($timeDif > 59) // seconds
		{
			if($timeDif > 3599) //  minutes
			{
				if($timeDif > 86399) //  hours
				{
					if($timeDif > 2678400) //  days
					{
						if($timeDif > 15552000) // months
						{
							if($timeDif > 31535999) //  years
							{
								$retString =  'over a year';
							} 
							else
							{
								$retString = 'over 6 months';	
							}
						}
						else
						{
							$retString = round(($timeDif /= (30*24*60*60)),0,PHP_ROUND_HALF_DOWN) . ' months';	
						}
					}
					else
					{
						$retString = round(($timeDif /= (24*60*60)),0,PHP_ROUND_HALF_DOWN) . ' days';	
					}
				}
				else
				{
					$retString = round(($timeDif /= (60*60)),0,PHP_ROUND_HALF_DOWN) . ' hours';	
				}
			}
			else
			{
				$retString = round(($timeDif /= 60),0,PHP_ROUND_HALF_DOWN) . ' minutes';	
			}
		}
		else
		{
			$retString = round($timeDif,0,PHP_ROUND_HALF_DOWN) . ' seconds';
		}	
	}
		
	return $retString;
}
//  ----------------------------------------------
?>