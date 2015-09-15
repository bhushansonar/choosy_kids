<?php

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
    header("Location:index.php?err=login_required");
    exit;
}
if (isset($_GET['mode']) && $_GET['mode'] == base64_encode('c')) {
    $sql = "UPDATE `pd_transaction` SET `pd_transaction_status`='C' WHERE `pd_transaction_id`=" . base64_decode($_GET['id']);
    $objDB->edit($sql);

    $sql = "select ProductId from `pd_transaction` where `pd_transaction_id`=" . base64_decode($_GET['id']);
    $data = $objDB->select($sql);
    
    header("location:index.php?p=allproducts");
     
//    $note_id = 0;
//    if ($data && !empty($data)) {
//        $note_id = $data[0]['pd_note_id'];
//    }
//    if ($note_id != 0) {
//        $sql = "select pd_note_path from product where pd_note_id={$note_id} limit 0,1";
//        $data = $objDB->select($sql);
//        if ($data && !empty($data)) {
//            $name = $data[0]['pd_note_path'];
//            $filePath = $AbsoluteURL . "notes/pdf/" . $name;
//            header("Location:" . $filePath);
//            exit;
//        }
//    }
    //logic for downloading file
} else if (isset($_GET['mode']) && $_GET['mode'] == base64_encode('i')) {
    $sql = "UPDATE `pd_transaction` SET `pd_transaction_status`='I' WHERE `pd_transaction_id`=" . base64_decode($_GET['id']);
    $objDB->edit($sql);
    header("location:index.php?p=allproducts");
   
}
?>
