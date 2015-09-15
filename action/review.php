<?php

$p = loadvariable('p', '');
$a = loadvariable('a', '');
$review_Id = loadvariable('review_Id', '');
$ProductId = loadvariable('ProductId', '');
$review_name = loadvariable('review_name', '');
$review_title = loadVariable('review_title', '');
$review_description = loadvariable('review_description', '');
$add_date = date('Y-m-d');
$status= loadvariable('status', '0');

if ($a == 'add') {

    // add
    $SQL = "insert product_review set ProductId ='" . inserttext($ProductId) . "',review_name ='" . inserttext($review_name) . "',review_title='" . inserttext($review_title) . "',review_description= '" . inserttext($review_description) . "',add_date='" . inserttext($add_date) . "',status= '" . inserttext($status) . "'";
    $insert = $objDB->insert($SQL);
    echo '1'; //header("Location:" . $AbsoluteURLAdmin . "index.php?p=manage_site_menu&a=edit&id=$lastid");
    exit;
}
?>
