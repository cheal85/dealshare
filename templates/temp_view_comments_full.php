<?php
	//  --------------------------------------------------
	//  VIEW DEAL
	echo '<div class="left span-12 clear" >';
		//  --------------------------------------------------
			
		for($i=0; $i<count($comments); $i++) {
			$data = format($comments[$i]);
			$user = format($myUserManager -> GetEntry($data['id_user']));
			include(DIR_TEMPLATES . '/lightbox/temp_view_comments_item.php');
		}
		//  --------------------------------------------------
	echo '</div>';
	//  --------------------------------------------------
?>