$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	//  -------------------------------------------
	//  ACTIVATE FILE UPLOADER
	function CreateDealUploader()
	{
		
		var uploader = new qq.FileUploader({
			// pass the dom node (ex. $(selector)[0] for jQuery users)
			element: document.getElementById('user-uploader'),
			// path to server-side upload script
			action: '/scripts/processing/ajax.content.upload.php',
			
			onSubmit: function(id, fileName){
				element =  $('div.image-gallery'),
				$('div.js-avatar img').attr('src', '/web_graphics/backgrounds/loading.gif'),
				$('div.js-avatar').css('width', '100px'),
				$('div.js-avatar').css('height', '100px')
			},

			onComplete: function(id, fileName, responseJSON){
					ProcessDealImage(responseJSON);
				}
		}); 
	}
	
	function ProcessDealImage(upload)
	{
		if(upload['success'] == true)
		{
			$('input#id_image').val(upload['id']);
			var deal = $('input#id').val();
			$.post('/scripts/processing/ajax.deal.image.process.php', {'id':upload['id'], 'id_deal': deal, 'submit': true}, function(response)
			{
				//  ----------------------------------------
				//  Display new image
				var source = upload['path'] + 'medium/' + upload['filename'];
				console.log(source);
				var $avatar = $('div.js-avatar');
				var $image = $avatar.find('img');
				$image.attr('src', source);
				//  remove orientation
				$image.removeClass('landscape');
				$image.removeClass('portrait');
				$image.addClass(upload['orientation']);
				$('div.js-avatar').css('width', '200px'),
				$('div.js-avatar').css('height', '200px')
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

	CreateDealUploader();
	CreateUploader();
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});