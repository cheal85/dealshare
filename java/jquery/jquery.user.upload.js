$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	//  -------------------------------------------
	//  ACTIVATE FILE UPLOADER
	function CreateUserUploader()
	{
		
		var uploader = new qq.FileUploader({
			// pass the dom node (ex. $(selector)[0] for jQuery users)
			element: document.getElementById('user-uploader'),
			// path to server-side upload script
			action: '/scripts/processing/ajax.image.upload.php',
			
			onSubmit: function(id, fileName){
				element =  $('div.image-gallery'),
				$('div.js-image img.content').hide(),
				Loading($('div.js-image'), 'show')
			},

			onComplete: function(id, fileName, responseJSON){
					ProcessUserImage(responseJSON);
				}
		}); 
	}
	
	function ProcessUserImage(upload)
	{
		if(upload['success'] == true)
		{
			$.post('/scripts/processing/ajax.user.image.process.php', {'id':upload['id'], 'submit': true}, function(response)
			{
				$('input#id_image').val(upload['id']);
				Loading($('div.js-image'), 'hide');
				//  ----------------------------------------
				//  Display new image
				var source = upload['path'] + 'medium/' + upload['filename'];
				console.log(source);
				var $avatar = $('div.js-image');
				var $image = $avatar.find('img.content');
				$image.attr('src', source);
				//  remove orientation
				$('div.js-image').css('width', '150px'),
				$('div.js-image').css('height', '150px')
				$image.removeClass('landscape');
				$image.removeClass('portrait');
				$image.addClass(upload['orientation']);
				$image.show();
				//$('div.js-avatar').css('width', '200px'),
				//$('div.js-avatar').css('height', '200px')
				//  ----------------------------------------
			},
			"json"
			);
			return true;
		}
		else
		{
			//  SHOW ERROR
			return false;	
		}
	}

	CreateUserUploader();
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});