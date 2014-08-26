<?php
session_start();
//  --------------------------------------------
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/scripts/config.php');
require_once(DIR_PHP . '/loader.php');
$past = (time() -10);
setcookie('dealshare_member', '', $past, '/');
setcookie('dealshare_user_code', '', $past, '/');
setcookie('dealshare_user_id', '', $past, '/');
setcookie('dealshare_allow_cookies', '', $past, '/');
setcookie('dealshare_prize', '', $past, '/');

?>