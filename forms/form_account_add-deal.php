<?php
//  --------------------------------------------------
//  ARRAY TO HOLD EXISITNG FORM DATA
if(LOGGED_IN) {
	if(isset($_GET['did'])) {
		$exists = true;
		$tmp = format($myDealManager -> GetEntry($_GET['did']));
		
		$url_hash = $_GET['hash'];
		$deal_hash = $tmp['hash'];
		if($deal_hash == $url_hash) {
			if(($USER['id'] == $tmp['id_user']) || ($USER['user_type'] == 'admin')) {
				$form = $tmp;
				$deal_type = $form['deal_type'];
				echo '<h2 class="color-5 text-centre"><span class="italic" >' . $form['title'] . '</span></h2>';
	
			}
			else {
				echo '<div class="error-panel "><p>You do not have permission to edit this deal</p></div>';
			}
		}
		else {
			echo '<div class="error-panel "><p>The requested content could not be retrieved</p></div>';	
		}
	}
	else {
		$deal_type = 'deal';
		echo '<h2 class="color-5 text-centre">Share a Deal</h2>';
	
	}
}
else {
	echo '<div class="error-panel "><p>You do not have permission to edit this deal</p></div>';
}
	//
	echo '<div class="sep-10">&nbsp;</div>';

//  -------------------------------------------------
//  Create Category Array
$arr_type = array(
				array('label' => 'Great Deal', 'value' => 'deal'),
				array('label' => 'Voucher Code', 'value' => 'voucher'),
				array('label' => 'Freebie', 'value' => 'freebie')
				);
