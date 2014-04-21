

<div class="span-3 res clear left">
	<div class="padding-10">
	    <?php
	    if(!$PAGE_ERROR) {
	        echo '<div class="back-color-6 shadow clear left">';
		        $user['image'] = format($myImageManager -> GetImage($user['id_image'], 'medium'));
		        #var_dump($user);
		        
		        
		        echo '<div class="padding-20 clear">';
		        
		            echo  '<div class="clear left span-12" ><h3 class="color-2 ">';
		                echo $user['name'];
		            echo '</h3></div>';
		            	            
		            echo '<div class="sep-10 left clear">&nbsp;</div>';
					
		            echo  '<div class="user-image clear  span-12" >';
		                echo '<img class="content border centre ' . $user['image']['orientation'] . '" src="' . $user['image']['full_path'] . '" >';
		            echo  '</div>';
		            
		            echo '<div class="sep-10 left clear">&nbsp;</div>';
		            
		            echo  '<div class="clear left span-12" ><ul>';
		                echo '<li>Joined: ' . $user['nice_date'] . '</li>';
		                echo '<li>Shared: ' . $user['meta_shared_deals'] . ' deals</li>';
		                echo '<li>Comments: ' . $user['meta_comments'] . ' total</li>';
		                #echo '<li>Reputation: ' . $user['user_reputation'] . '</li>';
		            echo '</ul></div>';
		            
		            echo '<div class="sep left clear">&nbsp;</div>';
		
		        echo '</div>';
	    echo '</div>';
	    }
	    ?>
	</div>
</div>
    	