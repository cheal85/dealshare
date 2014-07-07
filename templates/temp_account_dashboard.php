<div id="account-dashboard" class="span-9 right res  account-block">
    <div class="padding-20 ">
        <?php  
            include(DIR_TEMPLATES . '/temp_account_dashboard_profile.php');
        ?>
          
        <div class="sep-20 left">&nbsp;</div>
         
         <div class="centre clear" style="width:99%;">  
         	<h2 class="color-5 text-centre span-12">Latest Deals</h2>
            <div class=" deal-holder">
                <?php  
                $options = array('user' => $USER['id']);
                
                if($deals = $myDealManager -> GetLatest($USER['id'])) {
                
                    for($i=0; $i<count($deals); $i++) {
                    
                        $data = format($deals[$i]);
                        include(DIR_TEMPLATES . '/temp_deals_item.php');
                    }
                }
                ?>
            </div>
        </div>
	</div>
</div>