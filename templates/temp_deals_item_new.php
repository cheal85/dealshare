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
	echo  '<div class="item-image clear back-color-3">';
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
		echo  '<a href="javascript:;" class="js-vote icon-hover icon-vote " title="Cast your vote!" rel="' . $data['id'] . '"><span class="hidden">vote</span></a>';
	}
	else {
		echo  '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" class="js-share icon-hover icon-share " title="Share this Deal" rel="' . $data['id'] . '"><span class="hidden">share</span></a>';
	}
	echo  '</div>';	
	//  --------------------------------------------------
		echo '<a class="view-deal res-des" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" rel="temp_view_deal.php:::' . $data['id'] . '" title="View this Deal" ><img id="deal-image-' . $data['id'] . '"class="' . $data['image']['orientation'] . ' image-item" alt="' . $data['title'] . '" src="' . $data['image']['path'] . 'medium/' . $data['image']['filename'] . '"  /></a>';
	//  --------------------------------------------------
		echo '<a class="res-mob res-tab" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" title="View this Deal" ><img id="deal-image-' . $data['id'] . '"class="' . $data['image']['orientation'] . ' image-item" src="' . $data['image']['path'] . 'medium/' . $data['image']['filename'] . '" alt="Product Image for deal: ' . $data['title'] . '" /></a>';
	echo  '</div>';
	//echo  '<img class="shine clear" src="/web_graphics/shine.png" >';
	//  --------------------------------------------------
	
	//  --------------------------------------------------
	//  DEAL DESCRIPTION
			echo '<div class="item-details clear border-top">';
				echo '<div class="right-left-5 clear ">';
	  				echo '<div class="item-title clear left span-12">';
						$title = $data['title'];
						$title = short($title, 70);
						//  DESKTOP
	  					echo '<h1 class="clear left res-des" ><a class="view-deal" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" rel="temp_view_deal.php:::' . $data['id'] . '" ';
						echo ' title="' . $data['description'] . '" >' . $title . '</a></h1>';
						//  MOBILE
	  					echo '<h1 class="clear left res-mob res-tab" ><a href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/"';
						echo ' title="' . $data['description'] . '" >' . $title . '</a></h1>';
						//
	  				echo '</div>';
	  				//  --------------------------------------------------
	  				//  DEAL DESCRIPTION
		  			
			echo '</div>';
		//  --------------------------------------------------
		echo '<div class="item-stats span-12 clear left back-color-8" >';
			  //  -----------------------------------
			  //  Votes
			  echo '<div class="item-stat" >';
			  echo '<a href="javascript:;" class="js-vote icon-vote-small" title="Vote up this Deal"  rel="' . $data['id'] . '">';
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
	echo  '</div>';
	//  --------------------------------------------------
echo  '</div>';
?>