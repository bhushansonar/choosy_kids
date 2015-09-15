<?php

//ini_set("error_reporting",E_ALL|E_STRICT);
error_reporting(0);
putenv("TZ=Europe/Paris");
define("DB_SERVER", 'localhost');
define ("DB_DATABASE","choosykids");
define ("DB_USERNAME","root");
define ("DB_PASSWORD","");
 
/*
define("DB_DATABASE", "boomtoo2_missednotes1");
define("DB_USERNAME", "boomtoo2_missed1");
define("DB_PASSWORD", "missed123");
*/

$AbsoluteURL = "http://" . $_SERVER['HTTP_HOST'] . "/choosy_kids/";
$AbsoluteURLAdmin = "http://" . $_SERVER['HTTP_HOST'] . "/choosy_kids/choosykids-admin/";

//$AbsoluteURL = "http://" . $_SERVER['HTTP_HOST'] . "/missednotes/";
//$AbsoluteURLAdmin = "http://" . $_SERVER['HTTP_HOST'] . "/missednotes/missednotes-admin/";

define("MAIL_TEMPLATE_PATH", "");
define("EMAIL_FROM", "");
define("EMAIL_TO", "");
define("EMAIL_FROM_NAME", "");
$BasicHURL = str_replace('index.php', '', $_SERVER['PHP_SELF']);
$HURL = "http://" . $_SERVER['HTTP_HOST'] . $BasicHURL;
$HURLS = "http://" . $_SERVER['HTTP_HOST'] . $BasicHURL;

//constants
define('activated', 'Your account has been activated successfully. Please Singin with your credentials.');
define('activate','Registration is completed. Please check your mail to activate your account.');
define('reset-password','Your password sent in email. Kindly check your Email.');
        

?>

