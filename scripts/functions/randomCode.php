<?php

//	generates a random code of specified 
//	length using the letters and numbers 
//	array and returns it

function generate_hash($numChars, $type = 'mixed')
{
	//	number of characters in the code
	$numLoops		= $numChars;
	
	//	init code variable
	$retCode		= '';
	
	//	initialize character-containing arrays
	$lgChars		= array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');
	$smChars		= array('a','b','c','d','e','f','g','h','i','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z');
	$digits			= array('2','3','4','5','6','7','8','9');
	
	//	what type of code do we want?
	switch ($type)
	{
		case 'mixed':
			$allChars		= array_merge($lgChars, $smChars, $digits);
			break;

		case 'digits':
			$allChars		= $digits;
			break;

		case 'letters':
			$allChars		= array_merge($lgChars, $smChars);
			break;

		case 'mixed-upper':
			$allChars		= array_merge($lgChars, $digits);
			break;

		default:
			$allChars		= array_merge($lgChars, $smChars, $digits);
			break;
	}
		
	while (strlen(trim($retCode)) < $numLoops)
	//	code generated doesn't contain enough characters, do it again
	{
		$retCode	.= $allChars[rand(0, count($allChars))];
	}
	
	//	return the code
	return $retCode;
}

?>