//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------
var JS_CONTENT = new Array();

var JS_PAGE = 1;

var JS_LOADED = 0;


var JS_MORE = true;

var JS_TYPE = 'deal';

var JS_SELECTED_CAT = '';


//  BASE SCRIPTS
document.write("<script type='text/javascript' src='/java/ui/js/jquery-ui-1.10.4.custom.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.image.fileuploader.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.custom.functions.js'></script>");
if (typeof JS_THIS_PAGE != 'undefined') {
	if(JS_THIS_PAGE == 'add-deal') document.write("<script type='text/javascript' src='/java/jquery/jquery.image.upload.js'></script>");
	//
	if(JS_THIS_PAGE == 'edit-profile') document.write("<script type='text/javascript' src='/java/jquery/jquery.image.upload.js'></script>");
	//
	if(JS_THIS_PAGE == 'homepage') {
		document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.deal.browse.js'></script>");
	}
	//
}
//  -------------------------------------------
//  ACCOUNT SCRIPTS
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.account.login.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.account.signup.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.account.edit-profile.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.contact.js'></script>");
//  -------------------------------------------
//  DEAL SCRIPTS
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.deal.add.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.comment.add.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.deal.detail.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.deal.sharing.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.ajax.merchant.content.js'></script>");
//  -------------------------------------------
document.write("<script type='text/javascript' src='/java/jquery/jquery.custom.lightbox.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.custom.tab-switching.js'></script>");
document.write("<script type='text/javascript' src='/java/jquery/jquery.custom.tooltip.js'></script>");
//  -------------------------------------------
