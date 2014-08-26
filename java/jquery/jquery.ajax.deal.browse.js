$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
var JS_WIDTH = $('body').width();
var JS_COUNT = (Math.floor(((JS_WIDTH - 40) / 220))*4);
if(JS_COUNT < 12) JS_COUNT = 12;
var LOAD_MORE = false;
//  -------------------------------------------
//  display prize modal
if (typeof JS_SHOW_PRIZE != 'undefined') {
	if(JS_SHOW_PRIZE) {
		ShowPrize();
	}
}
//  -------------------------------------------
//  category selection
$('a.js-category').live('click', function() {
	var id = $(this).attr('rel');
	JS_SELECTED_CAT = id;
	var $level = $(this).parents('div.cat-container');
	var show = true;
	//  test what to do
	if($(this).hasClass('selected')) show = false;

  	//  assign as selected category
	
	//  add on state
	$level.find('a.js-category').each(function() {
		//  remove onstate and hide sub categories
		if($(this).hasClass('on')) {
			ShowSubCategory($(this), false);
		}
	});
	console.log('out');
	
	if(show) {
		ShowSubCategory($(this), true);
		$(this).addClass('selected')
	}
	else {
		$(this).removeClass('selected')	
	}
	
	
});
//  -------------------------------------------
//  reload
$('a#js-filter').live('click', function() {
	window.location = '/?cat=' + JS_SELECTED_CAT;
});
//  -------------------------------------------
//  back to top functionality
if (typeof JS_THIS_PAGE != 'undefined') {
	if(JS_THIS_PAGE == 'homepage') {
		// hide #back-top first
		$("#back-top").hide();
		//
		// fade in #back-top
		$(window).scroll(function() {
		    var height = $(window).scrollTop();
		    if(height  > 600) {
		        // do something
				$('#back-top').fadeIn();
		    }
			else {
				$('#back-top').fadeOut();
			}
		});		
		//
		// scroll body to 0px on click
		$('#back-top a').live('click', function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	}
}

	//  -------------------------------------------
	//  PROCESS SIGNUP DETAILS
	function GetDeals()
	{
		//  ---------------------------------------
		if(JS_MORE == true) {		
			//  ---------------------------------------
			//  prevent the loading of further content
			JS_MORE = false;
			//  ---------------------------------------
			//  assign values
			var $container = $('div#browse-deals');
			var search_term = $('input#search').val();
			var requestPage = JS_PAGE;
			var $holder = $('div#deals');
			var category = JS_CATEGORY;
			LoadMore($container, 'hide');
			//  ---------------------------------------
			//  Show loading
			Loading($container, 'show');
			//  increase page
			JS_PAGE++;
			//  ---------------------------------------
			//  set script location
			var script ='/scripts/processing/ajax.deal.browse.php';

			//alert(JS_CATEGORY);
			//alert('browse');
			$.post(script, {'page':requestPage, 'count':JS_COUNT, 'category': category, 'search': search_term, 'submit': true}, function(data)
			{
				console.log('back');
				Loading($container, 'hide');
				if(data['success'] == true)
				{
					var JS_CONTENT = data['array'];
					
					var html = data['html'];
					console.log(html);
						
					$holder.append(html);
					JS_MORE = true;

					LoadMore($container, 'show');
				}
				else {
					//  -------------------------------
					//  RETURN FALSE WHEN NO CONTENT 
					//  FOUND.  PREVENT FURTHER 
					//  SEARCHES
					$holder.append(MessagePanel('No Further Content to Display'));
				}
			},
			"json"
			);
		}
	}
	
	//  initiate load
	GetDeals();
		  	
	$('div.item').live('mouseenter', function()
	{
		if(JS_WIDTH > 901) {
	  		$('div.item-hover').each(function()
	  		{
	  		  $(this).hide();	
	  		});
	  		
	  		var $hover = $(this).find('div.item-hover');
	  		
	  		$hover.show();
	  	}
	});
	
	$('div.item').live('mouseleave', function()
	{
		$('div.item-hover').each(function()
		{
		  $(this).hide();	
		});
	});
	
	$('a.js-load-more').live('click', function()
	{
		//$('div.footer-wrapper').hide();
		//$(this).hide();
		LOAD_MORE = true;
		GetDeals();
		
		return false;
	});
	
	
	//  ----------------------------------------------
	//  VOTE UP DEALS
	$('a.js-vote').live('click', function()
	{
		var id = $(this).attr('rel');
		var $thisLink = $(this);
		var $parent = $('div#deal-'+id)
		var $largeVoteButton = $parent.find('a.icon-vote');
		var $voteCounter = $parent.find('a.icon-vote-small span');
		var share_link = $parent.find('a.js-share').attr('href');
		console.log($voteCounter.html());
		console.log($voteCounter.text());
		var votes = parseInt($voteCounter.html());
		var script ='/scripts/processing/ajax.deal.vote.php';
		//  ---------------------------------------
		$.post(script, {'page':JS_PAGE, 'id':id, 'submit': true}, function(data)
		{
			//alert('back');
			if(data['success'] == true) {
				var markup = '<a href="https://www.facebook.com/sharer/sharer.php?u=' + share_link + '" target="_blank" class="js-share icon-hover icon-share " title="Share this Deal" rel="' + id + '"><img src="/web_graphics/icons/share-icon.png" style="width:100%; height:100%;" /></a>';
				
				$largeVoteButton.after(markup);
				$largeVoteButton.remove();
				//  increment vote
				votes++;
				console.log(votes);
				$voteCounter.html(votes);
				$thisLink.attr('title', data['message']);
			}
			else {
				$thisLink.attr('title', data['message']);
			}
		},
		"json"
		);
		return false;
	});
	//  ----------------------------------------------
	/*
	//  ----------------------------------------------
	//  VOTE UP DEALS
	$('a.js-modal-vote').live('click', function()
	{
		var id = $(this).attr('rel');
		var $thisLink = $(this);
		var $voteCounter = $('div#deal-'+id).find('a.icon-vote-small span');
		var votes = parseInt($voteCounter.html());
		var script ='/scripts/processing/ajax.deal.vote.php';
		//  ---------------------------------------
		$.post(script, {'page':JS_PAGE, 'id':id, 'submit': true}, function(data)
		{
			//alert('back');
			if(data['success'] == true) {				
				$thisLink.remove();
				//  increment vote
				votes++;
				$voteCounter.html(votes);
				$thisLink.attr('title', data['message']);
			}
			else {
				$thisLink.attr('title', data['message']);
			}
		},
		"json"
		);
		return false;
	});
	*/
	
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});

function ShowPrize() {
	var prize_markup = '';
		
	prize_markup += '<div style="width: 400px; height: 300px;" >';
	prize_markup += '<a href="/account/login/" ><img src="/web_graphics/prize-test.jpg" /></a>';
	prize_markup += '</div>';
	
	OpenLightbox();
	var $contentHolder	= $("div.modal-content");
	
	$contentHolder.html(prize_markup);
	PositionLightbox();
	
	
}