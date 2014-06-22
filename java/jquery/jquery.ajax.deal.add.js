$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a.add-deal-link").live('click', function()
	{
		var $thisLink = $(this);
		
		//  ---------------------------------
		//  activate link
		var data = new Array();
		data['title'] = "";
		data['description'] = "";
		data['link'] = "";
		data['id'] = "";
		data['id_image'] = "";
		data['redirect'] = "";

		AddDealMarkup('deal')
		CreateUploader();
		//  -------------------------------------------
		//  datepicker
		$('.datepicker').datepicker();
		//  -------------------------------------------
		return false;
	});

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a#add-voucher-link").live('click', function()
	{
		var $thisLink = $(this);
		
		//  ---------------------------------
		//  activate link
		var data = new Array();
		data['title'] = "";
		data['description'] = "";
		data['link'] = "";
		data['id'] = "";
		data['id_image'] = "";
		data['redirect'] = "";

		AddDealMarkup('voucher')
		CreateUploader();
		//  -------------------------------------------
		//  datepicker
		$('.datepicker').datepicker();
		//  -------------------------------------------
		return false;
	});

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a#add-freebie-link").live('click', function()
	{
		var $thisLink = $(this);
		
		//  ---------------------------------
		//  activate link
		var data = new Array();
		data['title'] = "";
		data['description'] = "";
		data['link'] = "";
		data['id'] = "";
		data['id_image'] = "";
		data['redirect'] = "";

		AddDealMarkup('freebie')
		CreateUploader();
		//  -------------------------------------------
		//  datepicker
		$('.datepicker').datepicker();
		//  -------------------------------------------
		return false;
	});

	//  -------------------------------------------
	//  PROCESS SIGNUP DETAILS
	$("form.js-deal-form").live('submit', function()
	{
		var $form = $(this);
		var $button = $form.find('input[type="submit"]');
		var id = $form.find('input[name="id"]').val();
		//  Remove previous errors
		RemoveNotices($form);
		var errors = ErrorChecking($form);
		var error = 'Please ensure all information is provided.';
		//
				
		if(errors)
		{
			$form.append(ErrorPanel(error));
		}
		else
		{
			var formData = $form.serialize();
			//alert(formData);
			ChangeButtonState($button, false, 'Please wait..');
			$.post('/scripts/processing/ajax.deal.add.php', formData, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Save');
				if(data['success'] == true) {
					$form.append(MessagePanel(data['message']));
					//  ----------------------------------
					//  if new deal
					if(id == '') {
						ClearForm($form.attr('id'));
						//
						setTimeout(function(){window.location = data['goto']; location.reload();},1500);
					}
				}
				else {
					$form.append(ErrorPanel(data['message']));
					//  if we can select an individual input
					if(data['error_input'] != '') {
						//console.log(data['error_input']);
						var $input = $('#'+ data['error_input']);
						//Error($input);
					}
				}
			},
			"json"
			);
		}
		return false;
	});
	
	//  ---------------------------------------------
	//  Switch Discount Type
	$('a#discount_type').live('click', function() {
		
		if($(this).hasClass('euro-button')) {
			$(this).removeClass('euro-button');
			$(this).addClass('percent-button');
			$(this).attr('title', 'As a percentage');
			
			$('input[name="discount_type"]').val('percent');
		}
		else if($(this).hasClass('percent-button')) {
			$(this).removeClass('percent-button');
			$(this).addClass('euro-button');
			$(this).attr('title', 'In euros');
			
			$('input[name="discount_type"]').val('euro');
		}
	});
	//  ---------------------------------------------
