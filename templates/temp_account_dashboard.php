<div class="span-9 left res ">
  	
	<div class="padding-10 ">
        <div class="span-12 clear right " >
            <?php  
                include(DIR_TEMPLATES . '/temp_user_profile.php');
            ?>
        </div>  
          
        <div class="sep-20 left">&nbsp;</div>
            
        <div id="account-main-top"  class="back-color-2 span-12 shadow clear" >
            <div class="padding-10">
                <h2 class="color-6">My Latest Deals</h2>
                <p class="color-6 medium">The 3 latest deals you have shared</p>
            </div>
        </div>
            
        <div class="span-12 clear right" >
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