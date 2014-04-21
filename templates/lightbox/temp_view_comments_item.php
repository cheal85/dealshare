<?php
$user['image'] = $myImageManager -> GetEntry($user['id_image']);
echo '<div id="comment-' . $data['id'] . '" class="clear span-12 left comment-item" >';
	echo '<div class="padding-10 res" >';
		echo '<div class="span-12 left back-color-5" >';
			echo '<div class="padding-5" >';
				if($user['user_type']  == 'user') {
					echo  '<p class="medium span-8 res color-6 left" >posted by <a class="color-6" title="View this users Profile" href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/"><strong>' . $user['user_name'] . '</strong></a></p>';
				}
				else {
					echo  '<p class="medium span-8 res color-6 left" >posted by <strong>' . ucfirst($user['user_type']) . '</strong></p>';
				}
				echo  '<p class="small span-4 res-des res-tab color-6 right" >' . date('g:ia \o\n jS M \'y', strtotime($data['date_added'])) . '</p>';
			echo '</div>';
		echo '</div>';
	//  ---------------------------------
	//  USER DETAILS
		echo '<div class="padding-5 clear block" >';
			echo '<div class="span-2 left  res-des res-tab" >';
				echo  '<div class="item-author clear left " >';
					echo  '<div class="user-image clear right" style="width:50px; height:50px;">';
						echo '<img class="content centre ' . $user['image']['orientation'] . '" src="' . $user['image']['path'] . 'tiny/' . $user['image']['filename'] . '" >';
					echo  '</div>';
					//  --------------------------------------------------
				echo  '</div>';
			echo  '</div>';
		//  ---------------------------------
			echo '<div class="span-10 left" >';
				//  COMMENT
				echo '<div class="right-left" >';
					echo '<p class="left full clear color-7" >' . $data['text'] . '</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
	
?>