function AddDealMarkup(selected)
{
	var markup = '';
	/*
	markup += '<div class="content-tab clear left span-9" >';
	markup += '<p class="left span-5 "><a class="js-tab-link left span-12 on';
	markup += '" href="javascript:;" rel="view-deal">View Deal</a></p>';
	markup += '<p class="left span-5 "><a class="js-tab-link left span-12';
	markup += '" href="javascript:;" rel="view-comments">View Comments</a></p>';
	markup += '<p class="left span-5 "><a class="js-tab-link left span-12';
	markup += '" href="javascript:;" rel="view-comments">View Comments</a></p>';
	markup += '</div>';
	*/
	//
	markup += '<div class="tabs clear left span-9"" >';
		markup += '<div class="modal-tabs">';
			markup += '<p class="left span-4"><a class="switch-tab-1 js-tab-link ';
			if(selected == 'deal') markup += ' on';
			markup += '" href="javascript:;" rel="share-a-deal">Share a Deal</a></p>';
			markup += '<p class="left span-4"><a class="switch-tab-2 js-tab-link ';
			if(selected == 'voucher') markup += ' on';
			markup += '" href="javascript:;" rel="share-a-voucher">Share a Voucher</a></p>';
			markup += '<p class="left span-4"><a class="switch-tab-3 js-tab-link ';
			if(selected == 'freebie') markup += ' on';
			markup += '" href="javascript:;" rel="share-a-freebie">Share a Freebie</a></p>';
		markup += '</div>';
	markup += '</div>';
	//  --------------------------------------------------
	markup += '<div class="modal-block share-block left" >';
	//  --------------------------------------------------
	//  SHARE A DEAL FORM
	markup += '<div class="left span-8" style="display:block;">';
	markup += '<div id="share-a-deal" class="form-holder js-tab " ';
	if(selected != 'deal') markup += ' style="display:none;"';
	markup += '>';
	markup += BuildDealForm();

	//  --------------------------------------------------
	markup += '</div>';
	//  --------------------------------------------------
	//  SHARE A VOUCHER FORM
	markup += '<div id="share-a-voucher" class="form-holder js-tab " ';
	if(selected != 'voucher') markup += ' style="display:none;"';
	markup += '>';
	markup += BuildVoucherForm();

	//  --------------------------------------------------
	markup += '</div>';
	//  --------------------------------------------------
	//  SHARE A VOUCHER FORM
	markup += '<div id="share-a-freebie" class="form-holder js-tab " ';
	if(selected != 'freebie') markup += ' style="display:none;"';
	markup += '>';
	markup += BuildFreebieForm();
	//  --------------------------------------------------
	markup += '</div>';
	markup += '</div>';
	//  --------------------------------------------------
	markup += BuildImageGallery()
	//  --------------------------------------------------
	markup += '</div>';
	//  --------------------------------------------------




	OpenLightbox(markup);
	
	return true;

}
//  -------------------------------------------
//  SHOW / HIDE DIFFERENT INPUTS
	$('select.js-select-category').live('change', function() {
		var type = $(this).val();
		//console.log(type);
		
		$('div.js-block-switch').each(function() {
			if(type == $(this).attr('id')) {
				$(this).removeClass('hidden');
			}
			else {
				if(!$(this).hasClass('hidden')) {
					$(this).addClass('hidden');
				}
			}
		});
	});
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});

