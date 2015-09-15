<?php
	ob_start();
	session_start();
	require_once("../utils/config.php");
	require_once("../utils/functions.php");
	require_once("../utils/dbClass.php");
	$objDB = new MySQLCN;
	$BasicHURL=str_replace('manage.php','',$_SERVER['PHP_SELF']);
 	$HURL="http://".$_SERVER['HTTP_HOST'].$BasicHURL;
	if($_SERVER['HTTP_HOST']=='208.109.190.84' || $_SERVER['HTTP_HOST']=='cfcdi.org' || $_SERVER['HTTP_HOST']=='shahil')
	{
		$HURLS="http://".$_SERVER['HTTP_HOST'].$BasicHURL;
	} else {
		$HURLS="https://".$_SERVER['HTTP_HOST'].$BasicHURL;
	}
	
	if(empty($_REQUEST['p']))
		$page = "error.php";
	else if(isset($_REQUEST['p']))
		$page = $_REQUEST['p'].".php";
	else
		$page = "error.php";
	
	if(file_exists("action/".$page))
		include("action/".$page);
	else
		include("action/error.php");
	$objDB->close();
?>
