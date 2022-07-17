<?php  

require_once 'connect.php';
ob_start();
session_start();

define("ROOT_PATH", realpath(dirname(__FILE__)));
define("BASE_URL", "http://localhost/myPhpProjects/futureClubWebsite");
$errors = array();
$includes = "includes/";

include ROOT_PATH . '/utility/myPhpUtility.php';
include $includes ."header.php";
include $includes ."navbar.php";

adminOnly();


?>