function BuildDealForm() {
	var markup = '';
	
	markup += '<h2 class="color-2">deal information</h2>';
	//  --------------------------------------------------
	markup += '<form id="form-deal-add" class="left js-deal-form deal-form" span-12 method="post">';
	//  --------------------------------------------------
	markup += '<label class="clear">link</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-link js-clear-input js-url" placeholder="link...   http://www.example.ie" name="link" id="link" value="" rel="Please include a valid link" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">title</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-clear-input" maxlength="200" placeholder="deal title" name="title" id="title" value="" rel="Give your Deal a title" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">description</label>';
	markup += '<p class="clear left span-12" ><textarea type="text" class="clear left js-required js-clear-input" placeholder="description" name="description" id="description" rel="Tell us about the Deal"></textarea></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">price</label>';
	markup += '<p class="clear span-4 left" ><input type="text" class="clear left js-number js-clear-input" maxlength="7" placeholder="price (&euro;)" name="deal_price" value="" ></p>';
	//  --------------------------------------------------
	markup += '<input type="hidden" name="id" value="" />';
	markup += '<input type="hidden" id="id_image" name="id_image" value="" />';
	markup += '<input type="hidden" id="id_merchant" name="id_merchant" value="" />';
	markup += '<input type="hidden" name="deal_type" value="deal" />';
	markup += '<input type="hidden" name="redirect" value="/" />';
	markup += '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	markup += '<input id="deal-submit" class=" third right" type="submit" name="button" value="Share Deal">';
	markup += '</form>';
	
	return markup;	
}
function BuildVoucherForm() {
	var markup = '';
	
	markup += '<h2 class="color-2">voucher informaiton</h2>';
	//  --------------------------------------------------
	markup += '<form id="form-voucher-add" class="left js-deal-form deal-form" method="post">';
	//  --------------------------------------------------
	markup += '<label class="clear">link</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-link js-clear-input js-url" placeholder="link...   www.example.ie" name="link" id="link" value="" rel="Please include a valid link" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">title</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-clear-input" maxlength="200" placeholder="deal title" name="title"  id="title" value="" rel="Give your Deal a title" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">description</label>';
	markup += '<p class="clear left span-12" ><textarea type="text" class="clear left js-required js-clear-input" placeholder="description" name="description" id="description" rel="Tell us about the Deal"></textarea></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">voucher code</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-clear-input" placeholder="voucher code" name="voucher_code" id="voucher_code" value="" rel="Please include the Code"/></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">expiry date</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-clear-input datepicker ll-skin-nigran" placeholder="expiry date" name="date_expiry" id="date_expiry" value="" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">discount</label>';
	markup += '<p class="clear span-4 left" ><input type="text" class="clear left js-number js-clear-input" maxlength="7" placeholder="discount" name="discount" value="" ></p>';
	markup += '<p class=" span-2 left" ><a id="discount_type" href="javascript:;" class="js-type-switch percent-button left" title="As a percentage" >&nbsp;</a></p>';
	//  --------------------------------------------------
	markup += '<input type="hidden" name="id" value="" />';
	markup += '<input type="hidden" name="discount_type" value="percent" />';
	markup += '<input type="hidden" id="id_image" name="id_image" value="" >';
	markup += '<input type="hidden" id="id_merchant" name="id_merchant" value="" />';
	markup += '<input type="hidden" name="deal_type" value="voucher" />';
	markup += '<input type="hidden" name="redirect" value="/" />';
	markup += '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	markup += '<input id="voucher-submit" class=" third right" type="submit" name="button" value="Share Voucher">';
	markup += '</form>';
	
	return markup;	
}
function BuildFreebieForm() {
	var markup = '';
	
	markup += '<h2 class="color-2">freebie information</h2>';
	//  --------------------------------------------------
	markup += '<form id="form-freebie-add" class="left js-deal-form deal-form" method="post">';
	//  --------------------------------------------------
	markup += '<label class="clear">link</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-link js-clear-input js-url" placeholder="link...   www.example.ie" name="link" id="link" value="" rel="Please include a valid link" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">title</label>';
	markup += '<p class="clear left span-12" ><input type="text" class="clear left js-required js-clear-input" maxlength="200" placeholder="deal title" name="title" id="title" value="" rel="Give your Deal a title" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">description</label>';
	markup += '<p class="clear left span-12" ><textarea type="text" class="clear left js-required js-clear-input" placeholder="description" name="description" id="description" rel="Tell us about the Deal"></textarea></p>';
	//  --------------------------------------------------
	markup += '<input type="hidden" name="id" value="" />';
	markup += '<input type="hidden" id="id_image" name="id_image" value="" />';
	markup += '<input type="hidden" id="id_merchant" name="id_merchant" value="" />';
	markup += '<input type="hidden" name="deal_type" value="freebie" />';
	markup += '<input type="hidden" name="redirect" value="/" />';
	markup += '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	markup += '<input id="freebie-submit" class=" third right" type="submit" name="button" value="Share Freebie">';
	markup += '</form>';
	
	return markup;	
}
//  Image Gallery
function BuildImageGallery() {
	var markup = '';
	//
	markup += '<div class="right span-4 padding " >';
		markup += '<h2 class="color-2">deal image</h2>';
		markup += '<div class="upload-holder " >';
			markup += '<div id="file-uploader" class="full clear centre" >  </div>'; 
			markup += '<div class="js-loading clear centre padding " style="display:none; ">';
			markup += '<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>';
			markup += '<p class="clear centre">Retreiving Image</p></div>';
			markup += '<div class="image-gallery clear" > </div>';
			//markup += '<div class="js-loading clear centre " style="display:none; width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>'; 
		markup += '</div>';
	markup += '</div>';
	//
	return markup;
}