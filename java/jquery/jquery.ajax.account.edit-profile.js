$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
	//  -------------------------------------------
	//  PROCESS EDIT PROFILE
	$("#form-edit-profile").live('submit', function()
	{
		var $form = $(this);
		var $button = $form.find('input[type="submit"]');
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
			$.post('/scripts/processing/ajax.account.edit-profile.php', formData, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Save');
				
				if(data['success'] == true) {
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
	//  PROCESS PASSWORD CHANGE
	$("form#form-change-password").live('submit', function()
	{
		var $form = $(this);
		var $button = $form.find('input[type="submit"]');
		//  Remove previous errors
		RemoveNotices($form);
		var errors = ErrorChecking($form);
		var error = '';
		//				
		if(errors)
		{
			if(error != '') $form.append(ErrorPanel(error));
		}
		else
		{
			var formData = $form.serialize();
			//alert(formData);
			ChangeButtonState($button, false, 'Please wait..');
			$.post('/scripts/processing/ajax.account.change-password.php', formData, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Save');
				//
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