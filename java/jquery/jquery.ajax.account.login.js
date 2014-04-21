$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a.js-login").live('click', function()
	{
		var $thisLink = $(this);
		
		//  ---------------------------------
		//  activate link
		
		LoginSignupMarkup('/', 'login');
		

		return false;
	});
	//  -------------------------------------------
	//  PROCESS LOGIN DETAILS
	$("#form-login").live('submit', function()
	{
		var $form = $(this);
		var $button = $form.find('input[type="submit"]');
		//  Remove previous errors
		RemoveNotices($form);
		var errors = ErrorChecking($form);
		var error = 'Please ensure all information is provided';
		//
				
		if(errors == true)
		{
			$form.append(ErrorPanel(error));
		}
		else
		{
			var formData = $form.serialize();
			//alert(formData);
			ChangeButtonState($button, false, 'Please wait..');
			$.post('/scripts/processing/ajax.account.login.php', formData, function(data)
			{
				//console.log('back');
				ChangeButtonState($button, true, 'Login');
				if(data['success'] == true)
				{
					//  REDIRECT TO NEW PAGE
					window.location = data['redirect'];
				}
				else
				{
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

function LoginSignupMarkup(redirect, selected)
{
	var markup = '';
	markup += '<div class="tabs clear left span-8" >';
		markup += '<div class="modal-tabs">';
			markup += '<p class="left span-6"><a class="switch-tab-1 js-tab-link ';
			if(selected == 'login') markup += ' on';
			markup += '" href="javascript:;" rel="login">login</a></p>';
			markup += '<p class="left span-6"><a class="switch-tab-2 js-tab-link ';
			if(selected == 'signup') markup += ' on';
			markup += '" href="javascript:;" rel="signup">sign up</a></p>';
		markup += '</div>';
	markup += '</div>';
	//  --------------------------------------------------
	//  MODAL BLOCK
	markup += '<div class="modal-block" >';
	//  --------------------------------------------------
	//  LOGIN FORM
	markup += '<div id="login" class="form-holder js-tab" ';
	if(selected != 'login') markup += ' style="display:none;"';
	markup += '>';
	markup += '<form id="form-login" class="" method="post">';
	markup += '<label class="clear">email</label>';
	markup += '<p><input class="clear left js-required js-clear-input js-email" type="email" id="email" placeholder="enter your email address" name="email" value="" rel="please enter a valid email" /></p>';
	markup += '<label class="clear">password</label>';
	markup += '<p><input class="clear left js-required js-clear-input" type="password" id="password" placeholder="enter a password" name="password" value="" rel="please enter a valid password" /></p>';
	//  --------------------------------------------------
	//  HIDDEN INPUTS
	markup += '<input class="clear left" type="hidden" id="redirect" name="redirect" value="'+ redirect +'" >';
	markup += '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	markup += '<p><input class="clear left " id="login-submit" type="submit" name="button" value="login"></p>';
	//markup += '<br /><a href="/account-recovery/" >Forgot your password?</a>';
	markup += '</form>';
	//markup += '<div class="back-color-2 full signup-link" ><a class="link-next" href="/signup/"><p class="color-4">Sign-up</p></a></div>';
	markup += '</div>';
	//  --------------------------------------------------
	//  SIGNUP FORM
	markup += '<div id="signup" class="form-holder js-tab" ';
	if(selected != 'signup') markup += ' style="display:none;"';
	markup += '>';
	markup += '<form id="form-signup" autocomplete="off" class="" method="post">';
	//  --------------------------------------------------
	markup += '<label class="clear">email</label>';
	markup += '<p><input class="clear left js-required js-email js-clear-input" type="email" id="email" placeholder="enter your email address" name="email" rel="we need your email" value="" /></p>';
	markup += '<label class="clear">user name</label>';
	markup += '<p><input class="clear left js-required js-clear-input" type="text"  id="user_name" placeholder="choose a username" name="user_name" value=""rel="give yourself a Username" /></p>';
	//  --------------------------------------------------
	markup += '<label class="clear">password</label>';
	markup += '<p><input class="clear left js-required js-clear-input" type="password" placeholder="enter a password" id="password" name="password" rel="give your account a password" value="" /></p>';
	//  --------------------------------------------------
	//  HIDDEN INPUTS
	markup += '<input type="hidden" id="redirect" name="redirect" value="' + redirect + '" ><br>';
	markup += '<input type="hidden" name="submit" value="1" />';
	//  --------------------------------------------------
	markup += '<p class="input" ><input class="clear left full" id="signup-submit" type="submit" name="button" value="sign up">';
	//  --------------------------------------------------
	markup += '</form>';
	markup += '</div>';
	markup += '</div>';

	OpenLightbox(markup);
}