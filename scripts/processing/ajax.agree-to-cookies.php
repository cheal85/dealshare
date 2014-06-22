<?php
ob_start();  // Output buffer
session_start();
//  --------------------------------------------
$six_months = (time() + (60*60*24*182));
setcookie('dealshare_allow_cookies', 1, $six_months, '/');
//  --------------------------------------------
ob_end_clean(); // prevent stray echo statements from breaking ajax
echo array2json(array()); //  return empty array
?>