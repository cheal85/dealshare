<?php
ob_start();  // Output buffer
session_start();
//  --------------------------------------------
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
//  --------------------------------------------
//  AJAX SCRIPT BEST PRACTICE
//
//  This script will sanitize and save
//  data to the database.  This is a 
//  standard variation which will work
//  for a great number of purposes
//  --------------------------------------------
//  test script was posted to
if(!$_POST['submit']) header("location: /");
//  --------------------------------------------
//  sanitize $_POST data
$post = sanitize_post($_POST);
//  --------------------------------------------
//  validation checks
$authenticated = true;
//  test deal association
if(!$post['id_deal']) $authenticated = false;
//  create return variables
$json_array = array('success' => false, 'message' => '', 'html' => '');
//  --------------------------------------------
if($authenticated) {
	//  ----------------------------------------
	//  Set class instance
	$db_manager = $myCommentManager;
	//  array of information to get content
	$array = array('id_deal' => $post['id_deal']
					);
	//  ------------------------------------------
	//  COMMENT FORM
	$count = '2';
	$data = array();
	$data['id'] = $array['id_deal'];
	if(LOGGED_IN) {
		include(DIR_FORMS . '/form_comment_add.php');
	}
	else {
		echo '<div class="sep-20">&nbsp;</div>';	
	}
	//  ------------------------------------------
	//  LOAD COMMENT CONTENT
	if($comments = $db_manager -> GetEntries('all', $post)) {
		#var_dump($comments);
		include(DIR_TEMPLATES . '/lightbox/temp_view_comments.php');
		$json_array['success'] = true;
	}
	else {
		echo '<div class="clear left span-12 text-centre" >';	
		echo '<div class="padding-10 " ><div class="span-12 message-panel " ><p>Be the first to comment on this deal!</p></div></div>';
		echo '</div>';	
	}
	//  ------------------------------------------
	$json_array['html'] = ob_get_contents();
}
else
{
		$json_array['html'] = '';	
}

ob_end_clean(); // prevent stray echo statements from breaking ajax
echo json_encode($json_array);
?>