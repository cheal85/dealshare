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

	//  -------------------------------------------
	//  PROCESS SIGNUP DETAILS
	function GetDeals(type)
	{
		LoadMore($('div#browse-' + type + 's'), 'hide');
		var search_term = $('input#search').val();
		var requestPage = JS_PAGE[type];
		var $holder = $('div#' + type + 's');
		//  ---------------------------------------
		//  Show loading
		Loading($('div#browse-' + type + 's'), 'show');
		//  ---------------------------------------
		if(JS_MORE[type] == true) {
			JS_PAGE[type]++;
			//  ---------------------------------------
			var script ='/scripts/processing/ajax.deal.browse.php';
			//  ---------------------------------------
			JS_MORE[type] = false;
			//alert(JS_COUNT);
			//alert(search_term);
			$.post(script, {'page':requestPage, 'type':type, 'count':JS_COUNT, 'search': search_term, 'submit': true}, function(data)
			{
				Loading($('div#browse-' + type + 's'), 'hide');
				if(data['success'] == true)
				{
					var JS_CONTENT = data['array'];
					
					//var html = BuildDeals(JS_CONTENT);
					var html = data['html'];
					//console.log(html);
						
					$holder.append(html);
					JS_MORE[type] = true;
					

					LoadMore($('div#browse-' + type + 's'), 'show');
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
	
		GetDeals('deal');
		
		GetDeals('voucher');
		
		GetDeals('freebie');
		  	
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
		GetDeals(JS_TYPE);
		
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
	//  ----------------------------------------------
	//  switch between browsing tabs based on hashtags
	//  get hashtag if it exists
	var url = window.location.hash;
    var hash = url.split('#');
	var hash_found = false;
	for(var i=0; i<hash.length; i++) {
		if(!hash_found) {
			if((hash[i] == 'deals') || (hash[i] == 'vouchers') || (hash[i] == 'freebies')) {
				hash_found = true;
			
				var block = 'browse-'+hash[i];
				$('a.js-browse-link').each(function()
				{
					var thisLink = $(this).attr('rel');
					
					$(this).removeClass('on');
					
					if(thisLink == block) {
					  	$(this).addClass('on');	
					}
				});
				//
				$('div.js-browse').each(function()
				{
					var name = $(this).attr('id');
					if(name == block) {
						JS_TYPE = $(this).attr('rel');
						$(this).show()
					}
					else {
						$(this).hide();
					}
				});
			}
		}
	}
		
	//  ----------------------------------------------
	
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
});

function BuildDeals(array) {
	var markup = '';
	for(var i = 0; i<array.length; i++)
	{
		deal = array[i];
		markup += BuildDealItem(deal);
		
	}
	return markup;

}

  	function BuildDealItem(deal) {
		var markup = '';
		markup += '<div id="deal-' + deal['id'] + '" class="item ">';
			//  --------------------------------------------------
			var discount = parseFloat(deal.discount);
			if(discount > 0 || deal.deal_type != 'voucher') {
				
						//var price = deal.deal_price.parseFloat.toFixed(2);
						
						if(deal.deal_type == 'deal') {
							var price = parseFloat(deal.deal_price).toFixed(2);
							if(price > 0) {
								markup +=  '<div class="item-price" >';
									markup +=  '<div class="padding-5" >';
										
										markup +=  '<p class="left ">&euro;' + price + '</p>';
									markup +=  '</div>';
								markup +=  '</div>';
							}
						}
						else if(deal.deal_type == 'voucher'){
							if(deal.discount > 0) {
								markup +=  '<div class="item-price" >';
									markup +=  '<div class="padding-5" >';
									var discount = parseInt(deal.discount);
									if(deal.discount_type == 'percent') {
										discount += ' &#37';
									}
									else {
										discount = '&euro; ' + discount;
									}
										markup +=  '<p class="left ">' + discount + ' off</p>';
									markup +=  '</div>';
								markup +=  '</div>';
							}
						}
			}
			//  --------------------------------------------------
			//  PRODUCT IMAGE
			markup +=  '<div class="item-image clear back-color-3">';
				//  --------------------------------------------------
				if(JS_USER != 10) {
					var voters = deal.voters.split('__')
					var voted = false;
					for(var ii=1; ii<voters.length; ii++) {
						if(JS_USER == voters[ii]) {
							voted = true;
						}
					}
						markup +=  '<div class="item-hover absolute centre" style="display:none;">';	
						if(voted === false) {
							markup +=  '<a href="javascript:;" class="js-vote icon-hover icon-vote " title="Cast your vote!" rel="' + deal.id + '"><span class="hidden">vote</span></a>';
						}
						else {
							markup +=  '<a href="https://www.facebook.com/sharer/sharer.php?u=' + deal['link'] + '" target="_blank" class="js-share icon-hover icon-share " title="Share this Deal" rel="' + deal.id + '"><span class="hidden">share</span></a>';
						}
						markup +=  '</div>';
				}
				//  --------------------------------------------------
				markup += '<a class="view-deal" href="/deal/'+ deal.url_safe + '/' + deal.hash + '/' + deal.id + '/" rel="temp_view_deal.php:::' + deal.id + '" title="View this Deal" ><img id="deal-image-' + deal.id + '"class="' + deal.image.orientation + ' image-item" src="' + deal.image.full_path + '"  /></a>';
			markup +=  '</div>';
			//markup +=  '<img class="shine clear" src="/web_graphics/shine.png" >';
			//  --------------------------------------------------
			
			//  --------------------------------------------------
			//  DEAL DESCRIPTION
			markup +=  '<div class="item-details clear border-top-color">';
				markup +=  '<div class="right-left-5 clear ">';
	  				markup +=  '<div class="item-title clear left span-12">';
						var title = deal.title;
						if(title.length > 46) {
							title = title.substring(0, 50);
							title += '...';
						}
	  					markup +=  '<h4 class="clear left" ><a class="view-deal" href="/deal/'+ deal.url_safe + '/' + deal.hash + '/' + deal.id + '/" rel="temp_view_deal.php:::' + deal.id + '" ';
						markup +=  ' title="' + deal.description + '" ';
						markup +=  '>' + title + '</a></h4>';
	  				markup +=  '</div>';
	  				//  --------------------------------------------------
	  				//  DEAL DESCRIPTION
		  			markup +=  '<div class="clear left border-top span-12" >';
						markup +=  '<div class="left clear span-2 "><a class="external-link" href="' + deal['link'] + '"  target="_blank" title="Get this Deal!" >&nbsp</a></div>';
		  				markup +=  '<div class="item-author right  span-10" >';
							markup +=  '<div class="padding-5 right" >';
			  					markup +=  '<div class="user-image clear right">';
			  						markup += '<img class="content " src="' + deal.user_image.full_path + '" width="20" height="20">';
			  					markup +=  '</div>';
							markup +=  '</div>';	
		  					//  --------------------------------------------------
							markup +=  '<div class="padding-5 right" >';
			  					if(deal.user.user_type  == 'user') {
			  						markup +=  '<p class="small" >shared by <a href="/user-deals/' + deal.user.hash + '/' + deal.user.id + '/">' + deal.user.name + '</a><br />';
			  					}
			  					else {
			  						markup +=  '<p class="small" >shared by ' + deal.user.user_type.capitalize() + '<br />';
			  					}
			  					markup +=  '<span class="tiny" >' + deal.nice_date + '</span></p>';
			  				markup +=  '</div>';
		  				markup +=  '</div>';
					markup +=  '</div>';
				markup +=  '</div>';
	  				//  --------------------------------------------------
				markup +=  '<div class="item-stats span-12 clear left back-color-2" >';
					  //  -----------------------------------
					  //  Votes
					  markup += '<div class="item-stat" >';
					  markup += '<a href="javascript:;" class="js-vote icon-vote-small" title="Vote up this Deal"  rel="' + deal.id + '">' + deal.votes + '</a>';
					  markup += '</div>';	
					  //  -----------------------------------
					  //  SHARES
					  markup += '<div class="item-stat" >';
					  markup += '<a href="https://www.facebook.com/sharer/sharer.php?u=' + deal['link'] + '" target="_blank" class="js-share icon-share-small " title="Share this Deal"  rel="' + deal.id + '">' + deal.meta_shares + '</a>';	
					  markup += '</div>';	
					  //  -----------------------------------
					  //  VIEWS
					  markup += '<div class="item-stat" >';
					  markup += '<a href="javascript:;" class="icon-views-small " title="Views this Deal has received"  >' + deal.meta_views + '</a>';	
					  markup += '</div>';	
					  //  -----------------------------------
				markup +=  '</div>';
			markup +=  '</div>';
			//  --------------------------------------------------
		markup +=  '</div>';
		
		return markup;
	}