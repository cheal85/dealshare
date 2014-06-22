

<div class="span-12 right block clear " >
		<?php
        echo '<h2 class="color-5 text-centre span-12">My Account</h2>';
        echo '<div class="sep-10">&nbsp;</div>';
        if($USER['image'] = format($myImageManager -> GetImage($USER['id_image'], 'medium'))) {
			echo  '<div class="clear left span-12" >';
				echo  '<div class="user-profile-image centre " >';
					echo '<img class="content left ' . $USER['image']['orientation'] . '" src="' . $USER['image']['full_path'] . '" >';
				echo  '</div>';	
				//
				echo '<div class="sep-10">&nbsp;</div>';
				//
				echo '<div class="span-10 res centre text-centre" >';
					echo '<h1 class="color-2 ">' . $USER['name'] . '</h1>';
					echo '<h3 class="color-5" >' . reputation($USER) . '</h3>';
					//
					echo '<div class="sep-10">&nbsp;</div>';
					//
					echo '<p class="color-5" >' . $USER['about'] . '</p>';
				echo '</div>';
			echo '</div>';
			//
			echo '<div class="sep-10">&nbsp;</div>';
			//
			echo '<hr class="back-color-9" />';
			//
			echo  '<div class=" left span-3 res text-centre" >';
			  	$joined = date('m.y', strtotime($USER['date_added']));
				echo '<h1 class="color-8 text-large bold">' . $joined . '</h1>';
				echo '<p class="color-5" ><span class="bold" >joined</span></p>';
			echo '</div>';
			//
			echo  '<div class=" left span-3 res text-centre" >';
				echo '<h1 class="color-8 text-large bold">' . (int)$USER['meta_shared_deals']. '</h1>';
				echo '<p class="color-5" ><span class="bold" >shared</span></p>';
			echo '</div>';
			//
			echo  '<div class=" left span-3 res text-centre" >';
				echo '<h1 class="color-8 text-large bold">' . (int)$joined['meta_comments'] . '</h1>';
				echo '<p class="color-5" ><span class="bold" >thanks</span></p>';
			echo '</div>';
			//
			echo  '<div class=" left span-3 res text-centre" >';
				echo '<h1 class="color-8 text-large bold">' . (int)$joined['meta_thanks_received']. '</h1>';
				echo '<p class="color-5" ><span class="bold" >comments</span></p>';
			echo '</div>';
			//
			echo '<div class="sep-10">&nbsp;</div>';
			//
			echo '<hr class="back-color-9" />';
		}
			else {
			echo '<div class="error-panel"><p>Your account details could not be found</p></div>';	
		}
		?>
</div>
    	