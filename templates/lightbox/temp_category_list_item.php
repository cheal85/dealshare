<?php
echo '<div id="category-' . $data['id'] . '" class="clear span-12 left category-item" >';
	echo '<div class="padding-10 res" >';
		echo '<li>';
			echo '<a href="javascript:;" class="js-select-category" rel="' . $data['id'] . '" >' . $data['title'] . '</a>';
		echo '</li>';
	echo '</div>';
echo '</div>';
	
?>