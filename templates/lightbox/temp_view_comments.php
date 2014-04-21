<?php
	//  --------------------------------------------------
	//  VIEW DEAL
	echo '<div class="left span-12 clear comment-wrapper" style="">';
		echo '<div class="padding-10" >';
		//  --------------------------------------------------
		
		for($i=0; $i<count($comments); $i++) {
			$data = format($comments[$i]);
			$tmp = $myUserManager -> GetWhere(array('id'), array($data['id_user']));
			$user = format($tmp[0]);
			include(DIR_TEMPLATES . '/lightbox/temp_view_comments_item.php');
		}
		//  --------------------------------------------------
		echo '</div>';
	echo '</div>';
	//  --------------------------------------------------
?>