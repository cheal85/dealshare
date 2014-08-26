<?php	
//  --------------------------------------------------
//  Get other deal data
$data['image'] = format($myImageManager -> GetEntry($data['id_image']));
$user = format($myUserManager -> GetEntry($data['id_user']));
//
$user['image'] = format($myImageManager -> GetEntry($user['id_image'], 'small'));
$data['dealshare_link'] = SITE_ROOT . '/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/';
//  --------------------------------------------------
echo '<div id="deal-' . $data['id'] . '" class="item ">';
	//  --------------------------------------------------
	//  display discount
	if($data['deal_type'] == 'deal') {
		$price = number_format((float)$data['deal_price'], 2);
		if($price > 0) {
			echo  '<div class="item-price" >';
				echo  '<div class="padding-5" >';
					//var price = $data['deal_price.parseFloat.toFixed(2);
					$price = $data['deal_price'];
					echo  '<p class="left">&euro;&nbsp;' . $price . '</p>';
				echo  '</div>';
			echo  '</div>';
		}
	}
	elseif($data['deal_type'] == 'voucher'){
		if($data['discount'] > 0) {
			echo '<div class="item-price" >';
				echo '<div class="padding-5" >';
				if($data['discount_type'] == 'percent') {
					$discount = (int)$data['discount'];
					$discount .= ' &#37';
				}
				else {
					$discount = number_format((float)$data['discount'], 2);
					$discount = '&euro;&nbsp;' . $discount;
				}
				echo '<p class="left ">' . $discount . ' off</p>';
				echo '</div>';
			echo '</div>';
		}
	}
	//  --------------------------------------------------
	//  PRODUCT IMAGE
	echo  '<div class="item-image left clear back-color-3">';
	//  --------------------------------------------------
	//  Test if user has already voted
	$voted = false;	
	if(LOGGED_IN) {
		if($USER['id'] != $data['id_user']) {
			$voters = explode('__', $data['voters']);
			//  Test this user against recorded voters
			for($ii=1; $ii<count($voters); $ii++) {
				if($USER['id'] == $voters[$ii]) {
					$voted = true;
					break;
				}
			}
		}
		else {
			$voted = true;	
		}
	}
	//  --------------------------------------------------
	echo  '<div class="item-hover full absolute res-des" style="display:none;">';
	if(($voted === false) && LOGGED_IN) {
		echo  '<a href="javascript:;" class="js-vote icon-hover icon-vote " title="Thank ' . $user['name'] . ' for this Deal" rel="' . $data['id'] . '"><img src="/web_graphics/icons/vote-icon.png" style="width:100%; height:100%;" /></a>';
	}
	else {
		echo  '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" class="js-share icon-hover icon-share " title="Share this Deal" rel="' . $data['id'] . '"><img src="/web_graphics/icons/share-icon.png" style="width:100%; height:100%;" /></a>';
	}
	echo  '</div>';	
	//  --------------------------------------------------
		echo '<a class="" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" title="View this Deal" ><img id="deal-image-' . $data['id'] . '"class="' . $data['image']['orientation'] . ' image-item" src="' . $data['image']['path'] . 'medium/' . $data['image']['filename'] . '" alt="Product Image for deal: ' . $data['title'] . '" /></a>';
	//  --------------------------------------------------
	//  expiry date
	if($data['date_expiry']) {
		$expiry = TimeToStr($data['date_expiry']);
		//
		echo '<div class="expiry" title="this deal will expire in about ' . $expiry . '" >';
			echo '<div class="padding-5" >';
				echo '<div class="clock-icon" >';
					echo '<img class="img-fit" src="/web_graphics/icons/clock.png" />';
				echo '</div>';
				//
				echo '<div class="back-color-8 expiry-text" >';
					echo '<img  src="/web_graphics/icons/left-arrow.png"  >';
					echo '<p class="color-6 " >' . $expiry . '</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
	echo  '</div>';
	//echo  '<img class="shine clear" src="/web_graphics/shine.png" >';
	//  --------------------------------------------------
	
	//  --------------------------------------------------
	//  DEAL DESCRIPTION
			echo '<div class="item-details clear border-top">';
				echo '<div class="right-left-5 clear ">';
	  				echo '<div class="item-title clear left span-12">';
						$title = $data['title'];
						$title = short($title, 50);
						//  TITLE
						echo '<a class="" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" title="View this Deal" >';
	  					echo '<h1 class="clear left " >' . $title . '</h1></a>';
						//
						echo '<a class="external-link js-external" href="' . $data['link'] . '"  target="_blank" title="Get this Deal!" rel="' . $data['id'] . '" >&nbsp</a>';
						//
	  				echo '</div>';
	  				//  --------------------------------------------------
	  				//  DEAL DESCRIPTION
		  			echo '<div class="clear left border-top span-12" >';
		  				echo '<div class="item-author left  span-12" >';
							echo '<div class="padding-5 left" >';
			  					echo '<div class=" clear left user-image">';
									#if($user['user_type']  == 'user') echo '<a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/" title="view ' . $user['name'] . '\'s page" >';
			  						echo'<img class="content landscape" src="' . $user['image']['path'] . 'tiny/' . $user['image']['filename'] . '" >';
									#if($user['user_type']  == 'user') echo '</div>';
			  					echo '</div>';
							echo '</div>';	
		  					//  --------------------------------------------------
							echo '<div class="padding-5 left" >';
			  					if($user['user_type']  == 'user') {
			  						echo '<p class="small" >by <a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/">' . short($user['name'], 19) . '</a><br />';
			  					}
			  					else {
			  						echo '<p class="small" >by <span class="bold" >dealshare</span><br />';
			  					}
			  					echo '<span class="tiny" >' . $data['nice_date'] . '</span></p>';
			  				echo '</div>';
		  				echo '</div>';
					echo '</div>';
				echo '</div>';
		//  --------------------------------------------------
		/*
		echo '<div class="item-stats span-12 clear left back-color-2" >';
			  //  -----------------------------------
			  //  Votes
			  echo '<div class="item-stat" >';
			  echo '<a href="javascript:;" class="js-vote icon-vote-small" title="Thank ' . $user['name'] . ' for this Deal"  rel="' . $data['id'] . '">';
			  echo '<img class="left" src="/web_graphics/icons/vote-icon-small.png" />';
			  echo '<span>' . $data['votes'] . '</span></a>';
			  echo '</div>';	
			  //  -----------------------------------
			  //  SHARES
			  echo '<div class="item-stat" >';
			  echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" class="js-share icon-share-small " title="Share this Deal"  rel="' . $data['id'] . '">';	
			  echo '<img class="left" src="/web_graphics/icons/share-icon-small.png" />';
			  echo '<span>' . $data['meta_shares'] . '</span></a>';
			  echo '</div>';	
			  //  -----------------------------------
			  //  VIEWS
			  echo '<div class="item-stat" >';
			  echo '<a href="javascript:;" class="icon-views-small " title="Views this Deal has received"  >';	
			  echo '<img class="left" src="/web_graphics/icons/views-icon-small.png" />';
			  echo '<span>' . $data['meta_views'] . '</span></a>';
			  echo '</div>';	
			  //  -----------------------------------
		echo '</div>';
		*/
		/*
		echo '<div class="span-12 clear left back-color-2" >';
			  //  -----------------------------------
			  //  Votes
			  echo '<p class="span-12 text-centre " ><a href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" class="color-6" title="View this deal">View</a></p>';
			  //  -----------------------------------
		echo '</div>';
		*/
	echo  '</div>';
	//  --------------------------------------------------
echo  '</div>';
?>