<?php
//  --------------------------------------------------
//  ARRAY TO HOLD EXISITNG FORM DATA
if(isset($_GET['did'])) {
	$exists = true;
	$tmp = format($myDealManager -> GetEntry($_GET['did']));
	
	
	if(LOGGED_IN) {
		if(($USER['id'] == $tmp['id_user']) || ($USER['user_type'] == 'admin')) {
			$form = $tmp;
			$deal_type = $form['deal_type'];
		}
		else {
			echo '<div class="error-panel "><p>You do not have permission to edit this deal</p></div>';
		}
	}
}
else {
	$deal_type = 'voucher';
}
//  -------------------------------------------------
//  Create Category Array
$arr_type = array(
				array('label' => 'Great Deal', 'value' => 'deal'),
				array('label' => 'Voucher Code', 'value' => 'voucher'),
				array('label' => 'Freebie', 'value' => 'freebie')
				);
if(1) {
	echo '<h2 class="color-2">Amend Deal Details</h2>';
	//  --------------------------------------------------
	//  SIGNUP FORM
	echo '<form id="form-deal-add" class="js-deal-form" method="post">';
	//  --------------------------------------------------
	//  INPUTS FOR DEAL CREATION
	//  --------------------------------------------------
	$field = 'link';
	echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >link : </p><label class="clear res-mob res-tab">link</label>
	<input class="span-9 res left js-required js-url" type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="link" rel="Please include a valid link" value="' . $form[$field] . '" ></p>';
	$field = 'title';
	echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >title : </p><label class="clear res-mob res-tab">title</label>
	<input class="span-9 res left js-required " type="text" id="' . $field  . '" name="' . $field  . '" placeholder="title" rel="A title is required" value="' . $form[$field] . '" ></p>';
	//  --------------------------------------------------
	$field = 'description';
	echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >description : </p><label class="clear res-mob res-tab">description</label>
	<textarea class="span-9 res left js-required tall" type="text"  placeholder="description" id="' . $field  . '" rel="Please include a description" name="' . $field  . '"  >' . $form[$field] .'</textarea></p>';
	//  --------------------------------------------------
	$field = 'deal_type';
	echo '<p class="clear span-12 " ><p class="span-3 res-des left text-right" >category : </p><label class="clear res-mob res-tab">category</label>';
	$select_arr = $arr_type;
	echo '<select class="span-9 res left js-select-category" id="' . $field  . '" name="' . $field  . '"  >';
		for($i=0; $i<count($select_arr); $i++) {
			$label = $select_arr[$i]['label'];
			$value = $select_arr[$i]['value'];
			echo '<option value="' . $value . '" ';
			if($value == $form[$field]) echo 'selected="selected" ';
			echo '>' . $label . '</option>';
		}
	echo '</select></p>';
	//  --------------------------------------------------
	echo '<div id="deal" class="' . ($deal_type == 'deal'? '' : 'hidden') . ' clear left  js-block-switch" >';
	  	$field = 'deal_price';
	  	echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >price : </p><label class="clear res-mob res-tab">price</label>
		<p class="span-4 res left" ><input type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="price (&euro;)" value="' . $form[$field] . '" ></p></p>';
  	echo '</div>';
	//
	echo '<div id="voucher" class="' . ($deal_type == 'voucher'? '' : 'hidden') . ' clear left js-block-switch" >';
		$field = 'voucher_code';
		echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >voucher code : </p><label class="clear res-mob res-tab">voucher code</label>
		<input class="span-12 left js-required " type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="voucher code" rel="Please include the Code" value="' . $form[$field] . '" ></p>';
		//
		$field = 'discount';
		echo '<p class="clear span-12 " ><p class="span-3 left text-right res-des" >discount : </p><label class="clear res-mob res-tab">discount</label>
		<p class="span-8 res left" ><input class="span-4" type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="discount" value="' . $form[$field] . '" ></p>';
		echo '<p class="span-1 res left" ><a id="discount_type" href="javascript:;" class="js-type-switch percent-button left" title="As a percentage" >&nbsp;</a></p></p>';
	echo '</div>';
	//  --------------------------------------------------
	//  ADMIN OPTIONS
	if($USER['user_type'] == 'admin') {
		echo '<h3 class="clear color-2">Admin Settings</h3>';
		//
		$field = 'id_user';
		echo '<p class="clear span-12 " ><p class="span-3 left text-right" >user id : </p>
		<input class="span-9 left js-required js-number"  type="text" id="' . $field  . '" name="' . $field  . '"  placeholder="user id" rel="All deals must have a owner" value="' . $form[$field] . '" ></p>';
		echo '<div class="message-panel clear"><p>19 is an admin account.  </p></div>';
		//  --------------------------------------------------
		$field = 'enabled';
		echo '<p class="clear span-12 " ><p class="span-3 left text-right" >Enabled : </p>';
		$select_arr = $arr_yes_no;
		echo '<select class="span-9 left js-required " id="' . $field  . '" name="' . $field  . '"  rel="Enter a valid url"  >';
			for($i=0; $i<count($select_arr); $i++) {
				$label = $select_arr[$i]['label'];
				$value = $select_arr[$i]['value'];
				echo '<option value="' . $value . '" ';
				if($value == $form[$field]) echo 'selected="selected" ';
				echo '>' . $label . '</option>';
  			}
		echo '</select></p>';
		//  --------------------------------------------------
		/*
		$field = 'id_merchant';
		echo '<p class="clear span-12 " ><p class="span-3 left text-right" >Merchant: </p>';
		array_unshift($arr_merchants, array('label'=> '', 'value' => ''));
		$select_arr = $arr_merchants;
		echo '<select class="span-9 left " id="' . $field  . '" name="' . $field  . '" >';
			for($i=0; $i<count($select_arr); $i++) {
				$label = $select_arr[$i]['label'];
				$value = $select_arr[$i]['value'];
				//  build html
				echo '<option value="' . $value . '" ';
				if($value == $form[$field]) echo 'selected="selected" ';
				echo '>' . $label . '</option>';
  			}
		echo '</select></p>';	
		*/
	}
	else {
		echo '<input type="hidden" id="id_merchant" name="id_merchant" value="' . $form['id_merchant'] . '" ><br>';
	}
	echo '<div class="padding-10 clear" >';
		echo '<div class=" upload-holder ">';
			$image = $myImageManager -> GetImage($form['id_image'], 'medium');
			echo '<div class="js-avatar clear centre padding " style="width: 200px; height: 200px;"><img src="' . $image['full_path'] . '" class="centre avatar ' . $image['orientation'] . '" /></div>';
			#echo <div class="centre" style="display:none; width: 200px; height: 200px;"><img src="" class="img-loading" /></div>
			echo '<div class="user-uploader full clear centre" >  </div>';
		echo '</div>';
	echo '</div>';
	//  --------------------------------------------------
	//  META DATA
	echo '<input type="hidden" name="discount_type" value="percent" />';
	echo '<input type="hidden" id="id" name="id" value="' . $form['id']  . '" ><br>';
	echo '<input type="hidden" id="id_image" name="id_image" value="' . $form['id_image'] . '" ><br>';
	echo '<input type="hidden" name="hash" value="' . $form['hash_secret'] . '" />';
	echo '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	//  HIDDEN INPUTS
	echo '<input type="hidden" id="redirect" name="redirect" value="/" ><br>';
	//  --------------------------------------------------
	echo '<p class="clear span-12 left" ><input class="right" id="deal-submit" type="submit" name="button" value="Save"></p>';
	//  --------------------------------------------------
	//  Validation holder
}
echo '</form>';
//  --------------------------------------------------
?>