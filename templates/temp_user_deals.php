
<div class="span-9 res right ">
	<div class="padding-10 res">
		<?php
		if($user) {
			echo '<div id="account-main-top"  class="back-color-2 span-12 shadow" >';
				echo '<div class="padding-10 res">';
					echo '<h2 class="color-6 res">Deals shared by ' . $user['name'] . '</h2>';
					echo '<p class="color-6 medium">These are the deals ' . $user['name'] . ' has posted on Dealshare</p>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="sep-20">&nbsp;</div>';
			
			echo '<div class="span-12 clear right " >';
				echo '<div class="span-12 clear left  " >';
					echo '<div class=" deal-holder">';
						 
						$options = array('user' => $user['id']);
						
						if($deals = $myDealManager -> GetEntries(false, $options)) {
						
							for($i=0; $i<count($deals); $i++) {
							
								$data = format($deals[$i]);
								include(DIR_TEMPLATES . '/temp_deals_item.php');
							}
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		else {
			echo '<div id="account-main-top"  class="back-color-2 span-12 shadow" >';
			echo '<div class="padding-10 res">';
				echo '<h2 class="color-6 res">User Not Found</h2>';
				echo '<p class="color-6 medium">The Requested User could not be found.</p>';
			echo '</div>';
			echo '</div>';
		}
			?>
	</div>
</div>



