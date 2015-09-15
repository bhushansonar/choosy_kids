<?php

error_reporting(0);
$p = loadvariable("p", "");
$username = loadvariable("name", "");
$email = loadvariable("email", "");
$mobile = loadvariable("phone", "");
$msg = loadvariable("message", "");
$sql = "insert into mn_contactus(mn_user_name,mn_user_email,mn_user_phone,mn_user_msg)values('" . $username . "','" . $email . "','" . $mobile . "','" . $msg . "')";
$objDB->sql_query($sql);
header("location:index.php?p=home");
?>
