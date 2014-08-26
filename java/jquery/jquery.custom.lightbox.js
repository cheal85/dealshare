$(document).ready(function(){
//  -------------------------------------
//  LIGHTBOX FUNCTIONALITY
//  -------------------------------------


//  ----------------------------------------------
//  LIGHTBOX FUNCTIONALITY
//
//  Handled by ajax call
//  ----------------------------------------------

	$("a.lightbox").live('click', function(a)
	{
		a.preventDefault();
		var LinkData = $(this).attr('rel');
		var dataArray = LinkData.split(':::');
		var target = dataArray[0];
		
		
		OpenLightbox();
		var $contentHolder	= $("div.modal-content");
		//alert('open');
		$.post('/scripts/processing/ajax.lightbox.php', {	'submit':1,
															'target':target,
															'data_array':dataArray
															},  function(data)
		{
			//alert(data['html']);
			$contentHolder.html(data['html']);
		},
		"json"
		);
		
		return false;
	});
	
	
	$("a#close-lightbox").live('click', function()
	{
		CloseLightbox();
		
		return false;
	});
	
});

//  -------------------------------------
//  OPEN LIGHTBOX
//  -------------------------------------
//  Open Main lightbox.  This will be centred on screen
function OpenLightbox(content)
{
	//CloseLightBox();
	//  ---------------------------------------------------------
    //  LIGHTBOX TEMPLATE
	var markup = '';
	
	markup +='<div id="modal" class="left clear modal-wrapper " tabindex="0" >';
	markup +='<a id="close-modal" class="right" href="javascript:;"  title="Close">close</a>';
	markup +='<div class="left clear modal-content">';
	markup +='<div class="left clear modal-content-wrapper" >';
		
	markup +=content;
		
	markup +='</div>';
	markup +='</div>';
	markup +='</div>';
	markup += '<div id="fade" class="" style="display:block;"></div>';
    //  ---------------------------------------------------------
	//alert(lightboxMarkup);
	$('body').append(markup);

	PositionLightbox();

}


//  -------------------------------------
//  CLOSE LIGHTBOX
//  -------------------------------------
$('a#close-modal').live('click', function()
{
	CloseLightbox();
});
//  -------------------------------------
function CloseLightbox()
{
	$("div#modal").remove();
	$("div#fade").remove();
}
//  -------------------------------------

//  -------------------------------------
//  POSITION LIGHTBOX
//  -------------------------------------
function PositionLightbox()
{
	var width = $("div#modal").width();
	var bWidth = $("body").width();
	var bHeight = $("body").height();	
	
	var top = window.pageYOffset+100;
	
	var left = ((bWidth-width)/2);
	
	$("div#modal").css('left', left);
	$("div#modal").css('top', top);
	$("div#fade").css('height', bHeight+140);
}
//  ---------------------------------------------------
//  HIDE WHEN FOCUS LOST
//  ---------------------------------------------------
$("div#fade").live('click', function() 
{
	CloseLightbox();
});
