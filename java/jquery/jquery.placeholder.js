$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
//  ADD PLACEHOLDER WHERE APPROPRIATE
	$('input').each(function() {
		AddPlaceholder($(this));
	});
//  -------------------------------------------
	$('textarea').each(function() {
		AddPlaceholder($(this));
	});
//  -------------------------------------------
//  REMOVE PLACEHOLDER WHEN INPUT HAS FOCUS
	$('input.js-placeholder').live('focus', function() {
		$(this).val('');
		$(this).removeClass('js-placeholder');
	});
//  -------------------------------------------
//  ADD PLACEHOLDER WHEN INPUTS ARE LEFT EMPTY
	$('input').live('blur', function() {
		AddPlaceholder($(this));
	});
//  -------------------------------------------
	$('textarea').live('blur', function() {
		AddPlaceholder($(this));
	});
//  -------------------------------------------
//  FUNCTION FOR ADDING PLACEHOLDER
	function AddPlaceholder($input) {
		var placeholder = $input.atter('placeholder');
		
		if(placeholder != '') {
			var value = $input.val();
			if(value == '') {
				$input.val(placeholder);
				$input.addClass('js-placeholder');
			}
		}
	}
//  -------------------------------------------
});