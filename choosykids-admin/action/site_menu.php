<?php
$p = loadvariable('p', '');
$a = loadvariable('a', '');
//print_r($_POST);
//print_r($_GET);
$menu_id = loadvariable('id', '');
$menu_name = loadvariable('menu_name', '');
$parent = loadVariable('parent', '');
$description = loadvariable('description', '');
$type = loadvariable('type', '');
$link_content = loadvariable('link_content', '');
$external_link = loadvariable('external_link', '');
$menu_order = loadvariable('menu_order', '');
$status = loadvariable('status', '');
$submit = loadvariable('submit', '');
$s = loadvariable('s', '');
if ($type == 'external') {
    $link_content = '';
} else {
    $external_link = '';
}
if ($p == 'site_menu') {
    if ($submit == 'Save') {
        if ($a == 'add') {
            // add
            $SQL = "insert site_menu set menu_name ='" . inserttext($menu_name) . "',parent='" . inserttext($parent) . "',description= '" . inserttext($description) . "',type='" . inserttext($type) . "',link_content= '" . inserttext($link_content) . "',external_link= '" . inserttext($external_link) . "',menu_order= '" . inserttext($menu_order) . "',status= '" . inserttext($status) . "'";
            $insert = $objDB->insert($SQL);
            $lastid = mysql_insert_id();
            $success = "New Site Menu Added SuccessFully";
            $_SESSION['success'] = $success;
            $_SESSION['check'] = 'add';
            header("Location:" . $AbsoluteURLAdmin . "index.php?p=manage_site_menu&a=edit&id=$lastid");
            exit;
        }
    }
}
if ($a == 'delete' && $menu_id != '0') {

    $SQL = "delete from site_menu WHERE menu_id='" . $menu_id . "'";
    $rsAdmin = $objDB->sql_query($SQL);
    $success = "Site Menu Deleted SuccessFully";
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_menu");
    exit;
}

if ($a == 'status' && $s != '' && $menu_id != '0') {
    $SQL = "update site_menu set status = '" . $s . "' where menu_id=" . $menu_id;
    $rsAdmin = $objDB->sql_query($SQL);
    if ($s == '0') {
        $success = "Site Menu Deactivated";
    } else {
        $success = "Site Menu Activated";
    }
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_menu");
}   

if ($submit == 'Save') {
    if ($a == 'update') {

        $SQL = "UPDATE site_menu set menu_name ='" . inserttext($menu_name) . "',parent='" . inserttext($parent) . "',description= '" . inserttext($description) . "',link_content= '" . inserttext($link_content) . "',type='" . inserttext($type) . "',external_link= '" . inserttext($external_link) . "',menu_order= '" . inserttext($menu_order) . "',status= '" . inserttext($status) . "' WHERE menu_id='" . inserttext($menu_id) . "'";
        $update = $objDB->edit($SQL);
        $success = "Site Menu Updated SuccessFully";
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'edit';
        header("Location:" . $AbsoluteURLAdmin . "index.php?p=list_site_menu");
        exit;
    }
}
?>
