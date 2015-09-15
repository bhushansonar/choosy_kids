<?php
$p = loadvariable('p', '');
$a = loadvariable('a', '');
$AdminID = loadvariable('AdminID', '0');
$UserName = loadvariable('UserName', '');
$Password = loadvariable('Password', '');
$FirstName = loadvariable('FirstName', '');
$LastName = loadvariable('LastName', '');
$Email = loadvariable('Email', '');
$AdminRole = loadVariable("AdminRole", "");
$Status = loadvariable('Status', '');
$submit = loadvariable('submit', '');
$s = loadvariable('s', '');
if ($p == 'admin') {
    if ($submit == 'Save') {
        if ($a == 'add' && $AdminID == '0') {
            $SQL = "select UserName from admin where UserName='" . $UserName . "'";
            $rsAdmin = $objDB->select($SQL);
            if (count($rsAdmin) > 0) {
                $error = "The supplied UserName already exists.Please select a unique UserName.";
                ?>
                <html>
                    <head></head>
                    <body>
                        <form name="frm" id="frm" method="post" action="index.php">

                            <?
                            foreach ($_POST as $Key => $Value) {
                                if ($Key != "submit") {
                                    if ($Key == "p") {
                                        $Value = $p;
                                    }
                                    if ($Key == "a") {
                                        $Value = 'add';
                                    }
                                    ?>
                                    <input type="hidden" name="<?= $Key ?>" value="<?= $Value ?>" />
                                <? }
                            }
                            ?>
                            <input type="hidden" name="error"  value="<?= $error; ?>" />
                        </form>
                    </body>
                    <script language="javascript" type="text/javascript">
                        document.frm.submit();
                    </script>
                </html>
            <?php
            } else {
                // insert
                $SQL = "INSERT admin set UserName='" . $UserName . "',Password='" . encodestring($Password) . "',FirstName='" . $FirstName . "',LastName='" . $LastName . "',Email='" . $Email . "',AdminRole='" . $AdminRole . "',Status=" . $Status;
                $objDB->insert($SQL);
                $lastid = mysql_insert_id();
                $success = "New Admin Added SuccessFully";
                $_SESSION['success'] = $success;
                $_SESSION['check'] = 'add';
                header("Location:" . $AbsoluteURLAdmin . "index.php?p=admin&a=edit&AdminID=$lastid");
                exit;
            }
        }
        if ($a == 'update' && $AdminID != '0') {
            // first we need to check if the UserName/Password already eixsts.
            $SQL = "select UserName from admin where UserName='" . $UserName . "' AND AdminID !=" . $AdminID;
            $rsAdmin = $objDB->select($SQL);
            if (count($rsAdmin) > 0) {
                $error = "The supplied UserName already exists.Please select a unique UserName.";
                ?>
                <html>
                    <head></head>
                    <body>
                        <form name="frm" id="frm" method="post" action="index.php">

                            <?
                            foreach ($_POST as $Key => $Value) {
                                if ($Key != "submit") {
                                    if ($Key == "p") {
                                        $Value = $p;
                                    }
                                    if ($Key == "a") {
                                        $Value = 'add';
                                    }
                                    ?>
                                    <input type="hidden" name="<?= $Key ?>" value="<?= $Value ?>" />
                                <? }
                            }
                            ?>
                            <input type="hidden" name="error"  value="<?= $error; ?>" />
                        </form>
                    </body>
                    <script language="javascript" type="text/javascript">
                        document.frm.submit();
                    </script>
                </html>
            <?php
            } else {
                // update
                if ($_SESSION['session_adminID'] != $AdminID) {
                    $qry = " ,AdminRole='" . $AdminRole . "',Status='" . $Status . "'";
                }
                $SQL = "UPDATE admin set UserName='" . $UserName . "',Password='" . encodestring($Password) . "',FirstName='" . $FirstName . "',LastName='" . $LastName . "',Email='" . $Email . "' " . $qry . " WHERE AdminID='" . $AdminID . "'";
                $objDB->sql_query($SQL);
                $success = "Admin Updated SuccessFully";
                $_SESSION['success'] = $success;
                $_SESSION['check'] = 'edit';
                header("Location:" . $AbsoluteURLAdmin . "/index.php?p=admin_list");
                exit;
            }
        }
    }
    if ($a == 'delete' && $AdminID != '0') {
        $SQL = "delete from admin where AdminID=" . $AdminID;
        $rsAdmin = $objDB->sql_query($SQL);
        $success = "Admin Deleted SuccessFully";
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'add';
        header("Location:" . $AbsoluteURLAdmin . "/index.php?p=admin_list");
        exit;
    }
    if ($a == "muldelete") { //code for deleting multiple data form the table
        $multipledel = loadvariable('multipledel', '');
        if ($multipledel != '') {
            if (count($multipledel) > 0) {
                for ($i = 0; $i < count($multipledel); $i++) {
                    $del_id = $multipledel[$i];
                    //echo $del_id.'<br/>';
                    $SQL = "DELETE from admin where AdminID='" . $del_id . "' ";
                    $rsMember = $objDB->sql_query($SQL);
                }
            }
            $success = "Selected Admins Deleted";
            $_SESSION['success'] = $success;
            $_SESSION['check'] = 'add';
            header("Location:" . $AbsoluteURLAdmin . "/index.php?p=admin_list");
            exit;
        } else {
            $success = "Selected atleast one Admin";
            $_SESSION['error'] = $success;
            $_SESSION['check'] = 'add';
            header("Location:" . $AbsoluteURLAdmin . "/index.php?p=admin_list");
            exit;
        }
    }
    if ($a == 'status' && $s != '' && $AdminID != '0') {
        $SQL = "update admin set Status = '" . $s . "' where AdminID=" . $AdminID;
        $rsAdmin = $objDB->sql_query($SQL);
        if ($s == '0') {
            $success = "Admin Deactivated";
        } else {
            $success = "Admin Activated";
        }
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'add';
        header("Location:" . $AbsoluteURLAdmin . "/index.php?p=admin_list");
    }
}
?>