if(1) {
	echo '<div id="deal-image-upload" ';
	if( !$_GET['did'] ) echo ' style="display:none;"';
	echo ' >';
		echo '<div class="top-bottom ">';
			if($form) $image = $myImageManager -> GetImage($form['id_image'], 'medium');
				else $image = $myImageManager -> GetImage(2, 'medium');
			echo '<div class="js-image clear centre deal-image upload-holder" >';
				echo '<div class="js-loading clear centre padding " style="display:none; ">';
				echo '<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>';
				echo '</div>';
				echo '<img src="' . $image['full_path'] . '" class="content left ' . $USER['image']['orientation'] . '" />';
			echo '</div>';
		echo '</div>';
		echo '<div id="image-uploader" class="span-6 res clear centre" >  </div>';
	echo '</div>';
	//  --------------------------------------------------
	//  DEAL FORM
	echo '<form id="form-deal-add" class="js-deal-form span-12" method="post">';
	//  --------------------------------------------------
	//  INPUTS FOR DEAL CREATION
	//  --------------------------------------------------
	//  deal link
	//  --------------------------------------------------
	$field = 'raw_link';
	echo '<p class="clear span-12 left" ><label class="clear">link</label>
	<input class="clear span-12 left js-link js-required js-url" type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="url address for deal" rel="Please include a valid link" value="' . $form[$field] . '" ></p>';
	//  --------------------------------------------------
	//  deal title
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	$field = 'title';
	echo '<p class="clear span-12 left" ><label class="clear ">title</label>
	<input class="clear span-12 left js-required " type="text" id="' . $field  . '" name="' . $field  . '" placeholder="give your deal a title" rel="A title is required" value="' . $form[$field] . '" ></p>';
	//  --------------------------------------------------
	//  deal product name
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	$field = 'product_title';
	echo '<p class="clear span-12 left" ><label class="clear ">product</label>
	<input class="clear span-12 left " type="text" id="' . $field  . '" name="' . $field  . '" placeholder="product name (optional)" value="' . $form[$field] . '" ></p>';
	//  --------------------------------------------------
	//  deal description
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	$field = 'description';
	echo '<p class="clear span-12 left" ><label class="clear ">description</label>
	<textarea class="clear span-12 left js-required tall" type="text"  placeholder="description" id="' . $field  . '" rel="Please include a description" name="' . $field  . '"  >' . $form[$field] .'</textarea></p>';
	echo '</p>';
	//  --------------------------------------------------
	//  deal category
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	$field = 'id_category';
	echo '<p class="clear span-12 left" ><label class="clear ">category</label></p>';
	echo '<div class="sep-10">&nbsp;</div>';
	echo '<p class="clear span-12 left " >';
		if( !$form[$field] ) {
			echo '<a href="javascript:;" id="' . $field . '" class="lightbox span-12" rel="/lightbox/temp_category_list.php" >Select a Category</a>';
		}
		else {
			$cat = $myCategoryManager -> GetEntry((int)$form['id_category']);
			echo '<a href="javascript:;" id="' . $field . '" class="lightbox span-12" rel="/lightbox/temp_category_list.php:::' . $cat['id'] . '" >' . $cat['title'] . '</a>';
		}
		echo '<input  name="' . $field  . '" type="hidden" value="' . $form[$field] . '" >';
	echo '</p>';
	//  --------------------------------------------------
	//  deal type
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	echo '<div class="js-deal-type-wrapper span-12 left" >';
		$field = 'deal_type';
		echo '<input type="hidden" name="' . $field . '" value="deal" />';
		//  markup for selecting between the two
		echo '<p class="clear span-12 left" ><label class="clear ">deal type</label></p>';
		echo '<div class="sep-5">&nbsp;</div>';
		echo '<p class="left span-4 res text-centre " >';
			echo '<a href="javascript:;" class="js-deal-type span-12 left on" rel="deal" >Sale</a>';
		echo '</p>';
		echo '<p class="text-centre left span-4 res "  style="line-height: 220%;">&nbsp;OR&nbsp;</p>';
		echo '<p class="right span-4 res text-centre " >';
			echo '<a href="javascript:;" class="js-deal-type span-12 left" rel="voucher" >Voucher</a>';
		echo '</p>';
	echo '</div>';

	/*
	echo '<div class="sep-10">&nbsp;</div>';
	echo '<p class="clear span-12 left" ><label class="clear ">category</label>';
	$select_arr = $arr_type;
	echo '<select class="span-12 left js-select-category" id="' . $field  . '" name="' . $field  . '"  >';
		for($i=0; $i<count($select_arr); $i++) {
			$label = $select_arr[$i]['label'];
			$value = $select_arr[$i]['value'];
			echo '<option value="' . $value . '" ';
			if($value == $form[$field]) echo 'selected="selected" ';
			echo '>' . $label . '</option>';
		}
	echo '</select></p>';
	*/
	//  --------------------------------------------------
	//  deal price
	//  --------------------------------------------------
	echo '<div class="sep-10 clear left">&nbsp;</div>';
	echo '<div id="deal-wrap" ';
	if( !$form['deal_type'] || ($form['deal_type'] == 'deal')) echo ' style="display: block;" ';
		else echo ' style="display: none;" ';
	echo '>';
		$field = 'deal_price';
		echo '<p class="clear span-12 left" ><label class="clear ">price</label>
		<p class="span-6 res left" ><input type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="price (&euro;)" value="' . $form[$field] . '" ></p>';
	echo '</div>';
	//  --------------------------------------------------
	//  voucher contiainer
	//  --------------------------------------------------
	echo '<div id="voucher-wrap" ';
	if( $form['deal_type'] == 'voucher' ) echo ' style="display: block;" ';
		else echo ' style="display: none;" ';
	echo '>';
		$field = 'voucher_code';
		echo '<p class="clear span-12 left" ></p><label class="clear ">voucher code</label>
		<input class="span-12 left js-required " type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="voucher code" rel="Please include the Code" value="' . $form[$field] . '" ></p>';
		//
		//
		echo '<div class="sep-10 ">&nbsp;</div>';
		$field = 'discount';
		echo '<p class="clear span-12 left" ></p><label class="clear ">discount</label>
		<input class="clear span-6 res left" type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="discount" value="' . $form[$field] . '" >';
		echo '<div class="span-3 res left" ><a id="discount_type" href="javascript:;" class="js-type-switch percent-button left" title="As a percentage" >&nbsp;</a></div></p>';
	echo '</div>';
	//  --------------------------------------------------
	//  deal expiry
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	$field = 'date_expiry';
	if( $form['date_expiry'] ) $dt = FormatDate( $form[$field] );
	echo '<p class="clear span-12 left" ><label class="clear ">expiry date</label>';
	echo '<p class="span-6 res left" ><input type="text" id="' . $field  . '" name="' . $field  . '" class="datepicker" placeholder="expiry date" value="' . $dt['date']. '" ></p>';
	//echo '<div class="clear left datepicker" ></div>';
	/*
	//  --------------------------------------------------
	//  ADMIN OPTIONS
	//  --------------------------------------------------
	echo '<div class="sep-10">&nbsp;</div>';
	if($USER['user_type'] == 'admin') {
		echo '<h3 class="clear color-2">Admin Settings</h3>';
		//  --------------------------------------------------
		//  attribute to user
		//  --------------------------------------------------
		echo '<div class="sep-10">&nbsp;</div>';
		$field = 'id_user';
		echo '<p class="clear span-12 left" ><label class="clear ">user</label>
		<input class="span-12 left js-required js-number"  type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="user id" rel="All deals must have a owner" value="' . $form[$field] . '" ></p>';
		echo '<div class="message-panel clear"><p>19 is an admin account.  </p></div>';
		//  --------------------------------------------------
		//  url conversion of title
		//  --------------------------------------------------
		echo '<div class="sep-10">&nbsp;</div>';
		$field = 'url_safe';
		echo '<p class="clear span-12 left" ><label class="clear ">url</label>
		<input class="span-12 left js-required "  type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="user id" rel="Enter a valid url" value="' . $form[$field] . '" ></p>';
		echo '<div class="message-panel clear"><p>Please ensure this entry is url safe.  </p></div>';
		//  --------------------------------------------------
		//  enabled or disabled
		//  --------------------------------------------------
		echo '<div class="sep-10">&nbsp;</div>';
		$field = 'enabled';
		echo '<p class="clear span-12 left" ><label class="clear ">enabled</label>';
		$select_arr = $arr_yes_no;
		echo '<select class="span-12 left js-required " id="' . $field  . '" name="' . $field  . '"  rel="Enter a valid url"  >';
			for($i=0; $i<count($select_arr); $i++) {
				$label = $select_arr[$i]['label'];
				$value = $select_arr[$i]['value'];
				echo '<option value="' . $value . '" ';
				if($value == $form[$field]) echo 'selected="selected" ';
				echo '>' . $label . '</option>';
			}
		echo '</select></p>';
		//  --------------------------------------------------
		//  set merchant for this deal
		//  this does not effect the link
		//  --------------------------------------------------
		echo '<div class="sep-10">&nbsp;</div>';
		$field = 'id_merchant';
		echo '<p class="clear span-12 left" ><label class="clear ">merchant</label>';
		array_unshift($arr_merchants, array('label'=> '', 'value' => ''));
		$select_arr = $arr_merchants;
		echo '<select class="span-12 left " id="' . $field  . '" name="' . $field  . '" >';
			for($i=0; $i<count($select_arr); $i++) {
				$label = $select_arr[$i]['label'];
				$value = $select_arr[$i]['value'];
				//  build html
				echo '<option value="' . $value . '" ';
				if($value == $form[$field]) echo 'selected="selected" ';
				echo '>' . $label . '</option>';
			}
		echo '</select></p>';	
	}
	else {
		echo '<input type="hidden" id="id_merchant" name="id_merchant" value="' . $form['id_merchant'] . '" ><br>';
	}
	*/
	echo '<div class="sep-10 clear left">&nbsp;</div>';
	//  --------------------------------------------------
	//  META DATA
	echo '<input type="hidden" name="discount_type" value="percent" />';
	echo '<input type="hidden" id="id" name="id" value="' . $form['id']  . '" />';
	echo '<input type="hidden" id="id_image" name="id_image" value="' . $form['id_image'] . '" />';
	echo '<input type="hidden" name="hash_secret" value="' . $form['hash_secret'] . '" />';
	echo '<input type="hidden" name="submit" value="1" />';
	echo '<input type="hidden" id="redirect" name="redirect" value="/" />';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><input class="right" id="deal-submit" type="submit" name="button" value="Save" /></p>';
	//  --------------------------------------------------
	//  Validation holder
}
echo '</form>';
//  --------------------------------------------------
?>