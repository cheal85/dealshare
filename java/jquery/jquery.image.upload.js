$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	//  -------------------------------------------
	//  ACTIVATE FILE UPLOADER
	function CreateImageUploader()
	{
		
		var uploader = new qq.FileUploader({
			// pass the dom node (ex. $(selector)[0] for jQuery users)
			element: document.getElementById('image-uploader'),
			// path to server-side upload script
			action: '/scripts/processing/ajax.image.upload.php',
			
			onSubmit: function(id, fileName){
				//  hide the existing image
				$('div.js-image img.content').hide(),
				//  shoe the loading animation
				Loading($('div.js-image'), 'show')
			},

			onComplete: function(id, fileName, responseJSON){
					ProcessImage(responseJSON);
				}
		}); 
	}
	
	function ProcessImage(upload)
	{
		//  reference image tag
		var $image_wrap = $('div.js-image');
		var $image = $image_wrap.find('img.content');
		//  remove any  existing errors
		$('div.js-upload-error').remove();
		if(upload['success'] == true)
		{
			$.post('/scripts/processing/ajax.user.image.process.php', {'id':upload['id'], 'submit': true}, function(response)
			{
				//  assign id
				$('input#id_image').val(upload['id']);
				//  hide loading animation
				Loading($('div.js-image'), 'hide');
				//  ----------------------------------------
				//  Display new image
				//  get source for image
				var source = upload['path'] + 'medium/' + upload['filename'];
				console.log(source);
				
				$image.attr('src', source);
				//  remove existing orientation
				$image.removeClass('landscape');
				$image.removeClass('portrait');
				//  add orientation
				$image.addClass(upload['orientation']);
				$image.show();
				//  ----------------------------------------
			},
			"json"
			);
			return true;
		}
		else
		{
			//  SHOW ERROR
			Loading($('div.js-image'), 'hide');
			$image.show();
			//  add error
			var error = '<div class="padding-10 js-upload-error" ><div class="clear error-panel clear" ><p>' + upload['error'] + '</p></div></div>';
			$image_wrap.before(error);
			return false;	
		}
	}

	CreateImageUploader();
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});