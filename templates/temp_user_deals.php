
<div class="span-12 left ">
	<div class="padding-20 res">
		<?php
		    if(!$PAGE_ERROR) {
				$user['image'] = format($myImageManager -> GetImage($user['id_image'], 'medium'));
				#var_dump($user);
				echo '<h2 class="color-5 text-centre">About <span class="bold">' . $user['name'] . '</span></h2>';
				
				echo '<div class="clear ">';
				
					echo '<div class="sep-10 ">&nbsp;</div>';
					echo  '<div class="left span-3 res" >';
						echo  '<div class="user-image centre" >';
							echo '<img class="content centre ' . $user['image']['orientation'] . '" src="' . $user['image']['full_path'] . '" >';
						echo  '</div>';
						echo '<h3 class="clear text-centre">' . reputation($user) . '</h3>';
					echo  '</div>';
					
					if($user['about']) {
						echo  '<div class=" right span-9 res" >';
							echo '<p class="clear medium" >' . short($user['about'], 350) . '</p>';
						echo '</div>';
					}
												
					echo  '<div class="left span-9 res" >';
						echo '<div class="sep-20">&nbsp;</div>';
						//
						echo  '<div class=" left span-4 res text-centre" >';
						  	$joined = date('m.y', strtotime($USER['date_added']));
							echo '<h1 class="color-2 text-centre text-large bold ">' . $joined . '</h1>';
							echo '<p class="color-5" ><span class="bold" >joined</span></p>';
						echo '</div>';
						//
						echo  '<div class=" left span-4 res text-centre" >';
							echo '<h1 class="color-2 text-large bold">' . (int)$USER['meta_shared_deals']. '</h1>';
							echo '<p class="color-5" ><span class="bold" >shared</span></p>';
						echo '</div>';
						//
						echo  '<div class=" left span-4 res text-centre" >';
							echo '<h1 class="color-2 text-large bold">' . (int)$joined['meta_thanks_received']. '</h1>';
							echo '<p class="color-5" ><span class="bold" >comments</span></p>';
						echo '</div>';
					echo '</div>';
					
		
				echo '</div>';
				//
				echo '<hr class="back-color-9" />';
					
			
			echo '<div class="sep-20">&nbsp;</div>';
			
			echo '<div class=" clear centre " style="width:96%;">';
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
		}
		else {
				echo '<h2 class="color-5 res">User Not Found</h2>';
				echo '<p class="color-5 medium">The Requested User could not be found.</p>';
		}
			?>
	</div>
</div>



