<?php 
if(isset($_SESSION["email"])!="")
	unset($_SESSION["email"]);
	header("location:index.php");
	
if(isset($_SESSION["username"])!="")
	unset($_SESSION["username"]);
	header("location:index.php");

if(isset($_SESSION["userid"])!="")
	unset($_SESSION["userid"]);
	header("location:index.php");
?>