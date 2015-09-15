<?php
$p = loadvariable('p', '');
$a = loadvariable('a', '');
$content_id = loadVariable('id', '');
$content_title = loadVariable('content_title', '');
$content_type = loadVariable('content_type', '');
$content_excerpt = loadVariable('content_excerpt', '');
$seo_introductory_text = loadVariable('seo_introductory_text', '');
$seo_text = loadVariable('seo_text', '');
$content = loadVariable('content', '');
$content_orderr = loadVariable('content_orderr', '');
$content_uri = loadVariable('content_uri', '');
$status = loadVariable('status', '');
$submit = loadvariable('submit', '');
$s = loadvariable('s', '');
if ($p == 'site_content') {
    if ($submit == 'Save') {
        if ($a == 'add') {
            // add
            $SQL = "insert site_content set content_title ='" . inserttext($content_title) . "',content_type='" . inserttext($content_type) . "',content_excerpt= '" . inserttext($content_excerpt) . "',seo_introductory_text= '" . inserttext($seo_introductory_text) . "',seo_text= '" . inserttext($seo_text) . "',content= '" . $content . "',content_uri= '" . inserttext($content_uri) . "',status= '" . inserttext($status) . "'";
            $insert = $objDB->insert($SQL);
            $lastid = mysql_insert_id();
            $success = "New Site Content SuccessFully";
            $_SESSION['success'] = $success;
            $_SESSION['check'] = 'add';
            header("Location:" . $AbsoluteURLAdmin . "index.php?p=manage_site_content&a=edit&id=$lastid");
            exit;
        }
    }
}
if ($a == 'delete' && $content_id != '0') {
    $SQL = "delete from site_content WHERE content_id='" . $content_id . "'";
    $rsAdmin = $objDB->sql_query($SQL);
    $success = "Site Content Deleted SuccessFully";
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_content");
    exit;
}
if ($a == 'status' && $s != '' && $content_id != '0') {
    $SQL = "update site_content set status = '" . inserttext($s) . "' where content_id=" . $content_id;
    $rsAdmin = $objDB->sql_query($SQL);
    if ($s == '0') {
        $success = "Site Content Deactivated";
    } else {
        $success = "Site Content Activated";
    }
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_content");
}
if ($submit == 'Save') {
    if ($a == 'update') {
        $SQL = "UPDATE site_content set content_title ='" . inserttext($content_title) . "',content_type='" . inserttext($content_type) . "',content_excerpt= '" . inserttext($content_excerpt) . "',seo_introductory_text= '" . inserttext($seo_introductory_text) . "',seo_text= '" . inserttext($seo_text) . "',content= '" . $content . "',content_uri= '" . inserttext($content_uri) . "',status= '" . inserttext($status) . "' WHERE content_id='" . inserttext($content_id) . "'";
        $update = $objDB->edit($SQL);
        $success = "Site Content Updated SuccessFully";
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'edit';
        header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_content");
        exit;
    }
}
?>