

<div class="span-12 left ">
	<div class="padding-10 ">
		<?php
		$data['dealshare_link'] = SITE_ROOT . '/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/';

		#var_dump($data);
		/*
			echo '<div id="account-main-top"  class="back-color-2 span-12 shadow clear" >';
			   	echo '<div class="padding-20">';
					echo '<h2 class="color-6">' . $data['title'] . '</h2>';
			    echo '</div>';
			echo '</div>';
			*/
			
			echo '<div class="sep-20">&nbsp;</div>';
			
			if(!$PAGE_ERROR) {	
				echo '<div class="span-12 shadow clear left " >';
					//  ------------------------------------------------------------------
					//  GET DEAL BUTTON
					echo '<div class="left span-8 res" >';
						echo '<div class="padding-20 res" >';
							if($data['merchant_title'] != '') $title = 'Visit ' . $data['merchant_title'] . ' to view this product';
								else $title = 'Get this Deal!';
							echo '<a class="button color-3 left centre span-12 icon-external" href="' . $data['link'] . '"  target="_blank" title="' . $title . '" >Get this Deal!</a>';
						echo '</div>';
					echo '</div>';
					//  ------------------------------------------------------------------
					echo '<div id="view-deal" class="padding-20 res" >';
						//  --------------------------------------------------------------------------------
						//  DEAL IMAGE
						echo '<div class="right span-4 res " >';
							echo '<div class="deal-thumbnail" >';
							//
							echo '<img class="content centre ' . $image['orientation'] . '" src="' . $image['full_path'] . '" alt="Product Image for deal: ' . $data['title'] . '" />';
							//
							echo '</div>';
						echo '</div>';
						//  --------------------------------------------------------------------------------
						//  DEAL TITLE AND SUMMARY
						echo '<div class="left span-8 res" >';
							echo '<div class=" clear left span-12 block">';
								echo '<div class="span-12  deal-summary left" >';
									echo '<div class=" span-12 left" >';
										//  DEAL TITLE
										echo '<h1 class="top-bottom modal-deal-title span-12 left">' . $data['title'] . '</h1>';
										//  VOUCHER CODE
										if($data['voucher_code']) {
											echo '<div class="clear span-12" >';
											echo '<p id="voucher-wrapper"><span class="res-tab res-des left" >VOUCHER</span><input id="voucher-code" class="span-9 right" readonly="readonly"  value="' . $data['voucher_code'] . '" /></p>';
											echo '</div>';
										}
										//  DEAL SUMMARY
										if($data['deal_price']) echo '<p class="clear left span-12 color-7" ><span class="bold" >price:</span> &euro;' . number_format((float)$data['deal_price'], 2) . '</p>';
										if($data['discount']) echo '<p class="clear left span-12 color-7" ><span class="bold" >discount:</span> ' . (int)$data['discount'] . '%</p>';
										echo '<p class="clear left span-12 modal-deal-summary color-7" >' . $data['description'] . '</p>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						//  --------------------------------------------------------------------------------
						//  SHARED BY DETAILS
						echo '<div class="right span-4 res " >';
							echo  '<div class="item-author clear left span-12 top-20" >';
								//
								echo  '<div class="padding-4 left" >';
									echo  '<div class="user-image clear left" >';
										echo '<img class="content centre landscape" src="' . $user['image']['path'] . 'tiny/' . $user['image']['filename'] . '" >';
									echo  '</div>';
								echo  '</div>';	
								//
								echo  '<div class="padding-5 left" >';
									if($user['user_type']  == 'user') {
										echo  '<p class="medium" >shared by <a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/">' . $user['name'] . '</a><br />';
									}
									else {
										echo  '<p class="medium" >shared by ' . ucfirst($user['user_type']) . '<br />';
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
							echo '</div>';
						echo '</div>';
						//  --------------------------------------------------------------------------------
						//  VOTE AND SHARE LINKS
						echo '<div class="left span-8 res" >';
							echo '<div class=" clear left span-12 block">';
								//  SHARE
								echo '<a class="color-2 span-6 left icon-modal-share" href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" title="Share this Deal with your friends" >Share</a>';
								//  VOTE
								if(LOGGED_IN === true) {
									$voters = explode('__', $data['voters']);
									$voted = false;
									for($ii=1; $ii<count($voters); $ii++) {
										if($USER['id'] == $voters[$ii]) {
											$voted = true;
										}
									}
								  //  --------------------------------------------------------------
								  if(!$voted)  echo '<a class="color-2 span-6 right js-modal-vote icon-modal-vote" href="javascript:;" title="Vote up this Deal" rel="' . $data['id'] . '">Vote</a>';
								}
								// 
							echo '</div>';
						echo '</div>';
						//
					echo '</div>';
					//  --------------------------------------------------
				echo '</div>';
				echo '<div class="sep-20 left">&nbsp;</div>';
			
				if($comments = $myCommentManager -> GetEntries('all', array('id_deal' => $data['id']))) {
					echo '<div class="span-12 shadow clear left " >';
						echo '<div class="padding-20 res">';
							
							//  --------------------------------------------------
							//  COMMENT FORM
							$count = '1';
							if(LOGGED_IN) {
								echo '<h3 class="color-2 icon-comment">Comment on this Deal</h3>';
								include(DIR_FORMS . '/form_comment_add.php');
							}
							else {
								echo '<h3 class="color-2 icon-comment">Comments</h3>';
							}
							//  --------------------------------------------------
							include(DIR_TEMPLATES . '/temp_view_comments_full.php');
						echo '</div>';
					echo '</div>';
				}
				else {
					if(LOGGED_IN) {
					echo '<div class="span-12 shadow clear left " >';
						echo '<div class="padding-20 res">';
							$count = 1;
							echo '<h3 class="color-2 icon-comment">Comment on this Deal</h3>';
							include(DIR_FORMS . '/form_comment_add.php');
						echo '</div>';
					echo '</div>';
					}
				}
				// --------------------------------------------
				//  Record View
				$myDealManager -> Increment($data['id'], 'meta_views');
				//  --------------------------------------------------
			}
			else {
				echo '<div class="error-panel"><p>The Requested Deal could not be found</p></div>';
			}
					
				
		?>
	</div>
</div>