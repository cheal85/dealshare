$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  PROCESS LINK
	$("input.js-link").live('change', function()
	{	
		console.log('find image');	
		var mylink = $(this).val();
		var $form = $(this).parents('form');
		var $image = $('div.upload-holder img.content');
				
		if(mylink != '')
		{
			if(ValidateLink(mylink)) {
				Loading($('div.upload-holder'), 'show')
				$image.attr('src', '');
				$image.hide();
				//alert(mylink);
				$.post('/scripts/processing/ajax.identify-merchant.php', {'link': mylink, 'submit': true}, function(data)
				{
					//alert('back');
					Loading($('div.upload-holder'), 'hide');
					//console.log(data['debug']);
					if(data['success'] == true) {
						console.log('back');
						var image = data['image'];
						//
						$('input[name="id_image"]').val(image.id);
						ProcessRemoteImage(image);
						$('#id_merchant').val(data['id_merchant']);
					}
					else {
						if(data['message'] != '') {
							RemoveNotices($form);
							$form.append(ErrorPanel(data['message']));
						}
						console.log('no image found');
						//  PUT NO FILE FOUND MESSAGE HERE.  LINK TO PAGE SHOWING HOW TO SAVE FILE FROM WEBSITE
					}
				},
				"json"
				);
			}
			else {
				AddError($(this), $(this).attr('id'), 'Ensure you enter a valid url', $form.attr('id'));
				$(this).addClass('error-field');	
			}
		}
		return false;
	});

});

	function ProcessRemoteImage(image)
	{
		console.log(image.full_path);
		var $image = $('div.upload-holder img.content');
		$image.removeClass('landscape');
		$image.removeClass('portrait');
		$image.addClass(image.orientation);
		$image.attr('src', image.full_path);
		$image.show();
		$('input#id_image').val(image.id);
		/*
		var markup = '';
		markup += '<div class="span-12 clear content-preview on" >';
			markup += '<div class="padding-10" >';
			markup += '<img class="content ' + image.orientation + '" src="' + image.full_path + '" alt="' + image.title + '" title="Selected deal image" />';
			markup += '<input id="id_image" type="hidden" value="' + image.id  + '" />';
			markup += '<p class="clear color-6" >Selected Image</p>';
			markup += '</div>';
		markup += '</div>';
		*/

		if(image['success'] == true)
		{
			console.log('process');
			$.post('/scripts/processing/ajax.image.process.php', {'id':image['id'], 'submit': true}, function(response)
			{
				console.log('back');
				//Loading('remove');
			},
			"json"
			);
			
			return true;
		}
		else
		{
			console.log('not successful');
			//  SHOW ERROR
			return false;	
		}
	}

//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
