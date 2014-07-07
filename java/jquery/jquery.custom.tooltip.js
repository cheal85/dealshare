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