

<div class="padding-20 clear">
    <?php
    if(!$PAGE_ERROR) {
		$user['image'] = format($myImageManager -> GetImage($user['id_image'], 'medium'));
		#var_dump($user);
		
		
		echo '<div class="">';
		
			echo  '<div class="user-profile-image left span-4 res" >';
				echo '<img class="content centre ' . $user['image']['orientation'] . '" src="' . $user['image']['full_path'] . '" >';
			echo  '</div>';
			
			echo  '<div class=" left span-4 res" ><h2 class="color-2 ">';
				echo $user['name'];
			echo '</h2>';
			echo '<h3>' . reputation($user) . '</h3></div>';
										
			
			echo  '<div class="clear left span-12" ><ul>';
				echo '<li>Joined: ' . $user['nice_date'] . '</li>';
				echo '<li>Shared: ' . $user['meta_shared_deals'] . ' deals</li>';
				echo '<li>Comments: ' . $user['meta_comments'] . ' total</li>';
				#echo '<li>Reputation: ' . $user['user_reputation'] . '</li>';
			echo '</ul></div>';
			
			echo '<div class="sep left clear">&nbsp;</div>';

		echo '</div>';
		//
		echo '<hr class="back-color-9" />';
    }
    ?>
</div>
    	