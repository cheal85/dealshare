$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------

	//  -------------------------------------------
	//  OPEN LIGHTBOX WITH LOGIN MARKUP
	$("a.view-deal").live('click', function()
	{
		var $thisLink = $(this);
		
		var LinkData = $(this).attr('rel');
		var dataArray = LinkData.split(':::');
		
		//  ---------------------------------------
		//  BUILD TABS
		var markup = '';
	  	markup += '<div class="tabs clear left span-9" >';
			markup += '<div class="modal-tabs">';
			  	markup += '<p class="left span-5 "><a class="js-tab-link left span-12';
			  	markup += ' on';
			  	markup += '" href="javascript:;" rel="view-deal">View Deal</a></p>';
			  	markup += '<p class="left span-5 "><a class="js-tab-link left span-12';
			  	markup += '" href="javascript:;" rel="view-comments">View Comments</a></p>';
		  	markup += '</div>';
		markup += '</div>';
	  	//  ---------------------------------------
	  	markup += '<div class="left modal-block detail-block block" >';
		//  LOADING
		markup += '<div class="js-loading clear centre" style="width: 64px; height: 64px; display: block;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>';
		//
		markup += '</div>';
		markup += '</div>';
	  	//  ---------------------------------------
	  	OpenLightbox(markup);
		
		var $contentHolder = $('div.modal-block');
		Loading($contentHolder, 'show');
		//alert('open');
		
		$.post('/scripts/processing/ajax.deal.get.php', {'target':dataArray[0],
															'id':dataArray[1],
															'submit': true
															},  function(data)
		{
			//alert(data['markup']);
			Loading($contentHolder, 'hide');
			$contentHolder.html(data['html']);
			//  -------------------------------------
			// RETRIEVE COMMENT MARKUP
			console.log('get comments');
			$.post('/scripts/processing/ajax.comment.get.php', {'target':'temp_view_comments.php',
																'id_deal':dataArray[1],
																'submit': true
																},  function(data)
			{
				//alert('back');
				//alert('comments ' + data['markup']);
				$('div#view-comments').html(data['html']);
			},
			"json"
			);
			//  -------------------------------------
		},
		"json"
		);
		
		return false;
	});
	
	//  SELECT VOUCHER CODE
	$('input#voucher-code').live('click', function(e) {
      $(this).focus().select();
      $(this).keypress(function(e){
      e.preventDefault();
    })
   
});

});