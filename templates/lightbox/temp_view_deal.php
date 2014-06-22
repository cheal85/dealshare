<?php
	//  --------------------------------------------------
	//  Get Image
	$image = $myImageManager -> GetImage($data['id_image'], 'large');
	$user = format($myUserManager -> GetEntry($data['id_user']));
	$user['image'] = $myImageManager -> GetEntry($user['id_image'], 'small');
	$data['dealshare_link'] = SITE_ROOT . '/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/';
	// --------------------------------------------
	//  Record View
	$myDealManager -> Increment($data['id'], 'meta_views');
	if(LOGGED_IN) $myUserManager -> Increment($USER['id'], 'meta_views');
	//  --------------------------------------------------
	//  VIEW DEAL
	echo '<div class=" span-12 clear" >';
	//
	echo '<div id="view-deal" class="js-tab on detail" >';
	if(1) {	
		echo '<div class="span-12  clear left " >';
				//  ------------------------------------------------------------------------------
				//  VIEW DEAL
				echo '<div id="view-deal" class="js-tab on detail span-12 left" >';
					echo '<div class="left span-8" >';
					//  ------------------------------------------------------------------
					//  GET DEAL BUTTON
					if($data['merchant_title'] != '') $title = 'Visit ' . $data['merchant_title'] . ' to view this product';
						else $title = 'Get this Deal!';
					echo '<a class="button color-3 left centre span-12 icon-external js-external" href="' . $data['link'] . '"  target="_blank" title="' . $title . '" rel="' . $data['id'] . '" >Get this Deal!</a>';
					//  ------------------------------------------------------------------
					echo '<div class=" clear left span-12 block">';
						echo '<div class="span-12 full deal-summary left" >';
							echo '<div class=" span-12 left" >';
								//  DEAL TITLE
								echo '<h1 class="top-bottom  modal-deal-title span-12 left">' . $data['title'] . '</h1>';
								//  VOUCHER CODE
								if($data['voucher_code']) {
									echo '<div class="clear span-12" >';
									echo '<p id="voucher-wrapper" class="span-12 left" ><span class="span-3 left" >VOUCHER</span><span class="span-8 right" ><input id="voucher-code"  readonly="readonly"  value="' . $data['voucher_code'] . '" /></span></p>';
									echo '</div>';
								}
								//  DEAL SUMMARY
								if($data['deal_price']) echo '<p class="clear left span-12 color-7" ><span class="bold" >price:</span> &euro;' . number_format((float)$data['deal_price'], 2) . '</p>';
								if($data['discount']) echo '<p class="clear left span-12 color-7" ><span class="bold" >discount:</span> ' . (int)$data['discount'] . '%</p>';
								echo '<p class="clear left span-12 modal-deal-summary color-7" >' . $data['description'] . '</p>';
							echo '</div>';
						echo '</div>';
						//  --------------------------------------------------------------
						//  SHARE AND VOTE BUTTONS
						echo '<a class="color-2 span-6 left icon-modal-share" href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" title="Share this Deal with your friends" >Share</a>';
						//  --------------------------------------------------------------
						if(LOGGED_IN === true) {
							$voters = explode('__', $data['voters']);
							$voted = false;
							for($ii=1; $ii<count($voters); $ii++) {
								if($USER['id'] == $voters[$ii]) {
									$voted = true;
								}
							}
						  //  --------------------------------------------------------------
						  if(!$voted)  echo '<a class="color-2 span-6 right js-modal-vote icon-modal-vote" href="javascript:;" title="Thank ' . $user['name'] . ' for this Deal" rel="' . $data['id'] . '">Thank ' . $user['name'] . '</a>';
						}
						echo '</div>';
						//  ------------------------------------------------------------------------
					echo '</div>';
				//  --------------------------------------------------------------------------------
					//
					echo '<div class="right span-4 " >';
						echo '<div class="text-centre modal-deal-thumbnail" >';
						//
						echo '<img class="deal-image ' . $image['orientation'] . '" src="' . $image['full_path'] . '"  />';
						//
						echo '</div>';
						//  ---------------------------------
						echo  '<div class="item-author clear left span-12 top-20" >';
							echo  '<div class="padding-4 left" >';
								echo  '<div class="user-image clear right" >';
									echo '<img class="content centre ' . $user['image']['orientation'] . '" src="' . $user['image']['path'] . 'tiny/' . $user['image']['filename'] . '" alt="Product Image for deal: ' . $data['title'] . '" />';
								echo  '</div>';
							echo  '</div>';	
							//  --------------------------------------------------
							echo  '<div class="padding-5 left" >';
								if($user['user_type']  == 'user') {
									echo  '<p class="medium left" >shared by <a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/">' . $user['name'] . '</a><br />';
								}
								else {
									echo  '<p class="medium left" >shared by ' . ucfirst($user['user_type']) . '<br />';
								}
								echo  '<span class="small left" >' . $data['nice_date'] . '</span></p>';
							echo  '</div>';
							//
							if($USER['user_type'] != 'guest') {
								if(($USER['id'] == $data['id_user']) || ($USER['user_type'] == 'admin')) {
									echo  '<div class="padding-3 right" >';
										echo  '<p class="medium padding-5" ><a href="/account/add-deal?did=' . $data['id'] . '">Edit</a></p>';
									echo  '</div>';
								}
							}
						echo  '</div>';
					echo '</div>';
					//  --------------------------------------------------
				//  --------------------------------------------------
				echo '</div>';
				//  --------------------------------------------------
			
			echo '</div>';		
		//  --------------------------------------------------
		//  COMMENT FORM
		$count = '1';
		if(LOGGED_IN) {
			include(DIR_FORMS . '/form_comment_add.php');
		}
	}
	else {
		echo '<div class="error-panel"><p>The Requested Deal could not be found</p></div>';
	}
	//  --------------------------------------------------
	echo '</div>';
	//  --------------------------------------------------
	//  VIEW COMMENTS
	echo '<div id="view-comments" class="js-tab" style="display:none;" >';
	//  --------------------------------------------------
	echo '</div>';
	//  --------------------------------------------------
			
?>