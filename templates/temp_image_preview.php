<?php

echo '<div class="full left clear centre padding content-preview" >';
	echo '<img class="preview ' . $image['orientation'] . '" src="' . $image['full_path'] . '" alt="' . $image['title'] . '" title="Select this image to use with your deal">';
	echo '<input type="hidden" class="id-holder" value="' . $image['id']  . '" ><br>';
echo '</div>';


?>