
<div class="span-9 res right ">
	<div class="padding-10">

			<div id="account-main-top"  class="back-color-2 span-12 shadow" >
			   	<div class="padding-10">
					<h2 class="color-6">My Deals</h2>
					<p class="color-6 medium">These are the deals you have shared on the site</p>
			    </div>
			</div>
			
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



