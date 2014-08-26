<?php
	$categories = $myCategoryManager -> GetWhere(array('id_parent'), array('root'));
	//  --------------------------------------------------
	//  VIEW DEAL
	echo '<div class="left span-6 res clear centre category-wrapper" style="">';
		echo '<div class="padding-10 text-centre" >';
		echo '<h2>Select a Category</h2>';
		//  --------------------------------------------------
		echo '<ul>';
		for($i=0; $i<count($categories); $i++) {
			$data = format($categories[$i]);
			include(DIR_TEMPLATES . '/lightbox/temp_category_list_item.php');
		}
		echo '</ul>';
		//  --------------------------------------------------
		echo '</div>';
	echo '</div>';
	//  --------------------------------------------------
?>