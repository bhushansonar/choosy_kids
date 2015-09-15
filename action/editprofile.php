<?php

error_reporting(0);

$p = loadvariable("p", "");
$user_id = loadvariable("user_id", "");
$display_name = loadvariable("display_name", "");
$password = loadvariable("password", "");
$gender = loadvariable("gender", "");
$paypal_details = loadvariable("paypal_details", "");
$phone = loadvariable("phone", "");
$address = loadvariable("address", "");
$city = loadvariable("city", "");
$province = loadvariable("province", "");
$country = loadvariable("country", "");
$school = loadvariable("school", "");
$program = loadvariable("program", "");
$pswdString = "";
if ($password != "") {
    $password = md5($password);
    $pswdString = ",mn_user_password='{$password}'";
}
$sql = "update mn_user set mn_user_display_name='{$display_name}',mn_user_gender='{$gender}',mn_paypal_email='{$paypal_details}',mn_user_phone='{$phone}',mn_user_address='{$address}',mn_user_city='{$city}',mn_user_province='{$province}',mn_user_country='{$country}',mn_user_school='{$school}',mn_user_program='{$program}'{$pswdString} where mn_user_id = '" . $user_id . "'";
$update = $objDB->edit($sql);
header("Location:index.php?p=home");
?>