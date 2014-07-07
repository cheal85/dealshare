$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  PROCESS CONTACT
	$("#form-contact").live('submit', function()
	{
		var $form = $(this);
		var $button = $form.find('input[type="submit"]');
		//
		RemoveNotices($form);
		//
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
			alert(formData);
			ChangeButtonState($button, false, 'Please wait..');
			$.post('/scripts/processing/ajax.contact.php', formData, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Send');
				if(data['success'] == true) {
					ClearForm($form.attr('id'));
					$form.append(MessagePanel(data['message']));
				}
				else {
				  	$form.append(ErrorPanel(data['message']));
				}
			},
			"json"
			);
		}
		return false;
	});
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});