<?php
$user['image'] = $myImageManager -> GetEntry($user['id_image']);
echo '<div id="comment-' . $data['id'] . '" class="clear span-12 left comment-item" >';
	echo '<div class="padding-10 res" >';

	//  ---------------------------------
	//  USER DETAILS
		echo '<div class="clear  left  span-12" style="min-height: 60px;" >';
			echo '<div class="span-1 left res-des res-tab" >';
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
		//  ------------------------------
		echo '<div class="span-12 left clear" style="border-top: 1px solid #efefef;" >';
			echo '<div class="padding-5" >';
				if($user['user_type']  == 'user') {
					echo  '<p class="medium span-8 res color-5 left" >posted by <a class="color-6" title="View this users Profile" href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/"><strong>' . $user['user_name'] . '</strong></a></p>';
				}
				else {
					echo  '<p class="medium span-8 res color-5 left" >posted by <strong>' . ucwords($user['user_type']) . '</strong></p>';
				}
				echo  '<p class="small span-4 res-des res-tab color-5 right text-right" >' . date('g:ia \o\n jS \o\f M \'y', strtotime($data['date_added'])) . '</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
	
?>