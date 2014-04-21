//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	//  -------------------------------------------
	//  ACTIVATE FILE UPLOADER
	function CreateUploader()
	{
		
		var uploader = new qq.FileUploader({
			// pass the dom node (ex. $(selector)[0] for jQuery users)
			element: document.getElementById('file-uploader'),
			// path to server-side upload script
			action: '/scripts/processing/ajax.content.upload.php',
			
			onSubmit: function(id, fileName){
				element =  $('div.image-gallery'),
				element.empty();
				Loading($('div.upload-holder'), 'show')
			},

			onComplete: function(id, fileName, responseJSON){
					ProcessImage(responseJSON);
				}
		}); 
	}
	
	function ProcessImage(upload)
	{
		$gallery = $('div.image-gallery');
		
		if(upload['success'] == true)
		{
			$.post('/scripts/processing/ajax.image.process.php', {'id':upload['id'], 'submit': true}, function(data)
			{
				Loading($('div.upload-holder'), 'hide');
				var image = data['image'];
				var markup = '';
				
				$('div.content-preview').each(function()
				{
					$(this).removeClass('on');	
				});

				markup += '<div class="span-12 clear content-preview on" >';
				  	markup += '<div class="padding-10" >';
					markup += '<img class="preview ' + image.orientation + '" src="' + image.full_path + '" alt="' + image.title + '" title="Select this image to use with your deal" />';
					markup += '<input type="hidden" class="id-holder" value="' + image.id  + '" />';
					markup += '<p class="clear color-6" >Selected Image</p>';
					markup += '</div>';
				markup += '</div>';
				$('input[name="id_image"]').val(image.id);
								  
				$gallery.html(markup);
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
	
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
