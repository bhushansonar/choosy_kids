<?php

//if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
//    header("Location:index.php?p=login&err=login_required");
//    exit;
//}
//Database variables
// PayPal settings
$paypal_email = 'ravi441988-facilitator@yahoo.co.in';
//$paypal_email = 'naweedrasooly.1619@gmail.com';
//$return_url = 'http://boom-tools.in/missednotes/Paypal/payment-successful.php';
//$cancel_url = 'http://boom-tools.in/missednotes/Paypal/payment-cancelled.htm';

if (!isset($_POST['item_number']) && $_POST['item_number'] == 0) {

    header("Location:index.php?err=ProductId required");
    exit;
}


$sql = "SELECT * FROM `product` where ProductId='{$_POST['item_number']}'  LIMIT 0 , 1";



$productDetails = $objDB->select($sql);

$productDetails = isset($productDetails[0]) ? $productDetails[0] : $productDetails;


//mark all pending status incomplete
$sql = "UPDATE `pd_transaction` SET `pd_transaction_status`='I' WHERE `pd_transaction_status`='P' AND pd_transaction_date < CURDATE()";

$objDB->edit($sql);

$email = loadVariable("pd_email", "");
$product_id = loadVariable("item_number", "");
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO `pd_transaction`(`pd_email`, `ProductId`, `pd_transaction_status`,`pd_transaction_date`) VALUES ('$email',$product_id,'P','{$date}')";

$transactonid = $objDB->insert($sql);

//setting up pending transaction
//getItemDetail and make a entry with pending status!!!
$item_name = $productDetails['ProductName'];
$item_amount = $productDetails['ProductPrice'];


$return_url = 'http://localhost/choosy_kids/manage.php?p=postpayment&mode=' . base64_encode('c') . '&id=' . base64_encode($transactonid);
$cancel_url = 'http://localhost/choosy_kids/manage.php?p=postpayment&mode=' . base64_encode('i') . '&id=' . base64_encode($transactonid);

//$return_url = 'http://localhost/missednotes/manage.php?p=postpayment&mode=' . base64_encode('c') . '&id=' . base64_encode($transactonid);
//$cancel_url = 'http://localhost/missednotes/manage.php?p=postpayment&mode=' . base64_encode('i') . '&id=' . base64_encode($transactonid);
//$notify_url = 'http://localhost/missednote/Paypal/payments.php';
//$notify_url = 'http://boom-tools.in/missednotes/Paypal/payments.php';
//$paypal_url = "https://www.paypal.com";
$paypal_url = "https://www.sandbox.paypal.com";


// Include Functions
//Database Connection
// Check if paypal request or response
// Firstly Append paypal account to querystring
$querystring .= "?business=" . urlencode($paypal_email) . "&";

// Append amount& currency (£) to quersytring so it cannot be edited in html
//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
$querystring .= "item_name=" . urlencode($item_name) . "&";
$querystring .= "amount=" . urlencode($item_amount) . "&";

//loop for posted values and append to querystring
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $querystring .= "$key=$value&";
}

// Append paypal return addresses
$querystring .= "return=" . urlencode(stripslashes($return_url)) . "&";
$querystring .= "cancel_return=" . urlencode(stripslashes($cancel_url)) . "&";
//    $querystring .= "notify_url=" . urlencode($notify_url);
// Append querystring with custom field
//$querystring .= "&custom=".USERID;
// Redirect to paypal IPN
header('location:' . $paypal_url . '/cgi-bin/webscr' . $querystring);

exit();
?>
