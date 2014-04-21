<?php
//  ------------------------------------------------------
//  Yes No Options for dropbox
$arr_yes_no = array(array('label' => 'Yes', 'value' => 'yes'),
  					array('label' => 'No', 'value' => 'no')
					);
//  ------------------------------------------------------
//  List of Merchants
$merchant_options = array();
$merchants = $myMerchantManager -> GetEntries(false, $merchant_options);

$arr_merchants = array();
for($i=0; $i<count($merchants); $i++) {
	$arr_merchants[] = array('label' => $merchants[$i]['title'], 'value' => $merchants[$i]['id']);	
}
//  ------------------------------------------------------
?>
