$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH SIGNUP MARKUP
	$("a.signup-link").live('click', function()
	{
		var $thisLink = $(this);
		
		//  ---------------------------------
		//  activate link
		
		LoginSignupMarkup('/', 'signup');
		
		return false;
	});
	//  -------------------------------------------
	//  PROCESS SIGNUP DETAILS
	$("#form-signup").live('submit', function()
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
			$.post('/scripts/processing/ajax.account.signup.php', formData, function(data)
			{
				//alert('back');
				ChangeButtonState($button, true, 'Signup');
				if(data['success'] == true) {
					ClearForm($form.attr('id'));
					$form.append(MessagePanel(data['message']));
				}
				else {
				  	$form.append(ErrorPanel(data['message']));
				}
				
				//  REDIRECT TO NEW PAGE
				//window.location = data['goto'];
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