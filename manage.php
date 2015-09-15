<?php
ob_start();
session_start();
header("Content-Type: text/html; charset=UTF-8");
require_once("utils/dbClass.php");
require_once("utils/config.php");
require_once("utils/functions.php");
$objDB = new MySQLCN;

$BasicHURL = str_replace('manage.php', '', $_SERVER['PHP_SELF']);
$HURL = "http://" . $_SERVER['HTTP_HOST'] . $BasicHURL;

$FolderName = str_replace('manage.php', '', $_SERVER['PHP_SELF']);


if (empty($_REQUEST['p']))
    $page = "error.php";
else if (isset($_REQUEST['p']))
    $page = $_REQUEST['p'] . ".php";
else
    $page = "error.php";

if (file_exists("action/" . $page))
    include("action/" . $page);
else
    include("action/error.php");


$objDB->close();
?>
