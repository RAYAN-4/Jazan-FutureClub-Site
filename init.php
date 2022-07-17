<?php  
 ob_start();
 session_start();
 define("ROOT_PATH_MAIN", realpath(dirname(__FILE__)));
 define("BASE_URL", "http://localhost/myPhpProjects/futureClubWebsite");

 $templates = "includes/templates";
 $languages = "includes/languages";
 $functions = "includes/functions";
 $cssAssets = "includes/assets/css";
 $jsAssets = "includes/assets/js";
$errors = array();
include ROOT_PATH_MAIN . '/admin/utility/myPhpUtility.php'; 
 include $functions . '/functions.php';
 include $templates . '/header.php';
 include $templates . '/navbar.php';



 

?>