
<div class="seo-content">
    <?php 
	//  ---------------------------------------------------- 
    $options = array('type' => 'deal');
    if($deals = $myDealManager -> GetEntries(1, $options)) {
        for($i=0; $i<count($deals); $i++) {
            $data = format($deals[$i]);
            include(DIR_TEMPLATES . '/temp_deals_item.php');
        }
    }
	//
    $options = array('type' => 'voucher');
    if($deals = $myDealManager -> GetEntries(1, $options)) {
        for($i=0; $i<count($deals); $i++) {
            $data = format($deals[$i]);
            include(DIR_TEMPLATES . '/temp_deals_item.php');
        }
    }
	//
    $options = array('type' => 'freebie');
    if($deals = $myDealManager -> GetEntries(1, $options)) {
        for($i=0; $i<count($deals); $i++) {
            $data = format($deals[$i]);
            include(DIR_TEMPLATES . '/temp_deals_item.php');
        }
    }
	//
    ?>
</div>



