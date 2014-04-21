

<div class="span-12 shadow right block clear " >
	<div class="padding-10">
		<?php
        echo '<h2 class="color-5 ">My Account</h2>';
        echo '<div class="sep-10">&nbsp;</div>';
        if($USER['image'] = format($myImageManager -> GetImage($USER['id_image'], 'medium'))) {
            #var_dump($USER);
            
                echo  '<div class="clear left span-4 res" >';
                    echo  '<div class="user-profile-image clear padding-10" >';
                        echo '<img class="content border left ' . $USER['image']['orientation'] . '" src="' . $USER['image']['full_path'] . '" >';
                    echo  '</div>';	
                echo '</div>';
                echo  '<div class=" left span-8 res" >';
                    echo  '<div class=" left span-6 res" >';
                        echo  '<div class=" padding-5" >';
                            echo '<p class="clear " ><span class="bold" >Name: </span>' . $USER['name'] . '</p>';
                            if($USER['about']) {
                                echo '<h4 class="bold clear">About</h4>';
                                echo '<p>' . $USER['about'] . '</p>';
                            }
                        echo '</div>';
                    echo '</div>';
                    
                    echo  '<div class=" left span-6 res" >';
                        echo  '<div class="padding-5" ><ul>';
                            echo '<li><span class="bold" >Joined: </span>' . date('jS M \'y', strtotime($USER['date_added'])) . '</li>';
                            echo '<li><span class="bold" >Shared: </span>' . $USER['meta_shared_deals'] . ' deals</li>';
                            echo '<li><span class="bold" >Comments: </span>' . $USER['meta_comments'] . ' </li>';
                            #echo '<li>Reputation: ' . $user['user_reputation'] . '</li>';
                        echo '</ul></div>';
                    echo '</div>';
                    if($USER['about']) {
                        echo  '<div class=" left span-12 " >';
                                echo '<h4 class="bold clear">About</h4><br />';
                                echo '<p>' . $USER['about'] . '</p>';
                        echo '</div>';
					}
			  echo '</div>';
        }
        else {
            echo '<div class="error-panel"><p>The Requested user could not be found</p></div>';	
        }
        ?>
	</div>
</div>
    	