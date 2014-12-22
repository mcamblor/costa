<?php
session_start();
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
//$_SESSION['SKey'] = uniqid(mt_rand(), true);
//$_SESSION['IPaddress'] = ExtractUserIpAddress();
$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

if($_SESSION["autentica"] != "SI"){

header("Location: costa_home.php");
exit();
}

?>