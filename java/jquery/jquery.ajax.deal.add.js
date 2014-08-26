$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	$('a.js-deal-type').live('click', function() {
		var value = $(this).attr('rel');
		$('input[name="deal_type"]').val(value);
		
		$('a.js-deal-type').removeClass('on');
		$(this).addClass('on');	
		
		//  show hide
		if( value == 'deal' ) {
			$('div#voucher-wrap').hide();
			$('div#deal-wrap').show();
		}
		else {
			$('div#deal-wrap').hide();
			$('div#voucher-wrap').show();
		}
		
		return false;
	});

	$('a.js-select-category').live('click', function() {
		var value = $(this).attr('rel');
		var title = $(this).text();
		
		CloseLightbox();
		$('input[name="id_category"]').val(value);
		$('a#id_category').text(title);
		$('a#id_category').addClass('on');
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
//  Image Gallery
function BuildImageGallery() {
	var markup = '';
	//
	markup += '<div class="right span-4 padding " >';
		markup += '<h2 class="color-2">deal image</h2>';
		markup += '<div class="upload-holder " >';
			markup += '<div id="file-uploader" class="full clear centre" >  </div>'; 
			markup += '<div class="clear modal-deal-image centre" >';
			markup += '<div class="js-loading clear centre padding " style="display:none; ">';
			markup += '<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>';
			markup += '<p class="clear centre">Retreiving Image</p></div>';
			markup += '<img class="preview content landscape" src="/web_uploads/images/site_graphics/medium/placeholder-2.jpg" style="display:none;" /></div>';
			markup += '<input id="id_image" type="hidden" class="id-holder" value="" />'
			//markup += '<div class="js-loading clear centre " style="display:none; width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>'; 
		markup += '</div>';
	markup += '</div>';
	//
	return markup;
}