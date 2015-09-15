<?php

$p = loadVariable("p", "");
$a = loadVariable("a", "");
$sz = loadVariable("Size", '');
$ProductId = loadVariable("ProductId", 0);
$maincategory = loadVariable('maincategory', '');
$brand = loadVariable('brand', '');
$product_type = loadVariable('product_type', '');
$price = loadVariable('price', '');
$productname = loadVariable('productname', '');
$file = loadvariable("file", "");
$description = loadVariable('description', '');
$priview = loadVariable('preview_audio', '');
$submit = loadvariable('submit', '');
$quantity = loadVariable('quantity', '');
if ($p == "product") {
    if ($submit == 'Save') {
        if ($a == "add") {
            $product_str = "";
            $audio_str = "";
            $priview_str = "";
            $product_image = upload("product_image", "images/Product_Image/", "jpg,png,bmp,gif");
            $audio = upload("audio", "images/Product_audio", "mp3,amr,wav");
            $priview = upload("priview", "images/Product_audio", "mp3,amr,wav");
            $product_str = 'UNSET1.jpg';
            if ($product_image[1] == "") {
                $product_str = $product_image[0];
            }
            if ($audio[1] == "") {
                $audio_str = $audio[0];
            }
            if ($priview[1] == "") {
                $priview_str = $priview[0];
            }
            $SQL = "INSERT INTO product SET product_type='" . inserttext($product_type) . "', ProductName='" . inserttext($productname) . "',CategoryId='" . inserttext($maincategory) . "',ProductPrice='" . inserttext($price) . "',description='" . inserttext($description) . "',ProductImage='{$product_str}',audio='{$audio_str}',preview_audio='{$priview_str}'";

            $inserttextproperty = $objDB->insert($SQL);
            $pid = mysql_insert_id();

            $success = "New Product Added SuccessFully";
            $_SESSION['success'] = $success;
            $_SESSION['check'] = 'add';

            header("Location:" . $AbsoluteURLAdmin . "index.php?p=" . $p);

            exit;
        }
    }
}

if ($submit == 'Save') {
    if ($a == "update") {
        $product_str = "";
        $audio_str = "";
        $priview_str = "";
        if ($_FILES['product_image']['size'] > 0) {
            $product_image = upload("product_image", "uploads/btn_upload", "jpg,png,bmp,gif,jpeg");
            $product_image = '';
            if ($product_image[1] == "") {
                $product_image1 = $product_image[0];
                $product_str = ",ProductImage='{$product_image1}'";
            }
        }
        if ($_FILES['audio']['size'] > 0) {
            $audio = upload("audio", "images/Product_audio", "mp3,amr,wav");
            $audio = '';
            if ($audio[1] == "") {
                $audio1 = $audio[0];
                $audio_str = ",audio='{$audio1}'";
            }
        }
        if ($_FILES['priview']['size'] > 0) {
            $priview = upload("priview", "images/Product_audio", "mp3,amr,wav");
            $priview = '';
            if ($priview[1] == "") {
                $priview1 = $priview[0];
                $priview_str = ",preview_audio='{$priview1}'";
            }
        }
        $SQL = "UPDATE product SET product_type='" . inserttext($product_type) . "', ProductName='" . inserttext($productname) . "'{$product_str},CategoryId='" . inserttext($maincategory) . "'{$audio_str},ProductPrice='" . inserttext($price) . "'{$priview_str},description='" . inserttext($description) . "' where ProductId ='" . $ProductId . "'";

        $updatetextproperty = $objDB->sql_query($SQL);

        $success = "Product Updated SuccessFully";
        $_SESSION['success'] = $success;
        $_SESSION['check'] = 'update';

        header("Location:" . $AbsoluteURLAdmin . "index.php?p=" . $p);
        exit;
    }
}



//if ($a == "muldelete") { //code for deleting multiple data form the table
//    $multipledel = loadvariable('multipledel', '');
//    $todo = loadvariable('todo', '');
//    if ($multipledel != '') {
//        if (count($multipledel) > 0) {
//            for ($i = 0; $i < count($multipledel); $i++) {
//                $del_id = $multipledel[$i];
//                //echo $del_id.'<br/>';
//                if ($todo == "delete") {
//                    $SQL = "delete from product where ProductId ='" . $del_id . "' ";
//                    $rsExtPro = $objDB->sql_query($SQL);
//                } else {
//                    $erro = "Something Wrong.";
//                }
//            }
//        }
//        $_SESSION['success'] = "<span>Selected Product Deleted.</span>";
//        $_SESSION['check'] = 'add';
//        header("Location:" . $AbsoluteURLAdmin . "index.php?p=" . $p);
//        exit;
//    } else {
//        $success = "Select atleast one Product";
//        $_SESSION['error'] = $success;
//        $_SESSION['check'] = 'add';
//        header("Location:" . $AbsoluteURLAdmin . "index.php?p=" . $p);
//        exit;
//    }
//}
?>