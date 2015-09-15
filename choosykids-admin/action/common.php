<?php

$a = loadVariable("a", '');
$v = loadVariable("v", "");
$page_type = loadVariable("page_type", "");
$id = loadVariable("id", "0");
if ($a != '') {
    switch ($a) {
        case "get_link_content":
            echo get_link_content($v);
            break;
        case 'delete':
            delete_row($page_type, $id);
            break;
        case 'status':
            status_change($page_type, $id);
            break;
        default:
            echo "Error";
    }
}

function delete_row($page_type, $id) {
    if (empty($page_type)) {
        die(json_encode(array("error" => "Page Type not declared!!!")));
    } else {
        //Table information declaration
        $table_info['site menu']['tbl'] = "site_menu";
        $table_info['site menu']['key'] = "menu_id";

        $table_info['site content']['tbl'] = "site_content";
        $table_info['site content']['key'] = "content_id";

        $table_info['user list']['tbl'] = "mn_user";
        $table_info['user list']['key'] = "mn_user_id";

        $table_info['admin list']['tbl'] = "admin";
        $table_info['admin list']['key'] = "AdminID";

        $table_info['product']['tbl'] = "product";
        $table_info['product']['key'] = "ProductId";

        $table_info['category']['tbl'] = "category";
        $table_info['category']['key'] = "CategoryId";
        
        $table_info['product_review']['tbl'] = "product_review";
        $table_info['product_review']['key'] = "review_Id";
        //login to delete
        $table = $table_info[strtolower($page_type)]['tbl'];
        $key = $table_info[strtolower($page_type)]['key'];
        if (remove_row($table, $key, $id)) {
            echo json_encode(array("msg" => "deleted successfully"));
        } else {
            echo json_encode(array("error" => "could not delete Fatal Error"));
        }
    }
}

function status_change($page_type, $id) {
    if (empty($page_type)) {
        die(json_encode(array("error" => "Page Type not declared!!!")));
    } else {
        //Table information declaration
        $table_info['site menu']['tbl'] = "site_menu";
        $table_info['site menu']['key'] = "menu_id";

        $table_info['site content']['tbl'] = "site_content";
        $table_info['site content']['key'] = "content_id";

        $table_info['user list']['tbl'] = "mn_user";
        $table_info['user list']['key'] = "mn_user_id";

        $table_info['admin list']['tbl'] = "admin";
        $table_info['admin list']['key'] = "AdminID";

        $table_info['product']['tbl'] = "product";
        $table_info['product']['key'] = "ProductId";

        $table_info['category']['tbl'] = "category";
        $table_info['category']['key'] = "CategoryId";
        
        $table_info['product_review']['tbl'] = "product_review";
        $table_info['product_review']['key'] = "review_Id";
        //login to delete
        $table = $table_info[strtolower($page_type)]['tbl'];
        $key = $table_info[strtolower($page_type)]['key'];
        if (active_deactive($table, $key, $id)) {
            echo json_encode(array("msg" => "Status Changed successfully"));
        } else {
            echo json_encode(array("error" => "could not delete Fatal Error"));
        }
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

