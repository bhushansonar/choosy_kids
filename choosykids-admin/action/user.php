<?php

$p = loadvariable('p', '');
$a = loadvariable('a', '');

$userid = loadvariable('id', '');

$displayname = loadvariable('FirstName', '');
$phone = loadvariable('phone', '');
$address = loadvariable('address', '');

$Status = loadvariable('Status', '');
$submit = loadvariable('submit', '');
$s = loadvariable('s', '');

if ($p == 'user') {
    if ($submit == 'Save') {

        if ($a == 'update') {


            // update

            $SQL = "UPDATE mn_user set mn_user_display_name='" . $displayname . "',mn_user_phone='" . $phone . "',mn_user_address= '" . $address . "',status= '" . $Status . "' WHERE mn_user_id='" . $userid . "'";
            $update = $objDB->edit($SQL);
            //print_r($update);
            $success = "User Updated SuccessFully";
            $_SESSION['success'] = $success;
            $_SESSION['check'] = 'edit';
            header("Location:" . $AbsoluteURLAdmin . "index.php?p=user_list");
            exit;
        }
    }
}
if ($a == 'delete' && $userid != '0') {
    $SQL = "update  mn_user set status='-1' where mn_user_id ='" . $userid . "'";
    $rsAdmin = $objDB->sql_query($SQL);
    $success = "User Deleted SuccessFully";
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=user_list");
    exit;
}
if ($a == "muldelete") { //code for deleting multiple data form the table
    $multipledel = loadvariable('multipledel', '');
    if ($multipledel != '') {
        if (count($multipledel) > 0) {
            for ($i = 0; $i < count($multipledel); $i++) {
                $del_id = $multipledel[$i];
                //echo $del_id.'<br/>';
                $SQL = "DELETE from user where UserId='" . $del_id . "' ";
                $rsMember = $objDB->sql_query($SQL);
            }
        }
        $success = "Selected Users Deleted";
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'add';
        header("Location:" . $AbsoluteURLAdmin . "index.php?p=user_list");
        exit;
    } else {
        $success = "Selected atleast one User";
        $_SESSION['error'] = $success;
        $_SESSION['check'] = 'add';
        header("Location:" . $AbsoluteURLAdmin . "index.php?p=user_list");
        exit;
    }
}
if ($a == 'status' && $s != '' && $userid != '0') {
    $SQL = "update mn_user set status = '" . $s . "' where mn_user_id=" . $userid;
    $rsAdmin = $objDB->sql_query($SQL);
    if ($s == '0') {
        $success = "User Deactivated";
    } else {
        $success = "User Activated";
    }
    $_SESSION['success'] = $success;
    $_SESSION['check'] = 'add';
    header("Location:" . $AbsoluteURLAdmin . "index.php?p=user_list");
}
?>