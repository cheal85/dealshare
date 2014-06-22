
<div id="account-deals" class="span-9 res right account-block">
	<div class="padding-20">

        	<h2 class="color-5 text-centre span-12">My Deals</h2>
			
			<div class="sep-20">&nbsp;</div>
			
			<div class="span-12 clear right " >
				<div class="span-12 clear left  " >
			   		<div class=" deal-holder">
						<?php  
						$options = array('user' => $USER['id']);
						
						if($deals = $myDealManager -> GetEntries(false, $options)) {
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
</div>



