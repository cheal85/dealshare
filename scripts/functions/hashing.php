<?php


function HashPassword($password)
{
	$iterations = 10;
	$hash = crypt($password, SALT);
	for ($i = 0; $i < $iterations; ++$i)
	{
		$hash = crypt($hash . $password, SALT);
	}
	
	return $hash;

}
?>