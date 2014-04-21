<?php	
$GLOBALS['myDbManager'] -> debug('markup: template');
//  --------------------------------------------------
//  Get other deal data
$data['image'] = format($myImageManager -> GetEntry($data['id_image']));
$user = format($myUserManager -> GetEntry($data['id_user']));
//
$user['image'] = format($myImageManager -> GetEntry($user['id_image'], 'small'));
$data['dealshare_link'] = SITE_ROOT . '/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/';
//  --------------------------------------------------
$markup .= '<div id="deal-' . $data['id'] . '" class="item ">';
	//  --------------------------------------------------
	//  display discount
	if($data['deal_type'] == 'deal') {
		$price = number_format((float)$data['deal_price'], 2);
		if($price > 0) {
			$markup .=  '<div class="item-price" >';
				$markup .=  '<div class="padding-5" >';
					//var price = $data['deal_price.parseFloat.toFixed(2);
					$price = $data['deal_price'];
					$markup .=  '<p class="left">&euro;&nbsp;' . $price . '</p>';
				$markup .=  '</div>';
			$markup .=  '</div>';
		}
	}
	elseif($data['deal_type'] == 'voucher'){
		if($data['discount'] > 0) {
			$markup .= '<div class="item-price" >';
				$markup .= '<div class="padding-5" >';
				if($data['discount_type'] == 'percent') {
					$discount = (int)$data['discount'];
					$discount .= ' &#37';
				}
				else {
					$discount = number_format((float)$data['discount'], 2);
					$discount = '&euro;&nbsp;' . $discount;
				}
				$markup .= '<p class="left ">' . $discount . ' off</p>';
				$markup .= '</div>';
			$markup .= '</div>';
		}
	}
	//  --------------------------------------------------
	//  PRODUCT IMAGE
	$markup .=  '<div class="item-image clear back-color-3">';
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
	$markup .=  '<div class="item-hover full absolute res-des" style="display:none;">';
	if(($voted === false) && LOGGED_IN) {
		$markup .=  '<a href="javascript:;" class="js-vote icon-hover icon-vote " title="Cast your vote!" rel="' . $data['id'] . '"><span class="hidden">vote</span></a>';
	}
	else {
		$markup .=  '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" class="js-share icon-hover icon-share " title="Share this Deal" rel="' . $data['id'] . '"><span class="hidden">share</span></a>';
	}
	$markup .=  '</div>';	
	//  --------------------------------------------------
		$markup .= '<a class="view-deal res-des" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" rel="temp_view_deal.php:::' . $data['id'] . '" title="View this Deal" ><img id="deal-image-' . $data['id'] . '"class="' . $data['image']['orientation'] . ' image-item" alt="' . $data['title'] . '" src="' . $data['image']['path'] . 'medium/' . $data['image']['filename'] . '"  /></a>';
	//  --------------------------------------------------
		$markup .= '<a class="res-mob res-tab" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" title="View this Deal" ><img id="deal-image-' . $data['id'] . '"class="' . $data['image']['orientation'] . ' image-item" src="' . $data['image']['path'] . 'medium/' . $data['image']['filename'] . '" alt="Product Image for deal: ' . $data['title'] . '" /></a>';
	$markup .=  '</div>';
	//$markup .=  '<img class="shine clear" src="/web_graphics/shine.png" >';
	//  --------------------------------------------------
	
	//  --------------------------------------------------
	//  DEAL DESCRIPTION
			$markup .= '<div class="item-details clear border-top">';
				$markup .= '<div class="right-left-5 clear ">';
	  				$markup .= '<div class="item-title clear left span-12">';
						$title = $data['title'];
						$title = short($title, 50);
						//  DESKTOP
	  					$markup .= '<h1 class="clear left res-des" ><a class="view-deal" href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/" rel="temp_view_deal.php:::' . $data['id'] . '" ';
						$markup .= ' title="' . $data['description'] . '" >' . $title . '</a></h1>';
						//  MOBILE
	  					$markup .= '<h1 class="clear left res-mob res-tab" ><a href="/deal/' . $data['url_safe'] . '/' . $data['hash'] . '/' . $data['id'] . '/"';
						$markup .= ' title="' . $data['description'] . '" >' . $title . '</a></h1>';
						//
	  				$markup .= '</div>';
	  				//  --------------------------------------------------
	  				//  DEAL DESCRIPTION
		  			$markup .= '<div class="clear left border-top span-12" >';
						$markup .= '<div class="left clear span-2 "><a class="external-link" href="' . $data['link'] . '"  target="_blank" title="Get this Deal!" >&nbsp</a></div>';
		  				$markup .= '<div class="item-author right  span-10" >';
							$markup .= '<div class="padding-5 right" >';
			  					$markup .= '<div class=" clear right user-image">';
									#if($user['user_type']  == 'user') $markup .= '<a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/" title="view ' . $user['name'] . '\'s page" >';
			  						$markup .='<img class="content ' . $user['image']['orientation'] . '" src="' . $user['image']['path'] . 'tiny/' . $user['image']['filename'] . '" >';
									#if($user['user_type']  == 'user') $markup .= '</div>';
			  					$markup .= '</div>';
							$markup .= '</div>';	
		  					//  --------------------------------------------------
							$markup .= '<div class="padding-5 right" >';
			  					if($user['user_type']  == 'user') {
			  						$markup .= '<p class="small" >by <a href="/user-deals/' . $user['hash'] . '/' . $user['id'] . '/">' . short($user['name'], 19) . '</a><br />';
			  					}
			  					else {
			  						$markup .= '<p class="small" >shared by ' . ucfirst($user['user_type']) . '<br />';
			  					}
			  					$markup .= '<span class="tiny" >' . $data['nice_date'] . '</span></p>';
			  				$markup .= '</div>';
		  				$markup .= '</div>';
					$markup .= '</div>';
				$markup .= '</div>';
		//  --------------------------------------------------
		$markup .= '<div class="item-stats span-12 clear left back-color-2" >';
			  //  -----------------------------------
			  //  Votes
			  $markup .= '<div class="item-stat" >';
			  $markup .= '<a href="javascript:;" class="js-vote icon-vote-small" title="Vote up this Deal"  rel="' . $data['id'] . '">';
			  $markup .= '<img class="left" src="/web_graphics/icons/vote-icon-small.png" />';
			  $markup .= '<span>' . $data['votes'] . '</span></a>';
			  $markup .= '</div>';	
			  //  -----------------------------------
			  //  SHARES
			  $markup .= '<div class="item-stat" >';
			  $markup .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $data['dealshare_link'] . '" target="_blank" class="js-share icon-share-small " title="Share this Deal"  rel="' . $data['id'] . '">';	
			  $markup .= '<img class="left" src="/web_graphics/icons/share-icon-small.png" />';
			  $markup .= '<span>' . $data['meta_shares'] . '</span></a>';
			  $markup .= '</div>';	
			  //  -----------------------------------
			  //  VIEWS
			  $markup .= '<div class="item-stat" >';
			  $markup .= '<a href="javascript:;" class="icon-views-small " title="Views this Deal has received"  >';	
			  $markup .= '<img class="left" src="/web_graphics/icons/views-icon-small.png" />';
			  $markup .= '<span>' . $data['meta_views'] . '</span></a>';
			  $markup .= '</div>';	
			  //  -----------------------------------
		$markup .= '</div>';
	$markup .=  '</div>';
	//  --------------------------------------------------
$markup .=  '</div>';
?>