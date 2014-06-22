//  -------------------------------------
//  CUSTOM FUNCTIONALITY
//  -------------------------------------

//  -------------------------------------
//  cookiebar
$("a.js-dismiss-cookie-bar").live('click', function()
{
	alert('post');
	$('div#cookie-bar').remove();
	//
	$.post('/scripts/processing/ajax.agree-to-cookies.php', {}, function(data)
	{
		//console.log('cookie set');
	},
	"json"
	);
	return false;
});
//  -------------------------------------
//  loading spinner
function Loading($container, doThis)
{
	var $loading = $container.find('div.js-loading');
	if(doThis == 'hide') {
		$loading.hide();	
	}
	else if(doThis == 'show') {
		//alert('show');
		$loading.show();	
	}
}
//  ------------------------------------
function LoadMore($container, doThis)
{
	if(doThis == 'hide') {
		var $loadmore = $container.find('a.js-load-more');
		$loadmore.hide();	
	}
	else if(doThis == 'show') {
		//alert('show');
		var $loadmore = $container.find('a.js-load-more');
		$loadmore.show();	
	}
}
//  ------------------------------------
//  CHECKBOX FUNCTIONALITY
//  ------------------------------------
$('a.js-checkbox').live('click', function() {
	var input_name = $(this).attr('rel');
	var $image = $(this).find('img');
	//
	var $input = $('input[name="' + input_name + '"]');
	//
	if($(this).hasClass('on')) {
		//  turn off
		$image.attr('src', '/web_graphics/icons/checkbox-off.png');
		$(this).removeClass('on');
		$input.val('no');
	}
	else {
		//  turn on
		$image.attr('src', '/web_graphics/icons/checkbox-on.png');
		$(this).addClass('on');
		$input.val('yes');
	}
	return false;	
});
//  ------------------------------------
//  PANEL FUNCTIONS
//  ------------------------------------
function ErrorPanel(message, large) {
	var markup = '';	
	markup += '<div class="error-panel clear remove large"><p>' + message + '</p></div>';
	return markup;
}
function ErrorPanel(message) {
	var markup = '';	
	markup += '<div class="error-panel clear remove"><p>' + message + '</p></div>';
	return markup;
}

function NoticePanel(message) {
	var markup = '';	
	markup += '<div class="notice-panel clear remove"><p>' + message + '</p></div>';
	
	return markup;
}

function MessagePanel(message) {
	var markup = '';	
	markup += '<div class="message-panel clear remove"><p>' + message + '</p></div>';
	
	return markup;
}
function InlinePanel(message, className) {
	
}
function RemovePanel(container) {
	var id = container.attr('id');
	
	$('#' + id + ' .remove').each(function() {
		$(this).remove();
	});
}
//  ------------------------------------
//  PANEL FUNCTIONS
//  ------------------------------------

//  ------------------------------------
//  FORM VALIDATION ROUTINES
//  ------------------------------------
function ErrorChecking(form) {

	var errors = false;
	var formId = form.attr('id');
	
	$('#' + formId).find('.js-required').each(function()
	{
		if($(this).is(":visible")) {
			if($(this).val() === '') {
				Error($(this));
				errors = true;	
	  		}
		}
	});
	
	$('#' + formId).find('.js-email').each(function()
	{
		if($(this).is(":visible")) {
			if($(this).val() !== '') {
				var email = $(this).val();
				var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				
				if(!regex.test(email)) {
					Error($(this));
					errors = true;
				}
			}
		}
	});
	
	$('#' + formId).find('.js-number').each(function()
	{
		if($(this).is(":visible")) {
			if($(this).val() !== '') {
				var price = $(this).val();
				var regex = /^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
		
				if(!regex.test(price)) {
					Error($(this));
					errors = true;
				}
			}
		}
	});
	
	$('#' + formId).find('.js-url').each(function() {
		if($(this).is(":visible")) {
			if($(this).val() !== '') {
				if(!ValidateLink($(this).val())) {
				 	Error($(this));
					errors = true;			
				}
			}
		}
	});
	
	var $passwords = $('#' + formId).find('.js-password');
	//
	if($passwords.length > 1) {
		var password1 = $('input#new_password_1').val();
		var password2 = $('input#new_password_2').val();
		if((password1 != '') && (password2 != '')) {
			//
			if(password1 != password2) {
				Error($('#new_password_1'));
				Error($('#new_password_2'));
				errors = true;	
			}
		}
	}
	else if($passwords.length > 0) {
		
	}
	
	
	return errors;
}
//  ------------------------------------
//  Remove all errors
function RemoveErrors(formId) {
	$('#' + formId + ' div.error-panel').each(function() {
		$(this).remove();
	});
	
	$('#' + formId + ' span.inline-error').each(function() {
		$(this).remove();
	});
		
	return true;
}
//  ------------------------------------
//  Remove all notices
function RemoveNotices(form) {
	var formId = form.attr('id');
	$('#' + formId + ' div.message-panel').each(function() {
		$(this).remove();
	});
	$('#' + formId + ' div.notice-panel').each(function() {
		$(this).remove();
	});
	$('#' + formId + ' div.error-panel').each(function() {
		$(this).remove();
	});
	
	$('#' + formId + ' span.inline-error').each(function() {
		$(this).remove();
	});
	
	$('#' + formId + ' .error-field').each(function() {
		$(this).removeClass('error-field');
	});
	
	return true;
}
function ClearForm(formId) {
	$('#' + formId + ' .js-clear-input').each(function () {
		$(this)	.val('');
	});
	
	return true;
}

function ChangeButtonState(button, enabled, text) {
	button.val(text);
	if(enabled == true) {
		button.attr('disabled', false);
	}
	else {
		button.attr('disabled', true);
	}
}

function Error($element) {
	$element.addClass('error-field');	
	
	var $form = $element.parents('form');
	var formId = $form.attr('id');
	var id		= $element.attr('id');
	var message	= $element.attr('rel');	
	
	$('form#' + formId + ' span#' + id + '-error').remove();
	
	if(message != 'undefined') {
		AddError($element, id, message, formId);
	}
}

function AddError($element, id, message, formId) {
	
	var html	= '<span id="' + id + '-error" class="inline-error " ><img src="/web_graphics/backgrounds/inline-arrow.png" /><p>' + message + '</p></span>';
	$element.after(html);
	var width = $element.width();
	var position = $element.position();
	var top = position.top;
	var left = position.left;
	var thisPosition = $('form#' + formId + ' span#' + id + '-error').position();
	var thisLeft = thisPosition.left;
	
	if($element.is('textarea')) left -= 16;

	$('form#' + formId + ' span#' + id + '-error').css('top', top);
	$('form#' + formId + ' span#' + id + '-error').css('left', (width+left+35));
	$('form#' + formId + ' span#' + id + '-error').css('z-index', 1002);
}


//  ------------------------------------
//  FORM VALIDATION ROUTINES
//  ------------------------------------
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
//  ------------------------------------
//  REMOVE ERRORS ON FOCUS
//  ------------------------------------
$('.js-required').live('focus',function()
{
	var id = $(this).attr('id');
	$('span#' + id + '-error').remove();
	$(this).removeClass('error-field');
});

$('.js-email').live('focus',function()
{
	var id = $(this).attr('id');
	$('span#' + id + '-error').remove();
	$(this).removeClass('error-field');
});

$('.js-number').live('focus',function()
{
	var id = $(this).attr('id');
	$('span#' + id + '-error').remove();
	$(this).removeClass('error-field');
});

//  ------------------------------------
function ValidateLink(url)
{
     return url.match(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/);
}
