<?php

for($i=0;$i<count($deals);$i++)
{
	
	$data = $deals[$i];
	//  -------------------------------------
	//  COMPONENT TO DISPLAY INDIVIDUAL DEAL
	include(DIR_TEMPLATES . '/temp_deals_item.php');
	//  -------------------------------------
}

?>