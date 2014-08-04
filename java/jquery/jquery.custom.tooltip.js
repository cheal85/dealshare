$(document).ready(function(){
//  -------------------------------------
//  CUSTOM TOOLTIP
//  -------------------------------------
function CreateTooltip($element) {
	//  get content for tooltip
	var content = $element.html();
	//  ---------------------------------
	//  find target
	var $target = $element.parents('div').find('.js-tooltip-target');
	//  ---------------------------------
	//  calculate position
	var position = $target.position();
	var target_left = position.left;
	var left = (target_left + 5);
	var target_top = position.top;
	var height = $target.height();
	var top = (height + target_top + 8);
	var width = $target.width();
	console.log('left: ' + left);
	console.log('top: ' + top);
	console.log('height: ' + height);
	console.log('width: ' + width);
	//  ---------------------------------
	//  create html markup
	var markup = '';
	//
	markup += '<div class="tooltip" style="margin-top:' + (height +5) + 'px; margin-left:10px; max-width:' + width + 'px;">';
	//  up arrow
	markup += '<img src="/web_graphics/icons/tooltip-arrow.png" class="tooltip-arrow" />';
	//  padding
	markup += '<div class="padding-5">';
	markup += '<p class="tooltip-content" >';
	//  content
	markup += content;
	//  close
	markup += '</p>';
	markup += '</div>';
	//
	markup += '</div>';
	//  add to DOM
	$target.before(markup);
}

CreateTooltip($('p#tooltip-signup'));

});

function ShowSubCategory($element, show) {
	console.log('show: ' + show);
	var $parent = $element.parents('div.cat-container');
	var parent_id = String($parent.attr('id'));
	console.log('id: ' + parent_id);
	var level_id = parent_id.split("-");
	var level = parseInt(level_id[1]);
	var cat = $element.attr('rel');
	var $subCat;
	console.log('level: ' + level_id[1]);
	
	if(show) {
		$element.addClass('on');
		$element.addClass('selected');
	}
	else {
		$element.removeClass('selected');
		console.log(parseInt($element.attr('rel')));
		console.log(parseInt(JS_SELECTED_CAT));
		if( parseInt($element.attr('rel')) != parseInt(JS_SELECTED_CAT) ) {
			$element.removeClass('on');
		}
	}
	
	for(var i=0; i<(level+2); i++) {
		if(i > level) {
			console.log('i: ' + i);
			var $sub_level = $('div#level-' + i);
			if(show) {
				console.log('show');
				if($subCat = $sub_level.find('div#category-' + cat)) {
					$subCat.show();	
				}
			}
			else {
				console.log('hide');
				if($subCat = $sub_level.find('a.js-category.on')) {
					ShowSubCategory($subCat, false);
					$('div#category-' + cat).hide();
				}
			}
		}
	}
	return true;
	
}