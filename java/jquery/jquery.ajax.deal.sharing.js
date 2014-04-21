$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a.js-share").live('click', function()
	{
		var id = $(this).attr('rel');
		
		$.post('/scripts/processing/ajax.deal.share.php', {'id':id,
														'submit': true
															},  function(data)
		{
		},
		"json"
		);
		
		return true;
	});

});