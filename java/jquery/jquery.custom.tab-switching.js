$(document).ready(function(){
//  -------------------------------------
//  TAB SWITCHING IN THE MODAL WINDOW
//  -------------------------------------
$('a.js-tab-link').live('click', function()
{
	var block = $(this).attr('rel');
	$('a.js-tab-link').each(function()
	{
		
		var thisLink = $(this).attr('rel');
		
		if(thisLink != block) {
			$(this).removeClass('on');
		}
		else {
		  	$(this).addClass('on');	
		}
	});
	
	$('div.js-tab').each(function()
	{
		var name = $(this).attr('id');
		
		if(name == block) {
			$(this).show()
		}
		else {
			$(this).hide();
		}
	});
	
	PositionLightbox();
});//  -------------------------------------
$('a.js-browse-link').live('click', function()
{
	console.log('click');
	var block = $(this).attr('rel');
	$('a.js-browse-link').each(function()
	{
		
		var thisLink = $(this).attr('rel');
		$(this).removeClass('on');
		
		if(thisLink == block) {
		  	$(this).addClass('on');	
		}
	});
	
	$('div.js-browse').each(function()
	{
		var name = $(this).attr('id');
		
		if(name == block) {
			JS_TYPE = $(this).attr('rel');
			//alert(JS_TYPE);
			$(this).show()
		}
		else {
			$(this).hide();
		}
	});
	
	PositionLightbox();
});
//  -------------------------------------
//  TAB SWITCHING IN THE MODAL WINDOW
//  -------------------------------------

//  -------------------------------------
//  HIDE/SHOW MOBILE MENU
//  -------------------------------------
	$('a.js-menu-button').live('click', function() {
		if($(this).hasClass('on')) {
			$(this).removeClass('on');
			$('div.js-menu').animate({
			    left: "-100%"
			  }, 300, function() {
			    // Animation complete.
			});
			//$('div.js-menu').css('left', '-300%');
		}
		else {
			$(this).addClass('on');
			$('div.js-menu').animate({
			    left: "0"
			  }, 300, function() {
			    // Animation complete.
			});
			//$('div.js-menu').css('left', '-100%');
		}
		
	});
//  -------------------------------------
//  EXPANDABLE BLOCK
//  -------------------------------------
	$('a.js-expand-button').live('click', function() {
		if($(this).hasClass('on')) {
			$('div.js-expand').css('display', 'none');	
			$(this).removeClass('on');
			var $form = $('div.js-expand').find('form');
			if($form.length > 0) {
				RemoveNotices($form);
			}
		}
		else {
			$('div.js-expand').css('display', 'inherit');
			$(this).addClass('on');	
		}
	});
//  -------------------------------------
});