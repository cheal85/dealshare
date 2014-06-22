<?php
	//  --------------------------------------------------
	//  COMMENT FORM
	echo '<div class="clear span-12 left" >';
	  	echo '<form id="form-comment-add-' . $count . '" class="left clear span-12 js-comment-form" method="post" >';
		  	echo '<p class="clear span-12 " ><textarea type="text" id="text-' . $count . '" class=" js-required js-clear-input " rel="You must enter a comment" placeholder="comment on this deal.." name="text" ></textarea></p>';
		  	echo '<input type="hidden" name="id_user" value="' . $USER['id'] . '" />';
		  	echo '<input type="hidden" name="id_deal" value="' . $data['id'] . '" />';
		  	echo '<input type="hidden" name="submit" value="1" />';
			echo '<div class="right clear " >';
		  		echo '<input id="comment-submit-' . $count . '" class="clear full right comment-button" type="submit" name="button" value="Add Comment" />';
			echo '</div>';
	  	echo '</form>';
  	echo '</div>';
	//  --------------------------------------------------
?>