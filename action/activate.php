<?php

$sql = "update mn_user SET mn_user_status='1' where mn_user_activationcode='{$_GET['code']}'";
$update = $objDB->edit($sql);
if ($update) {
    header('Location: index.php?p=login&msg=activated');
    exit;
} else {
    echo 'Code is expired or not present in System contact Administrator.';
}
?>
