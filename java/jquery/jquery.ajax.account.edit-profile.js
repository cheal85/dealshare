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
	$("input#password-submit").live('click', function()
	{
		var $form = $(this).parents('div#password-form');;
		var $button = $(this);
		//  Remove previous errors
		RemoveNotices($form);
		var errors = ErrorChecking($form);
		var error = '';
		//  -----------------------------------
		//  save information to variables
		var old_password = $form.find('input#old_password').val();
		var new_password_1 = $form.find('input#new_password_1').val();
		var new_password_2 = $form.find('input#new_password_2').val();
		var id = $('input#id').val();
		var hash = $('input#hash').val();
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
			$.post('/scripts/processing/ajax.account.change-password.php', {'old_password':old_password, 'new_password_1':new_password_1, 'new_password_2':new_password_2, 'id': id, 'hash': hash, 'submit': true}, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Save Password');
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