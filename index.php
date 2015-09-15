<?php
ob_start();
session_start();
header("Content-Type: text/html; charset=UTF-8");
require_once("utils/dbClass.php");
require_once("utils/config.php");
require_once("utils/functions.php");
$objDB = new MySQLCN();
$p = loadVariable('p', 'home');
if (empty($p)) {
    $p = 'home';
}
include ('include/header.php');
if (file_exists('include/' . $p . ".php")) {
    include_once('include/' . $p . ".php");
} elseif ($objDB->isContentExist($p)) {
    include_once("include/content.php");
} else {
    include_once('include/404.php');
}
include ('include/footer.php');